<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\ReLinker\Controller\Adminhtml\Route;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use MSP\ReLinkerApi\Api\RouteRepositoryInterface;
use MSP\ReLinkerApi\Api\Data\RouteInterface;

class Edit extends Action
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
     * Edit constructor.
     * @param Action\Context $context
     * @param RouteRepositoryInterface $routeRepository
     */
    public function __construct(
        Action\Context $context,
        RouteRepositoryInterface $routeRepository
    ) {
        parent::__construct($context);
        $this->routeRepository = $routeRepository;
    }

    /**
     * @inheritdoc
     */
    public function execute(): ResultInterface
    {
        $routeId = (int) $this->getRequest()->getParam(RouteInterface::ID);
        try {
            $route = $this->routeRepository->get($routeId);
            $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
            $result
                ->setActiveMenu('MSP_ReLinker::route')
                ->addBreadcrumb(__('Edit Route'), __('Edit Route'));

            $result->getConfig()
                ->getTitle()
                ->prepend(__('Edit Route: %name', ['name' => $route->getName()]));
        } catch (NoSuchEntityException $e) {
            $result = $this->resultRedirectFactory->create();
            $this->messageManager->addErrorMessage(
                __('Route with id "%value" does not exist.', ['value' => $routeId])
            );
            $result->setPath('*/*');
        }

        return $result;
    }
}
