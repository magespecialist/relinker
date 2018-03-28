<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\ReLinker\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use MSP\ReLinker\Setup\Operation\CreateRouteTable;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @var CreateRouteTable
     */
    private $createRouteTable;

    /**
     * InstallSchema constructor.
     * @param CreateRouteTable $createRouteTable
     */
    public function __construct(
        CreateRouteTable $createRouteTable
    ) {
        $this->createRouteTable = $createRouteTable;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $this->createRouteTable->execute($setup);
        $setup->endSetup();
    }
}
