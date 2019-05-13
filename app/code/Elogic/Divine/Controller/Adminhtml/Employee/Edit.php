<?php
/**
 * Created by PhpStorm.
 * User: forint
 * Date: 4/27/19
 * Time: 3:50 AM
 */

namespace Elogic\Divine\Controller\Adminhtml\Employee;

use Magento\Framework\Controller\ResultFactory;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        return $resultPage;
    }
}