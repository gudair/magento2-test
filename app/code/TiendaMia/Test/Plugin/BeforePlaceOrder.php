<?php declare(strict_types=1);
/**
 * @package  TiendaMia_Test
 * @author   Gustavo Iribarne <giribarne@gmail.com>
 */

namespace TiendaMia\Test\Plugin;

use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\OrderManagementInterface;
use TiendaMia\Test\Model\UpdateSpecialPrice;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Payment\Gateway\Command\CommandException;
use TiendaMia\Test\Api\RegisterSpecialOfferSaleInterface;

class BeforePlaceOrder
{
    /**
     * @var UpdateSpecialPrice
     */
    private UpdateSpecialPrice $updateSpecialPrice;

    /**
     * @var ProductRepositoryInterface
     */
    private ProductRepositoryInterface $productRepository;

    private RegisterSpecialOfferSaleInterface $registerSpecialOfferSale;

    /**
     * @param UpdateSpecialPrice $updateSpecialPrice
     * @param ProductRepositoryInterface $productRepository
     * @param RegisterSpecialOfferSaleInterface $registerSpecialOfferSale
     */
    public function __construct(
        UpdateSpecialPrice $updateSpecialPrice,
        ProductRepositoryInterface $productRepository,
        RegisterSpecialOfferSaleInterface $registerSpecialOfferSale
    ) {
        $this->updateSpecialPrice = $updateSpecialPrice;
        $this->productRepository = $productRepository;
        $this->registerSpecialOfferSale = $registerSpecialOfferSale;
    }

    /**
     * @param OrderManagementInterface $subject
     * @param OrderInterface $order
     * @return OrderInterface[]
     * @throws \Exception
     */
    public function beforePlace(OrderManagementInterface $subject, OrderInterface $order): array
    {
        $quoteId = $order->getQuoteId();
        if ($quoteId) {
            foreach ($order->getItems() ?? [] as $item) {
                $priceItem = $item->getPrice();
                $product = $this->productRepository->getById($item->getProductId());
                $this->updateSpecialPrice->specialPriceData($product);
                $extension = $product->getExtensionAttributes();
                if ($extension->getSpecialOfferPrice()) {
                    if ($priceItem !== (float) $extension->getSpecialOfferPrice()->price) {
                        throw new CommandException(
                            __('The Price of the offer has changed.')
                        );
                    }
                    if ($item->getQtyOrdered() > $extension->getSpecialOfferPrice()->stock) {
                        throw new CommandException(
                            __(
                                'The max amount of product %1 you can buy with current price is %2',
                                $item->getName(),
                                $extension->getSpecialOfferPrice()->stock
                            )
                        );
                    }
                $this->registerSpecialOfferSale->registerSale($order->getIncrementId(), $product, $item->getQtyOrdered());
                }
            }
        }

        return [$order];
    }
}
