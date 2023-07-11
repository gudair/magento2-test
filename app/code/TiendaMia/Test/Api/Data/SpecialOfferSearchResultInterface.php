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
interface SpecialOfferSearchResultInterface extends SearchResultsInterface
{
    /**
     * Get SpecialOffer List
     *
     * @return SpecialOfferInterface[]
     */
    public function getItems();

    /**
     * Set SpecialOffer List
     *
     * @param SpecialOfferInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
