<?php
declare(strict_types=1);

namespace Elogic\Divine\Observer\Backend;

use Magento\Framework\Event\Observer;
use Magento\Framework\Indexer\IndexerRegistry;
use Magento\Framework\Event\ObserverInterface;

class CatalogProductSaveAfterObserver implements ObserverInterface
{
    /**
     * @var IndexerRegistry
     */
    private $indexerRegistry;

    public function __construct(IndexerRegistry $indexerRegistry)
    {
        $this->indexerRegistry = $indexerRegistry;
    }

    public function execute(Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();

        if ($product) {
            $this->indexerRegistry->get('elogic_divine')->reindexRow($product->getId());
        }
    }
}