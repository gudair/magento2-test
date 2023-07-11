<?php declare(strict_types=1);
/**
 * @package  TiendaMia_Test
 * @author   Gustavo Iribarne <giribarne@gmail.com>
 */

namespace TiendaMia\Test\Plugin;

use Magento\Catalog\Model\Product;
use TiendaMia\Test\Model\UpdateSpecialPrice;

class BeforeFinalPriceBox
{
    /**
     * @var UpdateSpecialPrice
     */
    private UpdateSpecialPrice $updateSpecialPrice;

    /**
     * @param UpdateSpecialPrice $updateSpecialPrice
     */
    public function __construct(
        UpdateSpecialPrice $updateSpecialPrice
    ) {
        $this->updateSpecialPrice = $updateSpecialPrice;
    }

    /**
     * @param Product\Type $subject
     * @param Product $saleableItem
     * @return void
     * @throws \Exception
     */
    public function beforeGetPriceInfo(\Magento\Catalog\Model\Product\Type $subject, Product $saleableItem)
    {
        $this->updateSpecialPrice->specialPriceData($saleableItem);
    }
}
