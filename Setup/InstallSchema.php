<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace JonathanMartz\WebApiStats\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Zend_Db_Exception;

class InstallSchema implements InstallSchemaInterface
{
    public $table = 'webapi_stats_request';

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $connection = $setup->getConnection();

        if(!$connection->isTableExists($this->table)) {
            try {
                $table = $connection->newTable($setup->getTable($this->table))
                    ->addColumn(
                        'id',
                        Table::TYPE_INTEGER,
                        null,
                        ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                        'Id'
                    );

                $table->addColumn(
                    'url',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false, 'default' => ''],
                    'Url'
                );

                $table->addColumn(
                    'loggedin',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false, 'default' => ''],
                    'Logged In'
                );

                $table->addColumn(
                    'session',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false, 'default' => ''],
                    'session'
                );

                $table->addColumn(
                    'url',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false, 'default' => ''],
                    'Message'
                );

                $connection->createTable($table);
            }
            catch(Zend_Db_Exception $e) {
            }
        }
        else {
            $connection->dropTable($this->table);
        }
    }
}