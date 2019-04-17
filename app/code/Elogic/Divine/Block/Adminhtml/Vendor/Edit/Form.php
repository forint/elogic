<?php
/**
 * Created by PhpStorm.
 * User: forint
 * Date: 4/15/19
 * Time: 3:46 PM
 */

namespace Elogic\Divine\Block\Adminhtml\Vendor\Edit;

use \Magento\Backend\Block\Widget\Form\Generic;

class Form extends Generic
{

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('vendor_form');
        $this->setTitle(__('Vendor Information'));
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \Elogic\Divine\Model\Vendor $model */
        $model = $this->_coreRegistry->registry('vendors_vendor');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );

        $form->setHtmlIdPrefix('vendor_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General Information'), 'class' => 'fieldset-wide']
        );

        if ($model->getId()) {
            $fieldset->addField('entity_id', 'hidden', ['name' => 'entity_id']);
        }

        $fieldset->addField(
            'name',
            'text',
            ['name' => 'name', 'label' => __('Vendor Name'), 'title' => __('Vendor Name'), 'required' => true]
        );

        $fieldset->addField(
            'description',
            'textarea',
            ['name' => 'description', 'label' => __('Vendor Description'), 'title' => __('Vendor Description'), 'required' => true]
        );

        $fieldset->addField(
            'vendor_image',
            'image',
            array(
                'name' => 'vendor_image',
                'label' => __('Image'),
                'title' => __('Image'),
                'required' => false,
                'note' => 'Allow image type: jpg, jpeg, gif, png',
            )
        );

        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $fieldset->addField(
            'from',
            'date',
            [
                'name' => 'from',
                'date_format' => $dateFormat,
                'label' => __('Date created'),
                'title' => __('Date created'),
                'required' => true,
                'css_class' => 'admin__field-small',
                'class' => 'admin__control-text'
            ]
        );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}