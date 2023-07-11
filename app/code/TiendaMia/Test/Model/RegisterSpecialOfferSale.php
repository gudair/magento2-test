<?php declare(strict_types=1);
/**
 * @package  TiendaMia_Test
 * @author   Gustavo Iribarne <giribarne@gmail.com>
 */

namespace TiendaMia\Test\Model;

use Magento\Catalog\Api\Data\ProductInterface;
use TiendaMia\Test\Api\RegisterSpecialOfferSaleInterface;
use TiendaMia\Test\Api\SpecialOfferRepositoryInterface;
use TiendaMia\Test\Api\Data\SpecialOfferInterfaceFactory;
use Psr\Log\LoggerInterface;

class RegisterSpecialOfferSale implements RegisterSpecialOfferSaleInterface
{
    /**
     * @var SpecialOfferInterfaceFactory
     */
    private SpecialOfferInterfaceFactory $specialOfferInterfaceFactory;

    /**
     * @var SpecialOfferRepositoryInterface
     */
    private SpecialOfferRepositoryInterface $specialOfferRepository;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param SpecialOfferInterfaceFactory $specialOfferInterfaceFactory
     * @param SpecialOfferRepositoryInterface $specialOfferRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        SpecialOfferInterfaceFactory $specialOfferInterfaceFactory,
        SpecialOfferRepositoryInterface $specialOfferRepository,
        LoggerInterface $logger
    ) {
        $this->specialOfferInterfaceFactory = $specialOfferInterfaceFactory;
        $this->specialOfferRepository = $specialOfferRepository;
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function registerSale($orderId, ProductInterface $product, $qty): bool
    {
        try {
            $extension = $product->getExtensionAttributes();
            $specialOffer = $this->specialOfferInterfaceFactory->create();
            $specialOffer
                ->setOrderId((int) $orderId)
                ->setProductSKU($product->getSku())
                ->setOfferId($extension->getSpecialOfferPrice()->id)
                ->setSeller($extension->getSpecialOfferPrice()->seller->name)
                ->setQty($qty)
                ->setPrice((float) $extension->getSpecialOfferPrice()->price);
            $this->specialOfferRepository->save($specialOffer);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());

            return false;
        }

        return true;
    }
}
