<?php

declare(strict_types=1);

namespace Vendor\NewtypesGraphQl\Model\Resolver;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Vendor\Newtypes\Api\Data\NewtypeInterface;
use Vendor\Newtypes\Enum\Priorities;

class PriorityResolver implements ResolverInterface
{
    /**
     * @inheritdoc
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {

        if (!array_key_exists('model', $value) || !$value['model'] instanceof NewtypeInterface) {
            throw new LocalizedException(__('"model" value should be specified'));
        }

        $newtype = $value['model'];
        $priority = Priorities::from((int)$newtype->getPriority());

        return $priority->name;
    }
}
