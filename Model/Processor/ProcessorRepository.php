<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\ReLinker\Model\Processor;

use Magento\Framework\Exception\NoSuchEntityException;
use MSP\ReLinkerApi\Api\Data\ProcessorInterface;
use MSP\ReLinkerApi\Api\ProcessorRepositoryInterface;

class ProcessorRepository implements ProcessorRepositoryInterface
{
    /**
     * @var ProcessorInterface[]
     */
    private $processors;

    /**
     * ProcessorRepository constructor.
     * @param array $processors
     */
    public function __construct(
        array $processors
    ) {
        $this->processors = $processors;

        foreach ($this->processors as $processorCode => $processor) {
            if (!($processor instanceof ProcessorInterface)) {
                throw new \InvalidArgumentException('Processor %1 must implement ProcessorInterface', $processorCode);
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function getList(): array
    {
        return $this->processors;
    }

    /**
     * @inheritdoc
     */
    public function getProcessorByCode(string $code): ProcessorInterface
    {
        if (!isset($this->processors[$code])) {
            throw new NoSuchEntityException('Processor with cde %1 does not exist', $code);
        }

        return $this->processors[$code];
    }
}
