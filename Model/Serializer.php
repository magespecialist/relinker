<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\ReLinker\Model;

/**
 * This is a wrapper class for standard Magento serialization
 * @package MSP\Notifier\Model
 */
class Serializer implements SerializerInterface
{
    /**
     * Serialize value
     * @param array $value
     * @return string
     * @throws \InvalidArgumentException
     */
    public function serialize(array $value): string
    {
        return json_encode($value);
    }

    /**
     * Unserialize value
     * @param string $value
     * @return array
     * @throws \InvalidArgumentException
     */
    public function unserialize(string $value): array
    {
        $res = json_decode($value);
        if (!$res) {
            return [];
        }

        return $res;
    }
}
