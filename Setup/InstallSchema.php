<?php
namespace Khai\ManufacturerEntity\Setup;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;
class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface{
    public function install(SchemaSetupInterface $setup,ModuleContextInterface $context){
        $setup->startSetup();
        $conn = $setup->getConnection();
        $tableName = $setup->getTable('manufacturer_entity');
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
                    '255',
                    ['nullable'=>false,'default'=>''],
                    'Name'
                )
                ->addColumn(
                    'enabled',
                    Table::TYPE_INTEGER,
                    '1',
                    ['nullable'=>false,'default'=>'1']
                )
                ->addColumn(
                    'address_street',
                    Table::TYPE_TEXT,
                    '255',
                    ['nullable'=>false,'default'=>''],
                    'Manufacturer Street'
                )
                ->addColumn(
                    'address_city',
                    Table::TYPE_TEXT,
                    '100',
                    ['nullable'=>false,'default'=>''],
                    'Manufacturer City'
                )
                ->addColumn(
                    'address_country',
                    Table::TYPE_TEXT,
                    '100',
                    ['nullable'=>false,'default'=>''],
                    'Manufacturer Country'
                )
                ->addColumn(
                    'contact_name',
                    Table::TYPE_TEXT,
                    '100',
                    ['nullable'=>false,'default'=>''],
                    'Contact Name'
                )
                ->addColumn(
                    'contact_phone',
                    Table::TYPE_TEXT,
                    '20',
                    ['nullable'=>false,'default'=>''],
                    'Contact Phone'
                )
                ->setOption('charset','utf8');
            $conn->createTable($table);
        }
        $setup->endSetup();
    }
}
