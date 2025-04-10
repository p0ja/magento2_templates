<?php

namespace M2\MVVM\Api;

use M2\MVVM\Api\Data\ThingInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * A Repository Model defines common CRUD operations
 * (Create, Replace, Update, Delete) for models.
 */
interface ThingRepositoryInterface
{
    /**
     * Creates a new record if no id present,
     * otherwise updates an existing record with the specified id.
     *
     * @param ThingInterface $thing data entity interface
     *
     * @return ThingInterface
     */
    public function save(ThingInterface $thing): ThingInterface;

    /**
     * Performs a database lookup by id and returns a data entity interface
     *
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function getById(int $id): ThingInterface;

    /**
     * Performs a search for all data entities matching the search criteria and
     * returns a search results interface to give access to the set of matches.
     *
     * @returns [] ThingInterface
     */
    public function getList(SearchCriteriaInterface $criteria): array;

    /**
     * Deletes the specified entity (the key is in the entity).
     *
     * @param ThingInterface $thing data entity interface
     *
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function delete(ThingInterface $thing): bool;

    /**
     * Deletes the specified entity when you only have the key for the entity.
     *
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(int $id): bool;
}
