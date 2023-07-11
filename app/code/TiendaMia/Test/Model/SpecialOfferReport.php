<?php declare(strict_types=1);
/**
 * @package  TiendaMia_Test
 * @author   Gustavo Iribarne <giribarne@gmail.com>
 */

namespace TiendaMia\Test\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use TiendaMia\Test\Api\Data\SpecialOfferReportInterface;

class SpecialOfferReport extends AbstractExtensibleModel implements SpecialOfferReportInterface
{
    /**
     * Resource model initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\SpecialOfferReport::class);
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
    public function setProductSKU($productSKU): SpecialOfferReportInterface
    {
        return $this->setData(self::PRODUCT_SKU, $productSKU);
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
    public function setQty($qty): SpecialOfferReportInterface
    {
        return $this->setData(self::QTY, $qty);
    }

    /**
     * @inheritDoc
     */
    public function getDate(): ?string
    {
        return $this->getData(self::DATE);
    }
    /**
     * @inheritDoc
     */
    public function setDate($date): SpecialOfferReportInterface
    {
        return $this->setData(self::DATE, $date);
    }
}
