<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\ReLinker\Model\PostProcessor;

use MSP\ReLinkerApi\Api\Data\RouteInterface;

class PostProcessorChain implements PostProcessorInterface
{
    /**
     * @var PostProcessorInterface[]
     */
    private $processors;

    /**
     * PostProcessorChain constructor.
     * @param array $processors
     */
    public function __construct(
        array $processors
    ) {
        $this->processors = $processors;

        foreach ($this->processors as $processorCode => $processor) {
            if (!($processor instanceof PostProcessorInterface)) {
                throw new \InvalidArgumentException(
                    'Processor %1 must implement PostProcessorInterface',
                    $processorCode
                );
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function execute(string $url, RouteInterface $route, string $path): string
    {
        foreach ($this->processors as $processor) {
            $url = $processor->execute($url, $route, $path);
        }

        return $url;
    }
}
