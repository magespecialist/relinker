<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\ReLinker\Model\Walker;

use MSP\ReLinkerApi\Api\Data\RouteInterface;

interface WalkerInterface
{
    /**
     * @param RouteInterface $route
     * @param callable $callback
     * @return void
     */
    public function execute(RouteInterface $route, callable $callback);
}
