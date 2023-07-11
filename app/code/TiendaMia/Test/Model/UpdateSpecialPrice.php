<?php declare(strict_types=1);
/**
 * @package  TiendaMia_Test
 * @author   Gustavo Iribarne <giribarne@gmail.com>
 */

namespace TiendaMia\Test\Model;

use Exception;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Api\Data\ProductInterface;
use TiendaMia\Test\Api\CheckSpecialPriceInterface;
use Magento\Catalog\Api\SpecialPriceInterface;
use Magento\Catalog\Api\Data\SpecialPriceInterfaceFactory;

class UpdateSpecialPrice
{
    /**
     * @var SpecialPriceInterface
     */
    private SpecialPriceInterface $specialPrice;

    /**
     * @var SpecialPriceInterfaceFactory
     */
    private SpecialPriceInterfaceFactory $specialPriceFactory;

    /**
     * @var CheckSpecialPriceInterface
     */
    private CheckSpecialPriceInterface $checkSpecialPrice;

    /**
     * @param SpecialPriceInterface $specialPrice
     * @param SpecialPriceInterfaceFactory $specialPriceFactory
     * @param CheckSpecialPriceInterface $checkSpecialPrice
     */
    public function __construct(
        SpecialPriceInterface $specialPrice,
        SpecialPriceInterfaceFactory $specialPriceFactory,
        CheckSpecialPriceInterface $checkSpecialPrice
    ) {
        $this->specialPrice = $specialPrice;
        $this->specialPriceFactory = $specialPriceFactory;
        $this->checkSpecialPrice = $checkSpecialPrice;
    }

    /**
     * @param Product|ProductInterface $product
     * @return bool
     * @throws Exception
     */
    public function specialPriceData(Product $product)
    {
        $specialPrice = $this->checkSpecialPrice->checkSpecialPrice($product->getSku());
        if ($specialPrice) {
            try {
                $prices = $this->specialPriceFactory->create();
                $prices->setSku($product->getSku())
                    ->setStoreId($product->getStoreId())
                    ->setPrice((float) $specialPrice->price);
                $specialPriceProduct = $this->specialPrice->update([$prices]);
            } catch (Exception $exception) {
                throw new Exception($exception->getMessage());
            }
            if ($specialPriceProduct) {
                $extension = $product->getExtensionAttributes();
                $extension->setSpecialOfferPrice($specialPrice);
                $product->setExtensionAttributes($extension);

                $product->save();
            }

            return $specialPriceProduct;
        }


        return false;
    }
}
