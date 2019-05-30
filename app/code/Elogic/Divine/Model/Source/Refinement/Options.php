<?php
/**
 * Created by PhpStorm.
 * User: forint
 * Date: 4/15/19
 * Time: 5:29 PM
 */

namespace Elogic\Divine\Model\Source\Refinement;


class Options implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * Options array.
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            ['value' => '0', 'label' => __('Inactive')],
            ['value' => '1', 'label' => __('Active')],
        ];

        return $options;
    }
}