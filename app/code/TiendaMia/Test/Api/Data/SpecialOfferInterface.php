<?php declare(strict_types=1);
/**
 * @package  TiendaMia_Test
 * @author   Gustavo Iribarne <giribarne@gmail.com>
 */

namespace TiendaMia\Test\Api\Data;

interface SpecialOfferInterface
{
    public const TABLE = 'tm_special_offer_sales';
    public const ORDER_ID = 'order_id';
    public const PRODUCT_SKU = 'product_sku';
    public const OFFER_ID = 'offer_id';
    public const SELLER = 'seller';
    public const QTY = 'qty';
    public const PRICE = 'price';
    public const CREATED_AT = 'created_at';

    /**
     * Get Order ID
     *
     * @return mixed
     */
    public function getOrderId();

    /**
     * Set Order ID
     *
     * @param mixed $orderId
     * @return $this
     */
    public function setOrderId($orderId): SpecialOfferInterface;

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
    public function setProductSKU($productSKU): SpecialOfferInterface;

    /**
     * Get Offer ID
     *
     * @return mixed|null
     */
    public function getOfferId();

    /**
     * Set Offer ID
     *
     * @param mixed $offerId
     * @return $this
     */
    public function setOfferId($offerId): SpecialOfferInterface;

    /**
     * Get Seller
     *
     * @return string|null
     */
    public function getSeller(): ?string;

    /**
     * Set Seller
     *
     * @param mixed $seller
     * @return $this
     */
    public function setSeller($seller): SpecialOfferInterface;

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
    public function setQty($qty): SpecialOfferInterface;

    /**
     * Get Price
     *
     * @return mixed|null
     */
    public function getPrice();

    /**
     * Set Price
     *
     * @param mixed $price
     * @return $this
     */
    public function setPrice($price): SpecialOfferInterface;

    /**
     * Get Created At
     *
     * @return string|null
     */
    public function getCreatedAt(): ?string;

    /**
     * Set Created At
     *
     * @param mixed $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt): SpecialOfferInterface;
}
