<?php
namespace Khai\Parttime\Setup;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;
class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface{
    public function install(SchemaSetupInterface $setup,ModuleContextInterface $context){
        $setup->startSetup();
        $conn = $setup->getConnection();
        $tableName = $setup->getTable('magenest_part_time');
        if($conn->isTableExists($tableName) != true){
            $table = $conn->newTable($tableName)
                ->addColumn(
                    'id',
                    Table::TYPE_INTEGER,
                    null,
                    ['identity'=>true,'unsigned'=>true,'nullable'=>false,'primary'=>true],
                    'ID'
                )
                ->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    '100',
                    ['nullable'=>false,'default'=>''],
                    'Customer Name'
                )
                ->addColumn(
                    'address',
                    Table::TYPE_TEXT,
                    '255',
                    ['nullable'=>false,'default'=>''],
                    'Customer Address'
                )
                ->addColumn(
                    'phone',
                    Table::TYPE_TEXT,
                    '25',
                    ['nullable'=>false,'default'=>''],
                    'Customer Phone'
                )
                ->addColumn(
                    'created_time',
                    \Magento\Framework\Db\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false],
                    'Created Time'
                )
                ->addColumn(
                    'updated_time',
                    \Magento\Framework\Db\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\Db\Ddl\Table::TIMESTAMP_INIT],
                    'Updated Time'
                )
                ->setOption('charset','utf8');
            $conn->createTable($table);
        }
        $setup->endSetup();
    }
}
