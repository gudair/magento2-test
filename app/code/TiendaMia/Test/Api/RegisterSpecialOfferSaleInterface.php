<?php declare(strict_types=1);
/**
 * @package  TiendaMia_Test
 * @author   Gustavo Iribarne <giribarne@gmail.com>
 */

namespace TiendaMia\Test\Api;

use Magento\Catalog\Api\Data\ProductInterface;

interface RegisterSpecialOfferSaleInterface
{
    /**
     * @param mixed $orderId
     * @param ProductInterface $product
     * @param mixed $qty
     * @return bool
     */
    public function registerSale($orderId, ProductInterface $product, $qty): bool;
}
