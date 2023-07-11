<?php declare(strict_types=1);
/**
 * @package  TiendaMia_Test
 * @author   Gustavo Iribarne <giribarne@gmail.com>
 */

namespace TiendaMia\Test\Api;

interface MockSkuDataInterface
{
    /**
     * @param string $sku
     * @return string
     */
    public function getSkuOffers(string $sku);
}
