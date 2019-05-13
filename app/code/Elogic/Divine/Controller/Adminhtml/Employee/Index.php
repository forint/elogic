<?php
namespace Elogic\Divine\Controller\Adminhtml\Employee;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;

class Index extends Action
{
    const ADMIN_RESOURCE = 'Elogic_Divine::employee';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Elogic_Divine::employee');
        $resultPage->addBreadcrumb(__('Employees'), __('Employees'));
        $resultPage->addBreadcrumb(__('Manage Employees'), __('Manage Employees'));
        $resultPage->getConfig()->getTitle()->prepend(__('Employees'));

        return $resultPage;
    }
}