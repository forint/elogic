<?php
/**
 * Onepage block
 */
namespace Elogic\Divine\Block;

#use Magento\Framework\View\Element\Template;
#use Magento\Framework\View\Element\Template\Context;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Elogic\Divine\Model\Config;

class Onepage extends Template
{
    /**
     * @var Config
     */
    private $instantElogicDivineConfig;

    /**
     * Button constructor.
     * @param Context $context
     * @param Config $instantElogicDivineConfig
     * @param array $data
     */
    public function __construct(
        Context $context,
        Config $instantElogicDivineConfig,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->instantElogicDivineConfig = $instantElogicDivineConfig;
    }

    /**
     * Retrieve serialized JS layout configuration ready to use in template
     *
     * @return false|string
     */
    public function getJsLayout()
    {
        return json_encode($this->jsLayout, JSON_HEX_TAG);
    }

    /**
     * Checks if button enabled.
     *
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function isEnabled(): bool
    {
        return $this->instantElogicDivineConfig->isModuleEnabled($this->getCurrentStoreId());
    }

    /**
     * Returns active store view identifier.
     *
     * @return int
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    private function getCurrentStoreId(): int
    {
        return $this->_storeManager->getStore()->getId();
    }
}