<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\ReLinker\Model\Walker;

use Magento\Framework\Exception\NoSuchEntityException;

class WalkerRepository implements WalkerRepositoryInterface
{
    /**
     * @var WalkerInterface[]
     */
    private $walkers;

    /**
     * WalkerRepository constructor.
     * @param array $walkers
     */
    public function __construct(
        array $walkers
    ) {
        $this->walkers = $walkers;

        foreach ($this->walkers as $walkerCode => $walker) {
            if (!($walker instanceof WalkerInterface)) {
                throw new \InvalidArgumentException('Walker %1 must implement WalkerInterface', $walkerCode);
            }
        }
    }

    /**
     * @return array
     */
    public function getList(): array
    {
        return $this->walkers;
    }

    /**
     * @param string $code
     * @return WalkerInterface
     * @throws NoSuchEntityException
     */
    public function getByCode(string $code): WalkerInterface
    {
        if (!isset($this->walkers[$code])) {
            throw new NoSuchEntityException('Walker with code %1 does not exist', $code);
        }

        return $this->walkers[$code];
    }
}
