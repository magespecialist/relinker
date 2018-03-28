<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\ReLinker\Model\Source\Route;

use Magento\Framework\Option\ArrayInterface;
use MSP\ReLinkerApi\Api\ProcessorRepositoryInterface;

class Processor implements ArrayInterface
{
    /**
     * @var ProcessorRepositoryInterface
     */
    private $processorRepository;

    /**
     * Adapter constructor.
     * @param ProcessorRepositoryInterface $processorRepository
     */
    public function __construct(
        ProcessorRepositoryInterface $processorRepository
    ) {
        $this->processorRepository = $processorRepository;
    }

    /**
     * @inheritdoc
     */
    public function toOptionArray()
    {
        $adapters = $this->processorRepository->getList();

        $res = [];
        foreach ($adapters as $adapter) {
            $res[] = [
                'value' => $adapter->getCode(),
                'label' => $adapter->getDescription(),
            ];
        }

        return $res;
    }
}
