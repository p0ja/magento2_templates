<?php

declare(strict_types=1);

namespace Vendor\NewtypesGraphQl\Model;

use Magento\Framework\GraphQl\Query\Resolver\TypeResolverInterface;

/**
 * {@inheritdoc}
 */
class NewtypesTypeResolver implements TypeResolverInterface
{
    /**
     * {@inheritdoc}
     */
    public function resolveType(array $data) : string
    {
        return 'Newtype';
    }
}
