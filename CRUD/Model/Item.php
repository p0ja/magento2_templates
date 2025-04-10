<?php

namespace M2\CRUD\Model;

use M2\CRUD\Api\Data\ItemInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Item extends AbstractModel implements ItemInterface, IdentityInterface
{
    const CACHE_TAG = 'M2_crud_item';

    /**
     * @inheritDoc
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Init
     */
    protected function _construct() // phpcs:ignore PSR2.Methods.MethodDeclaration
    {
        $this->_init(ResourceModel\Item::class);
    }
}
