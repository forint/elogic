<?php
/**
 * Created by PhpStorm.
 * User: forint
 * Date: 4/8/19
 * Time: 9:28 PM
 */
namespace Elogic\Divine\Controller\Vendor;

class Index extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}