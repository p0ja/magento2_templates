<?php

declare(strict_types=1);

namespace M2\CRUD\Api;

use M2\CRUD\Api\Data\ItemInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Interface ItemRepositoryInterface
 *
 * @api
 */
interface ItemRepositoryInterface
{
    /**
     * Create or update Item.
     *
     * @param ItemInterface $page
     * @return ItemInterface
     */
    public function save(ItemInterface $page): ItemInterface;

    /**
     * Get Item by Id
     *
     * @param int $id
     * @return ItemInterface
     * @throws NoSuchEntityException If Item with the specified ID does not exist.
     * @throws LocalizedException
     */
    public function getById(int $id): ItemInterface;

    /**
     * Retrieve Items which match a specified criteria.
     *
     * @param SearchCriteriaInterface $criteria
     */
    public function getList(SearchCriteriaInterface $criteria): SearchResultsInterface;

    /**
     * Delete Item
     *
     * @param ItemInterface $page
     * @return bool
     * @throws NoSuchEntityException If Item with the specified ID does not exist.
     * @throws LocalizedException
     */
    public function delete(ItemInterface $page): bool;

    /**
     * Delete Item by Id
     *
     * @param int $id
     * @return bool
     * @throws NoSuchEntityException If customer with the specified ID does not exist.
     * @throws LocalizedException
     */
    public function deleteById(int $id): bool;
}
