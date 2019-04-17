<?php
namespace Elogic\Divine\Controller\Adminhtml\Vendor;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;

class Index extends Action
{
    const ADMIN_RESOURCE = 'Elogic_Divine::vendor';

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
        $resultPage->setActiveMenu('Elogic_Divine::vendor');
        $resultPage->addBreadcrumb(__('Vendors'), __('Vendors'));
        $resultPage->addBreadcrumb(__('Manage Vendors'), __('Manage Vendors'));
        $resultPage->getConfig()->getTitle()->prepend(__('Vendor'));

        return $resultPage;
    }
}