<?php

declare(strict_types=1);

namespace M2\CRUD\Services;

use M2\CRUD\Model\ItemRepository;
use Magento\Framework\Api\Filter;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\FilterGroup;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\ObjectManagerInterface;

class GetFilteredProductList
{
    /**
     * @param ObjectManagerInterface $objectManager
     */
    public function __construct(
        private readonly ObjectManagerInterface $objectManager,
    ){
    }

    /**
     * @param string $pattern
     * @return array
     */
    public function execute(string $pattern): array
    {
        $filterBuilder = $this->objectManager->create(FilterBuilder::class);
        $filterBuilder->setField('item_sku')->setConditionType('like')->setValue($pattern);
        $filter = $filterBuilder->create();

        $filterGroup = $this->objectManager->create(FilterGroup::class);
        $filterGroup->setData('filters', [$filter]);

        $searchCriteria = $this->objectManager->create(SearchCriteriaInterface::class);
        $searchCriteria->setFilterGroups([$filterGroup]);

        $itemRepository = $this->objectManager->get(ItemRepository::class);
        $result = $itemRepository->getList($searchCriteria);

        return $result->getItems();
    }
}
