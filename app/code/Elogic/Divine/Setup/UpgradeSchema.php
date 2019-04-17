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
use Magento\Framework\DB\Ddl\Table;

/**
 * @codeCoverageIgnore
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
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
            $tableName = $installer->getTable('elogic_divine_vendor');
            $fullTextIntex = array('name', 'description'); // Column with fulltext index, you can put multiple fields


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
                'elogic_divine_vendor',
                'status',
                [
                    'type' =>  \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    'default' => 0,
                    'comment' => 'Status'
                ]
            );

        }

        $installer->endSetup();
    }
}