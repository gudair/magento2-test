<?php declare(strict_types=1);
/**
 * @package  TiendaMia_Test
 * @author   Gustavo Iribarne <giribarne@gmail.com>
 */

namespace TiendaMia\Test\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use TiendaMia\Test\Api\Data\SpecialOfferInterface;

class SpecialOffer extends AbstractExtensibleModel implements SpecialOfferInterface
{
    /**
     * Resource model initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\SpecialOffer::class);
    }

    /**
     * @inheritDoc
     */
    public function getOrderId()
    {
        return $this->getData(self::ORDER_ID);
    }

    /**
     * @inheritDoc
     */
    public function setOrderId($orderId): SpecialOfferInterface
    {
        return $this->setData(self::ORDER_ID, $orderId);
    }

    /**
     * @inheritDoc
     */
    public function getProductSKU(): ?string
    {
        return $this->getData(self::PRODUCT_SKU);
    }

    /**
     * @inheritDoc
     */
    public function setProductSKU($productSKU): SpecialOfferInterface
    {
        return $this->setData(self::PRODUCT_SKU, $productSKU);
    }

    /**
     * @inheritDoc
     */
    public function getOfferId()
    {
        return $this->getData(self::OFFER_ID);
    }

    /**
     * @inheritDoc
     */
    public function setOfferId($offerId): SpecialOfferInterface
    {
        return $this->setData(self::OFFER_ID, $offerId);
    }

    /**
     * @inheritDoc
     */
    public function getSeller(): ?string
    {
        return $this->getData(self::SELLER);
    }

    /**
     * @inheritDoc
     */
    public function setSeller($seller): SpecialOfferInterface
    {
        return $this->setData(self::SELLER, $seller);
    }

    /**
     * @inheritDoc
     */
    public function getQty()
    {
        return $this->getData(self::QTY);
    }

    /**
     * @inheritDoc
     */
    public function setQty($qty): SpecialOfferInterface
    {
        return $this->setData(self::QTY, $qty);
    }

    /**
     * @inheritDoc
     */
    public function getPrice()
    {
        return $this->getData(self::PRICE);
    }

    /**
     * @inheritDoc
     */
    public function setPrice($price): SpecialOfferInterface
    {
        return $this->setData(self::PRICE, $price);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt(): ?string
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt($createdAt): SpecialOfferInterface
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }
}
