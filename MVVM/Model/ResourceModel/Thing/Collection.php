<?php /** @noinspection PhpCSValidationInspection */

declare(strict_types=1);

namespace M2\MVVM\Model\ResourceModel\Thing;

use M2\MVVM\Model\ResourceModel\Thing as ResourceThing;
use M2\MVVM\Model\Thing;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct(): void
    {
        $this->_init(Thing::class, ResourceThing::class);
    }
}
