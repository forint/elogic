<?php
/**
 * Created by PhpStorm.
 * User: forint
 * Date: 4/26/19
 * Time: 10:40 PM
 */

namespace Elogic\Divine\Block\Adminhtml\System\Config;


class Advanced extends \Magento\Config\Block\System\Config\Form\Field
{
    /**
     * Template path
     *
     * @var string
     */
    protected $_template = 'system/config/advance/check.phtml';

    /**
     * Render fieldset html
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        //$columns = $this->getRequest()->getParam('website') || $this->getRequest()->getParam('store') ? 5 : 4;
        return $this->_decorateRowHtml($element, "<td class='label'>Label Text</td><td>" . $this->toHtml() . '</td><td></td>');
    }
}