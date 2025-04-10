<?php

declare(strict_types=1);

namespace Dev\Grid\Plugin;

use Dev\Grid\Ui\DataProvider\Category\ListingDataProvider as CategoryDataProvider;
use Magento\Eav\Api\AttributeRepositoryInterface;
use Magento\Framework\App\ProductMetadataInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class AddAttributesToUiDataProvider
{
    /**
     * @param AttributeRepositoryInterface $attributeRepository
     * @param ProductMetadataInterface $productMetadata
     */
    public function __construct(
        private readonly AttributeRepositoryInterface $attributeRepository,
        private readonly ProductMetadataInterface $productMetadata
    ) {
    }

    /**
     * @param CategoryDataProvider $subject
     * @param SearchResult $result
     * @return SearchResult
     */
    public function afterGetSearchResult(CategoryDataProvider $subject, SearchResult $result): SearchResult
    {
        if ($result->isLoaded()) {
            return $result;
        }

        $edition = $this->productMetadata->getEdition();

        $column = 'entity_id';
        if ($edition == 'Enterprise') {
            $column = 'row_id';
        }

        $attribute = $this->attributeRepository->get('catalog_category', 'name');

        $result->getSelect()->joinLeft(
            ['devgridname' => $attribute->getBackendTable()],
            "devgridname." . $column . " = main_table." . $column . " AND devgridname.attribute_id = " . $attribute->getAttributeId(),
            ['name' => "devgridname.value"]
        );

        $result->getSelect()->where('devgridname.value LIKE "B%"');

        return $result;
    }
}
