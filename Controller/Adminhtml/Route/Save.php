<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\ReLinker\Controller\Adminhtml\Route;

use Magento\Backend\App\Action;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Controller\ResultInterface;
use MSP\ReLinker\Model\RouteFactory;
use MSP\ReLinker\Model\SerializerInterface;
use MSP\ReLinkerApi\Api\RouteRepositoryInterface;
use MSP\ReLinkerApi\Api\Data\RouteInterface;

class Save extends Action
{
    /**
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'MSP_ReLinker::route';

    /**
     * @var RouteRepositoryInterface
     */
    private $routeRepository;

    /**
     * @var RouteFactory
     */
    private $routeFactory;

    /**
     * @var DataObjectHelper
     */
    private $dataObjectHelper;

    /**
     * @var SerializerInterface
     */
    private $routeParamsSerializer;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param RouteRepositoryInterface $routeRepository
     * @param SerializerInterface $routeParamsSerializer
     * @param RouteFactory $routeFactory
     * @param DataObjectHelper $dataObjectHelper
     * @SuppressWarnings(PHPMD.LongVariable)
     */
    public function __construct(
        Action\Context $context,
        RouteRepositoryInterface $routeRepository,
        SerializerInterface $routeParamsSerializer,
        RouteFactory $routeFactory,
        DataObjectHelper $dataObjectHelper
    ) {
        parent::__construct($context);
        $this->routeRepository = $routeRepository;
        $this->routeFactory = $routeFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->routeParamsSerializer = $routeParamsSerializer;
    }

    /**
     * @inheritdoc
     */
    public function execute(): ResultInterface
    {
        $routeId = (int) $this->getRequest()->getParam(RouteInterface::ID);

        $request = $this->getRequest();
        $requestData = $request->getParams();

        if (!$request->isPost() || empty($requestData['general'])) {
            $this->messageManager->addErrorMessage(__('Wrong request.'));
            return $this->redirectAfterFailure($routeId);
        }

        $routeId = (int) $requestData['general'][RouteInterface::ID];
        try {
            $route = $this->save($routeId, $requestData['general']);
            $this->messageManager->addSuccessMessage(__('Route "%1" saved.', $route->getName()));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Could not save route: %1.', $e->getMessage()));
            return $this->redirectAfterFailure($routeId);
        }

        return $this->redirectAfterSave();
    }

    /**
     * Save route
     * @param int $routeId
     * @param array $data
     * @return RouteInterface
     */
    private function save(int $routeId, array $data): RouteInterface
    {
        if ($routeId) {
            $route = $this->routeRepository->get($routeId);
        } else {
            $route = $this->routeFactory->create();
        }

        if (!isset($data['configuration'])) {
            $data['configuration'] = [];
        }
        $data['configuration_json'] = $this->routeParamsSerializer->serialize($data['configuration']);

        $this->dataObjectHelper->populateWithArray(
            $route,
            $data,
            RouteInterface::class
        );

        $this->routeRepository->save($route);

        return $route;
    }

    /**
     * Return a redirect result
     * @param int $routeId
     * @return ResultInterface
     */
    private function redirectAfterFailure(int $routeId): ResultInterface
    {
        $result = $this->resultRedirectFactory->create();

        if (null === $routeId) {
            $result->setPath('*/*/new');
        } else {
            $result->setPath('*/*/edit', [RouteInterface::ID => $routeId]);
        }

        return $result;
    }

    /**
     * Return a redirect result after a successful save
     * @return ResultInterface
     */
    private function redirectAfterSave(): ResultInterface
    {
        $result = $this->resultRedirectFactory->create();
        $result->setPath('*/*/index');

        return $result;
    }
}
