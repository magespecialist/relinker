<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\ReLinker\Model;

use MSP\ReLinkerApi\Api\Data\RouteInterface;

/**
 * Interface ProcessorManagerInterface
 * @api
 */
interface ProcessorsManagerInterface
{
    /**
     * Locate and run a processor
     * @param string $processorCodes
     * @param RouteInterface $route
     * @param string $path
     * @return string
     */
    public function execute(string $processorCodes, RouteInterface $route, string $path): string;
}
