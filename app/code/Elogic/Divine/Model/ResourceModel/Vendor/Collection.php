<?php
namespace Elogic\Divine\Model\ResourceModel\Vendor;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected $_idFieldName = \Elogic\Divine\Model\Vendor::VENDOR_ID;

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Elogic\Divine\Model\Vendor', 'Elogic\Divine\Model\ResourceModel\Vendor');
    }

}