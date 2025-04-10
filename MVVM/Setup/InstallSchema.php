<?php

declare(strict_types=1);

namespace M2\MVVM\Setup;

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
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        //START: install stuff
        //END:   install stuff

        //START table setup
        $table = $installer->getConnection()->newTable(
            $installer->getTable('M2_mvvm_thing')
        )->addColumn('thing_id', Table::TYPE_INTEGER, null,
            [
                'identity' => true,
                'nullable' => false,
                'primary' => true,
                'unsigned' => true
            ],
            'Entity ID'
        )->addColumn('title', Table::TYPE_TEXT, 255, ['nullable' => false], 'Title'
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
