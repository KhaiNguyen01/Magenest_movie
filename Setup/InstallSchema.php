<?php
namespace Magenest\Khai\Setup;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;
class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface{
    public function install(SchemaSetupInterface $setup,ModuleContextInterface $context){
        $setup->startSetup();
        $conn = $setup->getConnection();
        $tableName = $setup->getTable('magenest_test_vendor_khai');
        if($conn->isTableExists($tableName) != true){
            $table = $conn->newTable($tableName)
                ->addColumn(
                    'id',
                    Table::TYPE_INTEGER,
                    '11',
                    ['identity'=>true,'unsigned'=>true,'nullable'=>false,'primary'=>true],
                    'ID'
                )
                ->addColumn(
                    'customer_id',
                    Table::TYPE_INTEGER,
                    '11',
                    ['nullable'=>false,'unsigned'=>true,]
                )
                ->addColumn(
                    'first_name',
                    Table::TYPE_TEXT,
                    '255',
                    ['nullable'=>false,'default'=>''],
                    'First Name'
                )
                ->addColumn(
                    'last_name',
                    Table::TYPE_TEXT,
                    '255',
                    ['nullable'=>false,'default'=>''],
                    'Last Name'
                )
                ->addColumn(
                    'email',
                    Table::TYPE_TEXT,
                    '255',
                    ['nullable'=>false,'default'=>''],
                    'Email'
                )
                ->addColumn(
                    'company',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable'=>false,'default'=>''],
                    'First Name'
                )
                ->addColumn(
                    'phone_number',
                    Table::TYPE_TEXT,
                    '15',
                    ['nullable'=>false,'default'=>''],
                    'Phone Number'
                )
                ->addColumn(
                    'fax',
                    Table::TYPE_TEXT,
                    '20',
                    ['nullable'=>false,'default'=>''],
                    'Fax'
                )
                ->addColumn(
                    'address',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable'=>false,'default'=>''],
                    'Address'
                )
                ->addColumn(
                    'street',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable'=>false,'default'=>''],
                    'Street'
                )
                ->addColumn(
                    'country',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable'=>false,'default'=>''],
                    'Country'
                )
                ->addColumn(
                    'city',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable'=>false,'default'=>''],
                    'City'
                )
                ->addColumn(
                    'postcode',
                    Table::TYPE_TEXT,
                    '20',
                    ['nullable'=>false,'default'=>''],
                    'Postcode'
                )
                ->addColumn(
                    'total_sales',
                    Table::TYPE_FLOAT,
                    '11',
                    ['nullable'=>false],
                    'Total Sales'
                )
                ->setOption('charset','utf8');
            $conn->createTable($table);
        }
        $setup->endSetup();
    }
}
