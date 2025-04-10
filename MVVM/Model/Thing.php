<?php

declare(strict_types=1);

namespace M2\MVVM\Model;

use M2\MVVM\Api\Data\ThingInterface;
use M2\MVVM\Model\ResourceModel\Thing as ResourceThing;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Thing extends AbstractModel implements ThingInterface, IdentityInterface
{
    public const CACHE_TAG = 'm2_mvvm_thing';
    public const STATUS_ENABLED = 1;
    public const STATUS_DISABLED = 0;

    public function getIdentities(): array
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    protected function _construct(): void
    {
        $this->_init(ResourceThing::class);
    }
}
