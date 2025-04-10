<?php

namespace M2\CRUD\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Zend_Db_Exception;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @inheritDoc
     * @throws Zend_Db_Exception
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();
        //START: install stuff
        //END:   install stuff

        //START table setup
        $table = $installer->getConnection()->newTable(
            $installer->getTable('M2_crud_item')
        )->addColumn('item_id', Table::TYPE_INTEGER, null,
            [
                'identity' => true,
                'nullable' => false,
                'primary' => true,
                'unsigned' => true
            ],
            'Entity ID'
        )->addColumn('item_sku', Table::TYPE_TEXT, 255, ['nullable' => false], 'Sku of the item'
        )->addColumn('item_title', Table::TYPE_TEXT, 255, ['nullable' => false], 'Title of the item'
        )->addColumn('date_completed', Table::TYPE_DATETIME, null, ['nullable' => true], 'Date of completion'
        )->addColumn('creation_time', Table::TYPE_TIMESTAMP, null,
            [
                'nullable' => false,
                'default' => Table::TIMESTAMP_INIT
            ],
            'Creation Time'
        )->addColumn('update_time', Table::TYPE_TIMESTAMP, null,
            [
                'nullable' => false,
                'default' => Table::TIMESTAMP_INIT_UPDATE
            ],
            'Modification Time'
        )->addColumn('is_active', Table::TYPE_SMALLINT, null,
            [
                'nullable' => false,
                'default' => '1'
            ],
            'Is Active'
        );
        $installer->getConnection()->createTable($table);
        //END   table setup
        $installer->endSetup();
    }
}
