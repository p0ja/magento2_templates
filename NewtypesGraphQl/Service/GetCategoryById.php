<?php

declare(strict_types=1);

namespace Vendor\NewtypesGraphQl\Service;

use Magento\AdobeStockAssetApi\Api\Data\CategoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class GetCategoryById
{
    public function execute(int $categoryId): CategoryInterface
    {
        try {
            $category = $this->categoryRepository->get($categoryId);
        } catch (NoSuchEntityException $e) {
            $category = $this->categoryFactory->create();
        }

        return $category;
    }
}
