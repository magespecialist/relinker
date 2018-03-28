<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\ReLinker\Model\Route\Command;

use Magento\Framework\Exception\NoSuchEntityException;

/**
 * @inheritdoc
 */
class Get implements GetInterface
{
    /**
     * @var \MSP\ReLinker\Model\ResourceModel\Route
     */
    private $resource;

    /**
     * @var \MSP\ReLinkerApi\Api\Data\RouteInterfaceFactory
     */
    private $factory;

    /**
     * @param \MSP\ReLinker\Model\ResourceModel\Route $resource
     * @param \MSP\ReLinkerApi\Api\Data\RouteInterfaceFactory $factory
     */
    public function __construct(
        \MSP\ReLinker\Model\ResourceModel\Route $resource,
        \MSP\ReLinkerApi\Api\Data\RouteInterfaceFactory $factory
    ) {
        $this->resource = $resource;
        $this->factory = $factory;
    }

    /**
     * @inheritdoc
     */
    public function execute(int $routeId): \MSP\ReLinkerApi\Api\Data\RouteInterface
    {
        /** @var \MSP\ReLinkerApi\Api\Data\RouteInterface $route */
        $route = $this->factory->create();
        $this->resource->load(
            $route,
            $routeId,
            \MSP\ReLinkerApi\Api\Data\RouteInterface::ID
        );

        if (null === $route->getId()) {
            throw new NoSuchEntityException(__('Route with id "%value" does not exist.', [
                'value' => $routeId
            ]));
        }

        return $route;
    }
}
