<?php
namespace Elogic\Divine\Model;

use Elogic\Divine\Model\ResourceModel\Vendor as Model;
use \Magento\Framework\Model\AbstractModel;

class Employee extends AbstractModel
{
    const ENTITY = 'elogic_employee';

    const EMPLOYEE_ID = 'entity_id'; // We define the id fieldname

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'employees'; // parent value is 'core_abstract'

    /**
     * Name of the event object
     *
     * @var string
     */
    protected $_eventObject = 'employee'; // parent value is 'object'

    /**
     * Name of object id field
     *
     * @var string
     */
    protected $_idFieldName = self::EMPLOYEE_ID; // parent value is 'id'

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct() {
        $this->_init(Model::class);
    }

    public function getEnableStatus() {
        return 1;
    }

    public function getDisableStatus() {
        return 0;
    }

    public function getAvailableStatuses() {
        return [
            $this->getDisableStatus() => __('Disabled'),
            $this->getEnableStatus() => __('Enabled')
        ];
    }
}