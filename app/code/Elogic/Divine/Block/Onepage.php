<?php
/**
 * Onepage block
 */
namespace Elogic\Divine\Block;

use Magento\Framework\View\Element\Template;

class Onepage extends Template
{
    /**
     * Retrieve serialized JS layout configuration ready to use in template
     *
     * @return string
     */
    public function getJsLayout()
    {
        return json_encode($this->jsLayout, JSON_HEX_TAG);
    }
}