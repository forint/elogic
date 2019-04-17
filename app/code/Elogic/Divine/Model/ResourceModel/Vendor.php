<?php
namespace Elogic\Divine\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Department post mysql resource
 */
class Vendor extends AbstractDb
{

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        // Table Name and Primary Key column
        $this->_init('elogic_divine_vendor', 'entity_id');
    }

}