<?php
/**
 * Created by PhpStorm.
 * User: forint
 * Date: 4/15/19
 * Time: 2:38 PM
 */

namespace Elogic\Divine\Controller\Adminhtml\Vendor;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\ForwardFactory;

class NewAction extends Action
{
    /**
     * @var \Magento\Backend\Model\View\Result\Forward
     */
    protected $_resultForwardFactory;
    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
    ) {
        $this->_resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Elogic_Divine:vendor_save');
    }

    /**
     * Forward to edit
     *
     * @return \Magento\Backend\Model\View\Result\Forward
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Forward $resultForward */
        $resultForward = $this->_resultForwardFactory->create();
        return $resultForward->forward('edit');
    }
}