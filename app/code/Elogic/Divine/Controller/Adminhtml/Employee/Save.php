<?php
/**
 * Created by PhpStorm.
 * User: forint
 * Date: 4/15/19
 * Time: 3:14 PM
 */

namespace Elogic\Divine\Controller\Adminhtml\Employee;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Elogic\Divine\Block\Adminhtml\Employee\Edit\SaveButton;

class Save extends Action
{
    /**
     * @var \Magento\Backend\App\Action\Context
     */
    protected $_context;
    /**
     * @var \Elogic\Divine\Model\Employee
     */
    protected $_model;
    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $_request;
    /**
     * @var \Magento\Framework\Filesystem
     */
    protected $filesystem;
    /**
     * @var \Magento\Framework\Filesystem
     */
    protected $imageUploader;

    /**
     * @param Action\Context $context
     * @param \Magento\Framework\App\RequestInterface $request
     * @param \Elogic\Divine\Model\Employee $model
     */
    public function __construct(
        Action\Context $context,
        \Magento\Framework\App\RequestInterface $request,
        \Elogic\Divine\Model\Vendor $model
    ) {
        parent::__construct($context);
        $this->_context = $context;
        $this->_model = $model;
        $this->_request = $request;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Elogic_Divine::employee_save');
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {

        print_r($this->_context->getBackendUrl()->getUrl('employees'));die;
       /* print_r('<pre>');
        print_r(get_class($this->_context->getObjectManager()->get('')));
        print_r('</pre>');*/
        print_r('<pre>');
        print_r(get_class($this->_context->getBackendUrl()));
        print_r(get_class_methods($this->_context->getBackendUrl()));
        // print_r($this->_context->getBackendUrl());
        print_r('</pre>');
        die;
        $objectManager = $this->_context;
        die('incur');
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            /** @var \Elogic\Divine\Model\Vendor $model */
            $model = $this->_model;

            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
            }
            $model->setData($data);

            $this->_eventManager->dispatch(
                'employees_employee_prepare_save',
                ['employee' => $model, 'request' => $this->getRequest()]
            );

            try {
                $model->save();
                $this->messageManager->addSuccess(__('Employee saved'));
                $this->_getSession()->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the employee'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['entity_id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}