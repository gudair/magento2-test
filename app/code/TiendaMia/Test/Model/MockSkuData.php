<?php declare(strict_types=1);
/**
 * @package  TiendaMia_Test
 * @author   Gustavo Iribarne <giribarne@gmail.com>
 */

namespace TiendaMia\Test\Model;

use Magento\Framework\Module\Dir;

class MockSkuData implements \TiendaMia\Test\Api\MockSkuDataInterface
{
    /**
     * @var Dir
     */
    protected Dir $moduleDirectory;

    /**
     * @var string
     */
    protected string $moduleSetupPath;

    /**
     * @param Dir $moduleDirectory
     */
    public function __construct(
        Dir $moduleDirectory
    ) {
        $this->moduleDirectory = $moduleDirectory;
        $this->moduleSetupPath = $this->moduleDirectory->getDir('TiendaMia_Test');
    }

    /**
     * {@inheritdoc}
     */
    public function getSkuOffers($sku)
    {
        $fileName = $this->moduleSetupPath . '/Model/MockData.json';
        $mockData = json_decode(file_get_contents($fileName));
        $productOffers = '';
        foreach ($mockData->products ?? [] as $mockDatum) {
            if ($mockDatum->sku == $sku) {
                $data = [
                    'sku' => $sku,
                    'offers' => $mockDatum->offers
                ];
                $productOffers = $data;
                break;
            }
        }
        if ($productOffers) {
            $productOffers = json_encode($productOffers);
        }

        return $productOffers;
    }
}
