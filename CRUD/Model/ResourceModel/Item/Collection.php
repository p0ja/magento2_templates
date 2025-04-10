<?php

namespace M2\CRUD\Model\ResourceModel\Item;

use M2\CRUD\Model\Item;
use M2\CRUD\Model\ResourceModel\Item as ItemResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct() // phpcs:ignore PSR2.Methods.MethodDeclaration
    {
        $this->_init(Item::class, ItemResource::class);
    }
}
