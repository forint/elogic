<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Elogic\Divine\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Instant purchase configuration.
 */
class Config
{
    const ACTIVE = 'elogic/onepage/active';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * Data constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Defines is feature enabled.
     *
     * @param int $storeId
     * @return bool
     */
    public function isModuleEnabled(int $storeId): bool
    {
        // var_dump($this->isSetFlag(self::ACTIVE, $storeId));die;
        return $this->isSetFlag(self::ACTIVE, $storeId);
    }

    /**
     * Fetches value from generic config.
     *
     * @param string $path
     * @param int $storeId
     * @return mixed
     */
    private function getValue(string $path, int $storeId)
    {
        return $this->scopeConfig->getValue(
            $path,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Fetches switcher value from generic config.
     *
     * @param string $path
     * @param int $storeId
     * @return bool
     */
    private function isSetFlag(string $path, int $storeId): bool
    {
        return $this->scopeConfig->isSetFlag(
            $path,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
}
