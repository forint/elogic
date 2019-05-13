<?php
/**
 * Created by PhpStorm.
 * User: forint
 * Date: 5/1/19
 * Time: 4:45 AM
 */

namespace Elogic\Divine\Block\Adminhtml\Employee\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Cms\Block\Adminhtml\Block\Edit\GenericButton;

class SaveButton extends GenericButton implements ButtonProviderInterface
{
    public function getButtonData()
    {
        return [
            'label' => __('Save'),
            'class' => 'primary',
            /*'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],*/
            'on_click' => 'return false;', //sprintf("location.href= '%s';", $this->getSaveUrl())
            'sort_order' => 90
        ];
    }

    public function getSaveUrl()
    {
        return $this->getUrl('*/*/save', []) ;
    }
}
