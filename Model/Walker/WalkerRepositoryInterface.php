<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\ReLinker\Model\Walker;

use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Interface WalkerRepositoryInterface
 * @package MSP\ReLinker\Model\Processor
 * @api
 */
interface WalkerRepositoryInterface
{
    /**
     * @return array
     */
    public function getList(): array;

    /**
     * @param string $code
     * @return WalkerInterface
     * @throws NoSuchEntityException
     */
    public function getByCode(string $code): WalkerInterface;
}
