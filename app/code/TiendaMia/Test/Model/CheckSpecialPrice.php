<?php declare(strict_types=1);
/**
 * @package  TiendaMia_Test
 * @author   Gustavo Iribarne <giribarne@gmail.com>
 */

namespace TiendaMia\Test\Model;

use TiendaMia\Test\Api\CheckSpecialPriceInterface;
use TiendaMia\Test\Api\MockSkuDataInterface;

class CheckSpecialPrice implements CheckSpecialPriceInterface
{
    /**
     * @var MockSkuDataInterface
     */
    private MockSkuDataInterface $mockSkuData;

    /**
     * @param MockSkuDataInterface $mockSkuData
     */
    public function __construct(
        MockSkuDataInterface $mockSkuData
    ) {
        $this->mockSkuData = $mockSkuData;
    }

    /**
     * {@inheritdoc}
     */
    public function checkSpecialPrice(string $sku)
    {
        $specialPrice = null;
        $skuOffer = $this->mockSkuData->getSkuOffers($sku);
        if (!empty($skuOffer)) {
            $skuOffer = json_decode($skuOffer);
            $offers = [];
            $priceOffers = [];
            foreach ($skuOffer->offers as $offer) {
                if ($offer->stock > 0) {
                    $priceOffers[$offer->id] = (float)$offer->price;
                    $offers[$offer->id] = $offer;
                }
            }
            if (!empty($priceOffers)) {
                asort($priceOffers);
                $lowestPriceKey = array_key_first($priceOffers);
                $specialPrice = $offers[$lowestPriceKey];
            }
        }

        return $specialPrice;
    }
}
