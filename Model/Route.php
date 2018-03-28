<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\ReLinker\Model;

use Magento\Framework\Model\AbstractExtensibleModel;

/**
 * @SuppressWarnings(PHPMD.CamelCaseMethodName)
 */
class Route extends AbstractExtensibleModel implements
    \MSP\ReLinkerApi\Api\Data\RouteInterface
{
    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(\MSP\ReLinker\Model\ResourceModel\Route::class);
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @inheritdoc
     */
    public function setName($value)
    {
        return $this->setData(self::NAME, $value);
    }

    /**
     * @inheritdoc
     */
    public function getPath()
    {
        return $this->getData(self::PATH);
    }

    /**
     * @inheritdoc
     */
    public function setPath($value)
    {
        return $this->setData(self::PATH, $value);
    }

    /**
     * @inheritdoc
     */
    public function getEnabled()
    {
        return $this->getData(self::ENABLED);
    }

    /**
     * @inheritdoc
     */
    public function setEnabled($value)
    {
        return $this->setData(self::ENABLED, $value);
    }

    /**
     * @inheritdoc
     */
    public function getProcessor()
    {
        return $this->getData(self::PROCESSOR);
    }

    /**
     * @inheritdoc
     */
    public function setProcessor($value)
    {
        return $this->setData(self::PROCESSOR, $value);
    }

    /**
     * @inheritdoc
     */
    public function getQs()
    {
        return $this->getData(self::QS);
    }

    /**
     * @inheritdoc
     */
    public function setQs($value)
    {
        return $this->setData(self::QS, $value);
    }

    /**
     * @inheritdoc
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * @inheritdoc
     */
    public function setExtensionAttributes(
        \MSP\ReLinkerApi\Api\Data\RouteExtensionInterface $extensionAttributes
    ) {
        $this->_setExtensionAttributes($extensionAttributes);
    }
}
