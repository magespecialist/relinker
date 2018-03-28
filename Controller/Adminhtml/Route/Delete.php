<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\ReLinker\Controller\Adminhtml\Route;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultInterface;
use MSP\ReLinkerApi\Api\RouteRepositoryInterface;
use MSP\ReLinkerApi\Api\Data\RouteInterface;

class Delete extends Action
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
     * Delete constructor.
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
            $this->routeRepository->deleteById($route->getId());
            $this->messageManager->addSuccessMessage(__('Route "%1" deleted.', $route->getName()));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Could not delete route: %1.', $e->getMessage()));
        }

        $result = $this->resultRedirectFactory->create();
        $result->setPath('*/*/index');

        return $result;
    }
}
