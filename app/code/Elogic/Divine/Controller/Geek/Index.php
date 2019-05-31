<?php
/**
 * Created by PhpStorm.
 * User: forint
 * Date: 4/8/19
 * Time: 9:28 PM
 */
namespace Elogic\Divine\Controller\Geek;

class Index extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        return $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
    }
}