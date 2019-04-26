<?php
/**
 * Created by PhpStorm.
 * User: forint
 * Date: 4/26/19
 * Time: 7:16 PM
 */
namespace Elogic\Divine\Block\Vendor;

class ListVendor extends \Magento\Framework\View\Element\Template
{
    protected $_vendor;

    protected $_resource;

    protected $_vendorCollection = null;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Elogic\Divine\Model\Vendor $vendor
     * @param \Magento\Framework\App\ResourceConnection $resource
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Elogic\Divine\Model\Vendor $vendor,
        \Magento\Framework\App\ResourceConnection $resource,
        array $data = []
    ) {
        $this->_vendor = $vendor;
        $this->_resource = $resource;

        parent::__construct(
            $context,
            $data
        );
    }

    /**
     * @override
     *
     * @return $this|\Magento\Framework\View\Element\Template
     * @throws \Magento\Framework\Exception\LocalizedException
     *
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        // You can put these informations editable on BO
        $title = __('We are hiring');
        $description = __('Look at the vendors we have got for you');
        $keywords = __('vendor,hiring');

        $this->getLayout()->createBlock('Magento\Catalog\Block\Breadcrumbs');

        if ($breadcrumbsBlock = $this->getLayout()->getBlock('breadcrumbs')) {
            $breadcrumbsBlock->addCrumb(
                'vendors',
                [
                    'label' => $title,
                    'title' => $title,
                    'link' => false // No link for the last element
                ]
            );
        }

        $this->pageConfig->getTitle()->set($title);
        $this->pageConfig->setDescription($description);
        $this->pageConfig->setKeywords($keywords);


        $pageMainTitle = $this->getLayout()->getBlock('page.main.title');
        if ($pageMainTitle) {
            $pageMainTitle->setPageTitle($title);
        }

        return $this;
    }

    protected function _getVendorCollection()
    {
        if ($this->_vendorCollection === null) {

            $vendorCollection = $this->_vendor->getCollection()
                ->addFieldToSelect('*')
                ->addFieldToFilter('status', $this->_vendor->getEnableStatus());

            $this->_vendorCollection = $vendorCollection;
        }
        return $this->_vendorCollection;
    }


    public function getLoadedVendorCollection()
    {
        return $this->_getVendorCollection();
    }

    public function getVendorUrl($vendor)
    {
        if(!$vendor->getId()){
            return '#';
        }

        return $this->getUrl('vendors/vendor/view', ['id' => $vendor->getId()]);
    }

}