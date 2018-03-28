<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\ReLinker\Setup\Operation;

use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\SchemaSetupInterface;

class CreateRouteTable
{
    const TABLE_NAME_ROUTE = 'msp_relinker_route';

    /**
     * @param SchemaSetupInterface $setup
     * @return void
     * @throws \Zend_Db_Exception
     */
    public function execute(SchemaSetupInterface $setup)
    {
        $table = $setup->getConnection()->newTable(
            $setup->getTable(self::TABLE_NAME_ROUTE)
        )->setComment(
            'MSP ReLinker Routing Table'
        );

        $table = $this->addFields($table);
        $table = $this->addIndexes($setup, $table);

        $setup->getConnection()->createTable($table);
    }

    /**
     * Add fields
     * @param Table $table
     * @return Table
     * @throws \Zend_Db_Exception
     */
    private function addFields(Table $table): Table
    {
        $table
            ->addColumn(
                'route_id',
                Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'unsigned' => true,
                    'nullable' => false,
                    'primary' => true,
                ],
                'Route ID'
            )
            ->addColumn(
                'name',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => false,
                ],
                'Route Name'
            )
            ->addColumn(
                'path',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => true,
                ],
                'Route Path'
            )
            ->addColumn(
                'processor',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => true,
                ],
                'Processor'
            )
            ->addColumn(
                'enabled',
                Table::TYPE_BOOLEAN,
                null,
                [
                    'nullable' => false,
                ],
                'Enabled'
            );

        return $table;
    }

    /**
     * Add indexes
     * @param SchemaSetupInterface $setup
     * @param Table $table
     * @return Table
     * @throws \Zend_Db_Exception
     */
    private function addIndexes(SchemaSetupInterface $setup, Table $table): Table
    {
        $table
            ->addIndex(
                $setup->getIdxName(
                    self::TABLE_NAME_ROUTE,
                    ['path'],
                    AdapterInterface::INDEX_TYPE_UNIQUE
                ),
                [['name' => 'path', 'size' => 128]],
                ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]
            );

        return $table;
    }
}
