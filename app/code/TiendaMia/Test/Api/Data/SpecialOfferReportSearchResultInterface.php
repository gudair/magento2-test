<?php declare(strict_types=1);
/**
 * @package  TiendaMia_Test
 * @author   Gustavo Iribarne <giribarne@gmail.com>
 */

namespace TiendaMia\Test\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * @api
 */
interface SpecialOfferReportSearchResultInterface extends SearchResultsInterface
{
    /**
     * Get SpecialOffer Report List
     *
     * @return SpecialOfferReportInterface[]
     */
    public function getItems();

    /**
     * Set SpecialOffer Report List
     *
     * @param SpecialOfferReportInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
