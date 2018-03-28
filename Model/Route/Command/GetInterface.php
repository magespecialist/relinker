<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\ReLinker\Model\Route\Command;

use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Get Route by routeId command (Service Provider Interface - SPI)
 *
 * Separate command interface to which Repository proxies initial Get call, could be considered as SPI - Interfaces
 * that you should extend and implement to customize current behaviour, but NOT expected to be used (called) in the code
 * of business logic directly
 *
 * @see \MSP\ReLinkerApi\Api\RouteRepositoryInterface
 * @api
 */
interface GetInterface
{
    /**
     * Get Route data by given routeId
     *
     * @param int $routeId
     * @return \MSP\ReLinkerApi\Api\Data\RouteInterface
     * @throws NoSuchEntityException
     */
    public function execute(int $routeId): \MSP\ReLinkerApi\Api\Data\RouteInterface;
}
