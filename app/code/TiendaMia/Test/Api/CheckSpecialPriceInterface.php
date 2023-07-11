<?php declare(strict_types=1);
/**
 * @package  TiendaMia_Test
 * @author   Gustavo Iribarne <giribarne@gmail.com>
 */

namespace TiendaMia\Test\Api;

interface CheckSpecialPriceInterface
{
    /**
     * @param string $sku
     * @return mixed
     */
    public function checkSpecialPrice(string $sku);
}
