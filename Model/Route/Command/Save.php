<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\ReLinker\Model\Route\Command;

use Magento\Framework\Exception\CouldNotSaveException;
use Psr\Log\LoggerInterface;

/**
 * @inheritdoc
 */
class Save implements SaveInterface
{
    /**
     * @var \MSP\ReLinker\Model\ResourceModel\Route
     */
    private $resource;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param \MSP\ReLinker\Model\ResourceModel\Route $resource
     * @param LoggerInterface $logger
     */
    public function __construct(
        \MSP\ReLinker\Model\ResourceModel\Route $resource,
        LoggerInterface $logger
    ) {
        $this->resource = $resource;
        $this->logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public function execute(\MSP\ReLinkerApi\Api\Data\RouteInterface $route): int
    {
        try {
            $this->resource->save($route);
            return (int) $route->getId();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new CouldNotSaveException(__('Could not save Route'), $e);
        }
    }
}
