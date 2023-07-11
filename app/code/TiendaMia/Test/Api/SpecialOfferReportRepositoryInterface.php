<?php declare(strict_types=1);
/**
 * @package  TiendaMia_Test
 * @author   Gustavo Iribarne <giribarne@gmail.com>
 */

namespace TiendaMia\Test\Api;

use TiendaMia\Test\Api\Data\SpecialOfferReportInterface;
use TiendaMia\Test\Api\Data\SpecialOfferReportSearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;

interface SpecialOfferReportRepositoryInterface
{
    /**
     * Save Special Offer
     *
     * @param SpecialOfferReportInterface $object
     * @return SpecialOfferReportInterface
     */
    public function save(SpecialOfferReportInterface $object): SpecialOfferReportInterface;

    /**
     * Get By ID
     *
     * @param mixed $id
     * @return SpecialOfferReportInterface
     * @throws NoSuchEntityException
     */
    public function getById($id): SpecialOfferReportInterface;

    /**
     * Get Special Offer List
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SpecialOfferReportSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
