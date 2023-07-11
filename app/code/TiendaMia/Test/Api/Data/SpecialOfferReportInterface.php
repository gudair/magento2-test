<?php declare(strict_types=1);
/**
 * @package  TiendaMia_Test
 * @author   Gustavo Iribarne <giribarne@gmail.com>
 */

namespace TiendaMia\Test\Api\Data;

interface SpecialOfferReportInterface
{
    public const TABLE = 'tm_special_offer_sales_report';
    public const PRODUCT_SKU = 'product_sku';
    public const QTY = 'qty';
    public const DATE = 'date';

    /**
     * Get Product SKU
     *
     * @return string|null
     */
    public function getProductSKU(): ?string;

    /**
     * Set Product SKU
     *
     * @param mixed $productSKU
     * @return $this
     */
    public function setProductSKU($productSKU): SpecialOfferReportInterface;

    /**
     * Get Quantity
     *
     * @return mixed|null
     */
    public function getQty();

    /**
     * Set Quantity
     *
     * @param mixed $qty
     * @return $this
     */
    public function setQty($qty): SpecialOfferReportInterface;

    /**
     * Get Date
     *
     * @return string|null
     */
    public function getDate(): ?string;

    /**
     * Set Date
     *
     * @param mixed $date
     * @return $this
     */
    public function setDate($date): SpecialOfferReportInterface;
}
