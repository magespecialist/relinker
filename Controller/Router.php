<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\ReLinker\Controller;

use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\RouterInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use MSP\ReLinker\Model\PostProcessor\PostProcessorInterface;
use MSP\ReLinker\Model\ProcessorsManagerInterface;
use MSP\ReLinker\Model\SerializerInterface;
use MSP\ReLinkerApi\Api\RouteRepositoryInterface;
use Magento\Framework\App\Action\Redirect;

class Router implements RouterInterface
{
    /**
     * @var RouteRepositoryInterface
     */
    private $routeRepository;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var ProcessorsManagerInterface
     */
    private $processorsManager;

    /**
     * @var PostProcessorInterface
     */
    private $postProcessor;

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @var ActionFactory
     */
    private $actionFactory;

    /**
     * Router constructor.
     * @param RouteRepositoryInterface $routeRepository
     * @param ProcessorsManagerInterface $processorsManager
     * @param PostProcessorInterface $postProcessor
     * @param SerializerInterface $serializer
     * @param ResponseInterface $response
     * @param ActionFactory $actionFactory
     */
    public function __construct(
        RouteRepositoryInterface $routeRepository,
        ProcessorsManagerInterface $processorsManager,
        PostProcessorInterface $postProcessor,
        SerializerInterface $serializer,
        ResponseInterface $response,
        ActionFactory $actionFactory
    ) {
        $this->routeRepository = $routeRepository;
        $this->serializer = $serializer;
        $this->processorsManager = $processorsManager;
        $this->postProcessor = $postProcessor;
        $this->response = $response;
        $this->actionFactory = $actionFactory;
    }

    /**
     * Build redirect
     * @param RequestInterface $request
     * @param string $url
     * @return ActionInterface
     */
    private function redirect(RequestInterface $request, string $url): ActionInterface
    {
        $this->response->setRedirect($url);
        $request->setDispatched(true);
        return $this->actionFactory->create(Redirect::class);
    }

    /**
     * Match application action by request
     *
     * @param RequestInterface $request
     * @return ActionInterface
     */
    public function match(RequestInterface $request)
    {
        $pathInfo = preg_replace('|/+|', '/', $request->getPathInfo());
        $pathParts = explode('/', $pathInfo, 3);
        $basePath = $pathParts[1];

        if (count($pathParts) > 1) {
            $trailingPath = implode('/', array_splice($pathParts, 2));

            try {
                $route = $this->routeRepository->getByPath($basePath);
                if ($route->getEnabled()) {
                    $url = $this->processorsManager->execute($route->getProcessor(), $route, $trailingPath);
                    $url = $this->postProcessor->execute($url, $route, $trailingPath);

                    if ($url !== '') {
                        return $this->redirect($request, $url);
                    }
                }
            } catch (NoSuchEntityException $e) {
                return null;
            }
        }

        return null;
    }
}
