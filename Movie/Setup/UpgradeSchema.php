<?php

namespace Magenest\Movie\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup,
                            ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '2.0.6') < 0) {
            $installer = $setup;
            $installer->startSetup();
            $connection = $installer->getConnection();
//Install new database table
            //table magenest_movie
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magenest_movie')
            )->addColumn(
                'movie_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                10, [
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true
            ],
                'Movie Id'
            )->addColumn('created_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null, [
                    'nullable' => false,
                    'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT
                ],
                'Created at'
            )->addColumn(
                'updated_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                [],
                'Updated at'
            )->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Name'
            )->addColumn(
                'description',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Description'
            )->addColumn(
                'rating',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                10,
                ['nullable' => false],
                'Rating'
            )->addColumn(
                'director_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                10, [
                'unsigned' => true,
                'nullable' => false
            ],
                'Director ID'
            )->addForeignKey(
                $installer->getFkName('magenest_movie', 'director_id', 'magenest_director', 'director_id'),
                'director_id',
                $installer->getTable('magenest_director'), /* main table name */
                'director_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )->addIndex(
                $installer->getIdxName('magenest_movie',
                    ['movie_id']),
                ['movie_id']
            );
            $installer->getConnection()->createTable($table);
            $installer->endSetup();

            //table magenest_director
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magenest_director')
            )->addColumn(
                'director_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                10, [
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true
            ],
                'Director Id'
            )->addColumn('name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null, [
                    'nullable' => false,
                ],
                'Name'
            )->addIndex(
                $installer->getIdxName('magenest_director',
                    ['director_id']),
                ['director_id']
            );

            $installer->getConnection()->createTable($table);
            $installer->endSetup();

            //table magenest_actor
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magenest_actor')
            )->addColumn(
                'actor_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                10, [
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true
            ],
                'Actor Id'
            )->addColumn('name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null, [
                    'nullable' => false,
                ],
                'Name'
            )->addIndex(
                $installer->getIdxName('magenest_actor',
                    ['actor_id']),
                ['actor_id']
            );

            $installer->getConnection()->createTable($table);
            $installer->endSetup();

            //table magenest_movie_actor
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magenest_movie_actor')
            )->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                10, [
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true
            ],
                'Id'
            )->addColumn(
                'movie_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                10, [
                'unsigned' => true,
                'nullable' => false
            ],
                'Movie Id'
            )->addForeignKey(
                $installer->getFkName('magenest_movie_actor', 'movie_id', 'magenest_movie', 'movie_id'),
                'movie_id',
                $installer->getTable('magenest_movie'), /* main table name */
                'movie_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )->addColumn(
                'actor_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                10, [
                'unsigned' => true,
                'nullable' => false
            ],
                'Actor Id'
            )->addForeignKey(
                $installer->getFkName('magenest_movie_actor', 'actor_id', 'magenest_actor', 'actor_id'),
                'actor_id',
                $installer->getTable('magenest_actor'), /* main table name */
                'actor_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )->addIndex(
                $installer->getIdxName('magenest_movie_actor',
                    ['movie_id']),
                ['movie_id']
            );

            $installer->getConnection()->createTable($table);
            $installer->endSetup();
        }
    }
}