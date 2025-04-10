<?php

declare(strict_types=1);

namespace M2\MVVM\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Thing extends AbstractDb
{
    protected function _construct(): void
    {
        $this->_init('m2_mvvm_thing', 'thing_id');
    }
}
