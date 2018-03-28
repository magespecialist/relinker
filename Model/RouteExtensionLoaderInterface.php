<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\ReLinker\Model;

/**
 * Extension attribute loader for Route
 *
 * @api
 */
interface RouteExtensionLoaderInterface
{
    /**
     * Load extension attributes
     * @param \MSP\ReLinkerApi\Api\Data\RouteInterface $route
     */
    public function execute(\MSP\ReLinkerApi\Api\Data\RouteInterface $route);
}
