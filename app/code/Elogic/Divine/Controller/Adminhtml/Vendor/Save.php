<?php
/**
 * Created by PhpStorm.
 * User: forint
 * Date: 4/15/19
 * Time: 3:14 PM
 */

namespace Elogic\Divine\Controller\Adminhtml\Vendor;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class Save extends Action
{
    /**
     * @var \Elogic\Divine\Model\Vendor
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
     * @param \Elogic\Divine\Model\Vendor $model
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Elogic\Divine\Model\Vendor\ImageUploader $imageUploader
     */
    public function __construct(
        Action\Context $context,
        \Magento\Framework\App\RequestInterface $request,
        \Elogic\Divine\Model\Vendor $model,
        \Magento\Framework\Filesystem $filesystem,
        \Elogic\Divine\Model\Vendor\ImageUploader $imageUploader
    ) {
        parent::__construct($context);
        $this->_model = $model;
        $this->_request = $request;
        $this->filesystem = $filesystem;
        $this->imageUploader = $imageUploader;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Elogic_Divine::vendor_save');
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
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

            if (is_dir($this->imageUploader->getBaseTmpPath())){
                chmod($this->imageUploader->getBaseTmpPath(), 777);
            }

            if (is_dir($this->imageUploader->getBasePath())){
                chmod($this->imageUploader->getBasePath(), 777);
            }

            $imageId = $this->_request->getParam('vendor_image', 'vendor_image');
            try {
                $result = $this->imageUploader->saveFileToTmpDir($imageId);
            } catch (\Exception $e) {
                $result = [
                    'error' => $e->getMessage(),
                    'errorcode' => $e->getCode(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ];
            }

            $model->setData($data);

            $this->_eventManager->dispatch(
                'vendors_vendor_prepare_save',
                ['vendor' => $model, 'request' => $this->getRequest()]
            );

            try {
                $model->save();
                $this->messageManager->addSuccess(__('Vendor saved'));
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
                $this->messageManager->addException($e, __('Something went wrong while saving the vendor'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['entity_id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}