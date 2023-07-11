<?php declare(strict_types=1);
/**
 * @package  TiendaMia_Test
 * @author   Gustavo Iribarne <giribarne@gmail.com>
 */

namespace TiendaMia\Test\Api;

use TiendaMia\Test\Api\Data\SpecialOfferInterface;
use TiendaMia\Test\Api\Data\SpecialOfferSearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;

interface SpecialOfferRepositoryInterface
{
    /**
     * Save Special Offer
     *
     * @param SpecialOfferInterface $object
     * @return SpecialOfferInterface
     */
    public function save(SpecialOfferInterface $object): SpecialOfferInterface;

    /**
     * Get By ID
     *
     * @param mixed $id
     * @return SpecialOfferInterface
     * @throws NoSuchEntityException
     */
    public function getById($id): SpecialOfferInterface;

    /**
     * Delete Special Offer
     *
     * @param SpecialOfferInterface $object
     * @return void
     */
    public function delete(SpecialOfferInterface $object);

    /**
     * Delete Special Offer By ID
     *
     * @param mixed $id
     * @return bool
     * @throws NoSuchEntityException
     */
    public function deleteById($id): bool;

    /**
     * Get Special Offer List
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SpecialOfferSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
