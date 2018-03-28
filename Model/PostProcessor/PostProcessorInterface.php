<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\ReLinker\Model\PostProcessor;

use Magento\Framework\App\ActionInterface;
use MSP\ReLinkerApi\Api\Data\RouteInterface;

/**
 * Interface PostProcessorInterface
 * @api
 */
interface PostProcessorInterface
{
    /**
     * Execute postprocessor
     * @param string $url
     * @param RouteInterface $route
     * @param string $path
     * @return ActionInterface
     */
    public function execute(string $url, RouteInterface $route, string $path): string;
}
