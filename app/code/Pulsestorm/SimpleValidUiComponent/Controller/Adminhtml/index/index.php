<?php
namespace Pulsestorm\SimpleValidUiComponent\Controller\Adminhtml\index;
class index extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Pulsestorm_SimpleValidUiComponent::pulsestorm_simplevaliduicomponent_menu';

    protected $resultPageFactory;
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        return $this->resultPageFactory->create();
    }
}
