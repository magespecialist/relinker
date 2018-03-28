<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\ReLinker\Model;

use Magento\Framework\Exception\NoSuchEntityException;
use MSP\ReLinkerApi\Api\Data\RouteInterface;
use MSP\ReLinkerApi\Api\ProcessorRepositoryInterface;

class ProcessorsManager implements ProcessorsManagerInterface
{
    /**
     * @var ProcessorRepositoryInterface
     */
    private $processorRepository;

    /**
     * ProcessorManager constructor.
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
    public function execute(string $processorCode, RouteInterface $route, string $path): string
    {
        try {
            $processor = $this->processorRepository->getProcessorByCode($processorCode);
        } catch (NoSuchEntityException $e) {
            return '';
        }

        // Iterating to keep the same order of repository and guarantee processors priority
        $res = $processor->execute($route, $path);
        if ($res !== '') {
            return $res;
        }

        return '';
    }
}
