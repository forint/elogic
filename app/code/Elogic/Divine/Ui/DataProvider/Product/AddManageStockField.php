<?php


namespace Elogic\Divine\Ui\DataProvider\Product;


class AddManageStockField implements \Magento\Ui\DataProvider\AddFieldToCollectionInterface
{
    public function addField(\Magento\Framework\Data\Collection $collection, $field, $alias = null){

        $collection->joinField(
            'manage_stock',
            'cataloginventory_stock_item',
            'manage_stock',
            'product_id=entity_id',
            null,
            'left'
        );
    }
}