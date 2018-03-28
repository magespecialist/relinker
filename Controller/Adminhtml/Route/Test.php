<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\ReLinker\Controller\Adminhtml\Route;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use MSP\ReLinkerApi\Api\RouteRepositoryInterface;
use MSP\ReLinkerApi\Api\Data\RouteInterface;
use MSP\ReLinkerApi\Api\SendMessageInterface;

class Test extends Action
{
    /**
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'MSP_ReLinker::route';

    /**
     * @var SendMessageInterface
     */
    private $sendMessage;

    /**
     * @var RouteRepositoryInterface
     */
    private $routeRepository;

    /**
     * Test constructor.
     * @param Action\Context $context
     * @param SendMessageInterface $sendMessage
     * @param RouteRepositoryInterface $routeRepository
     */
    public function __construct(
        Action\Context $context,
        SendMessageInterface $sendMessage,
        RouteRepositoryInterface $routeRepository
    ) {
        parent::__construct($context);
        $this->sendMessage = $sendMessage;
        $this->routeRepository = $routeRepository;
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        try {
            $routeId = (int)$this->getRequest()->getParam(RouteInterface::ID);
            $route = $this->routeRepository->get($routeId);
            $this->sendMessage->execute($route->getCode(), 'Test message');

            $this->messageManager->addSuccessMessage(__('Message successfully sent.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Could not send test message: %1.', $e->getMessage()));
        }

        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $result->setPath('*/*/index');

        return $result;
    }
}
