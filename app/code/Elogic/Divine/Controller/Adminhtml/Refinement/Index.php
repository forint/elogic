<?php
namespace Elogic\Divine\Controller\Adminhtml\Refinement;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;

class Index extends Action
{
    const ADMIN_RESOURCE = 'Elogic_Divine::refinement';

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
        $resultPage->setActiveMenu('Elogic_Divine::Refinement');
        $resultPage->addBreadcrumb(__('Refinement'), __('Refinement'));
        $resultPage->addBreadcrumb(__('Main'), __('Main'));
        $resultPage->getConfig()->getTitle()->prepend(__('Refinement'));

        return $resultPage;
    }
}