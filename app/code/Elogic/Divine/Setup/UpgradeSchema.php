<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Elogic\Divine\Setup;

use Elogic\Divine\Model\Vendor;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\DB\Ddl\Table;

/** For Attribute create  */
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;

/**
 * @codeCoverageIgnore
 */
class UpgradeSchema implements UpgradeSchemaInterface
{

    /**
     * EAV setup factory
     *
     * @var EavSetupFactory
     */
    private $_eavSetupFactory;

    /**
     * EAV resource setup interface for a module
     *
     * @var EavSetupFactory
     */
    private $_moduleDataSetup;

    /**
     * Init
     *
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory,
        \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup
    )
    {
        $this->_moduleDataSetup = $moduleDataSetup;
        $this->_eavSetupFactory = $eavSetupFactory;
    }

    /**
     * Upgrades DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        // Action to do if module version is less than 1.0.0.2
        if (version_compare($context->getVersion(), '1.0.0.2') < 0) {

            /**
             * Add full text index to our table vendor
             */
            $tableName = $installer->getTable('elogic_divine_vendor_product');
            $fullTextIntex = array('name'); // Column with fulltext index, you can put multiple fields


            $setup->getConnection()->addIndex(
                $tableName,
                $installer->getIdxName($tableName, $fullTextIntex, \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT),
                $fullTextIntex,
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );

        }
        // Action to do if module version is less than 1.0.0.3
        if (version_compare($context->getVersion(), '1.0.0.3') < 0) {

            /**
             * Add status column to our table vendor
             */
            $setup->getConnection()->addColumn(
                'elogic_divine_vendor_product',
                'status',
                [
                    'type' =>  \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    'default' => 0,
                    'comment' => 'Status'
                ]
            );

        }
        // Action to do if module version is less than 1.0.0.4
        if (version_compare($context->getVersion(), '1.0.0.4') < 0) {

            /**
             * Add status column to our table vendor
             */
            $installer = $setup;
            $installer->startSetup();

            /**
             * Create table 'elogic_divine_employee'
             */
            $employeeTable = 'elogic_divine_employee';
            $tableName = $installer->getTable($employeeTable);

            $tableComment = 'Employee for products from Elogic Divine module';
            $columns = array(
                'entity_id' => array(
                    'type' => Table::TYPE_INTEGER,
                    'size' => null,
                    'options' => array('identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true),
                    'comment' => 'Employee Id',
                ),
                'name' => array(
                    'type' => Table::TYPE_TEXT,
                    'size' => 255,
                    'options' => array('nullable' => false, 'default' => ''),
                    'comment' => 'Employee name',
                ),
                'salary' => array(
                    'type' => Table::TYPE_TEXT,
                    'size' => 255,
                    'options' => array('nullable' => false, 'default' => ''),
                    'comment' => 'Employee salary',
                ),
                'description' => array(
                    'type' => Table::TYPE_TEXT,
                    'size' => 2048,
                    'options' => array('nullable' => false, 'default' => ''),
                    'comment' => 'Vendor description',
                ),
                'address' => array(
                    'type' => Table::TYPE_TEXT,
                    'size' => 255,
                    'options' => array('nullable' => false, 'default' => ''),
                    'comment' => 'Employee description',
                ),
                'date' => array(
                    'type' => Table::TYPE_DATETIME,
                    'size' => null,
                    'options' => array('nullable' => false, 'default' => new \Zend_Db_Expr('CURRENT_TIMESTAMP')),
                    'comment' => 'Employee date',
                )
            );

            /** CREATE FULLTEXT INDEX title_body ON articles(title,body) */
            $indexes =  array(
                'name',
                'salary',
                'address'
                // No index for this table
            );

            $foreignKeys = array(
                // No foreign keys for this table
            );

            /**
             *  We can use the parameters above to create our table
             */

            // Table creation
            $table = $installer->getConnection()->newTable($tableName);

            // Columns creation
            foreach($columns AS $name => $values){
                $table->addColumn(
                    $name,
                    $values['type'],
                    $values['size'],
                    $values['options'],
                    $values['comment']
                );
            }

            // Indexes creation
            foreach($indexes AS $index){
                $table->addIndex(
                    $installer->getIdxName($tableName, array($index)),
                    array($index)
                );
            }

            // Foreign keys creation
            foreach($foreignKeys AS $column => $foreignKey){
                $table->addForeignKey(
                    $installer->getFkName($tableName, $column, $foreignKey['ref_table'], $foreignKey['ref_column']),
                    $column,
                    $foreignKey['ref_table'],
                    $foreignKey['ref_column'],
                    $foreignKey['on_delete']
                );
            }

            // Table comment
            $table->setComment($tableComment);

            // Execute SQL to create the table
            $installer->getConnection()->createTable($table);

            // End Setup
            $installer->endSetup();

        }

        $installer->endSetup();
    }
}