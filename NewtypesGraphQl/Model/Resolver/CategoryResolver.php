<?php

declare(strict_types=1);

namespace Vendor\NewtypesGraphQl\Model\Resolver;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Vendor\NewtypesGraphQl\Api\Data\NewtypeInterface;
use Vendor\NewtypesGraphQl\Service\GetCategoryById;

class CategoryResolver implements ResolverInterface
{
    /**
     * @param GetCategoryById $getCategoryById
     */
    public function __construct(
        private readonly GetCategoryById $getCategoryById
    ) {
    }

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
        $category = $this->getCategoryById->execute((int)$newtype->getCategoryId());

        return ['category' => [
            'uid' => $category->getId(),
            'name' => $category->getName(),
            'description' => $category->getDescription(),
            'path' => $category->getUrlPath(),
        ]];
    }
}
