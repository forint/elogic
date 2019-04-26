<?php
namespace Elogic\Divine\Model\ResourceModel\Vendor;

use Elogic\Divine\Model\Vendor as Model;
use Elogic\Divine\Model\ResourceModel\Vendor as ResourceModel;
use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected $_idFieldName = Model::VENDOR_ID;

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
        // $this->_init('Elogic\Divine\Model\Vendor', 'Elogic\Divine\Model\ResourceModel\Vendor');
    }

}