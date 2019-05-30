<?php
/**
 * Skip XSD validation for XML files
 *
 */
namespace Pulsestorm\SimpleUiComponent\Model;

class ValidationState extends \Magento\Framework\App\Arguments\ValidationState
{
    public function isValidationRequired()
    {
        return false;
    }
}