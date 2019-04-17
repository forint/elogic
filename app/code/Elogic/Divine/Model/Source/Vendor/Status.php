<?php
/**
 * Created by PhpStorm.
 * User: forint
 * Date: 4/15/19
 * Time: 5:29 PM
 */

namespace Elogic\Divine\Model\Source\Vendor;


class Status implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var \Elogic\Divine\Model\Vendor
     */
    protected $_vendor;

    /**
     * Constructor
     *
     * @param \Elogic\Divine\Model\Vendor $vendor
     */
    public function __construct(\Elogic\Divine\Model\Vendor $vendor)
    {
        $this->_vendor = $vendor;
    }

    /**
     * Get options
     *
     * @return array
     */
    /*public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];
        $availableOptions = $this->_vendor->getAvailableStatuses();
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }*/
    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];
        $departmentCollection = $this->_vendor->getCollection()
            ->addFieldToSelect('entity_id')
            ->addFieldToSelect('name');
        foreach ($departmentCollection as $department) {
            $options[] = [
                'label' => $department->getName(),
                'value' => $department->getId(),
            ];
        }
        return $options;
    }
}