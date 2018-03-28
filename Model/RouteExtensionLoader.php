<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\ReLinker\Model;

class RouteExtensionLoader implements \MSP\ReLinker\Model\RouteExtensionLoaderInterface
{
    /**
     * @var \MSP\ReLinkerApi\Api\Data\RouteExtensionFactory
     */
    private $extensionFactory;

    /**
     * Extension loader constructor.
     * @param \MSP\ReLinkerApi\Api\Data\RouteExtensionFactory $extensionFactory
     * @SuppressWarnings(PHPMD.LongVariables)
     */
    public function __construct(
        \MSP\ReLinkerApi\Api\Data\RouteExtensionFactory $extensionFactory
    ) {
        $this->extensionFactory = $extensionFactory;
    }

    /**
     * @inheritdoc
     */
    public function execute(\MSP\ReLinkerApi\Api\Data\RouteInterface $route)
    {
        if ($route->getExtensionAttributes() === null) {
            $extension = $this->extensionFactory->create();
            $route->setExtensionAttributes($extension);
        }
    }
}
