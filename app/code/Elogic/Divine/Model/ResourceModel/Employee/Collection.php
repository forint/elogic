<?php
namespace Elogic\Divine\Model\ResourceModel\Employee;

use Elogic\Divine\Model\Employee as Model;
use Elogic\Divine\Model\ResourceModel\Employee as ResourceModel;
use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected $_idFieldName = Model::EMPLOYEE_ID;

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }

}