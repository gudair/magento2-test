<?php declare(strict_types=1);
/**
 * @package  TiendaMia_Test
 * @author   Gustavo Iribarne <giribarne@gmail.com>
 */

namespace TiendaMia\Test\Model\ResourceModel\SpecialOffer;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

use TiendaMia\Test\Model\SpecialOffer;
use TiendaMia\Test\Model\ResourceModel\SpecialOffer as SpecialOfferResourceModel;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Initialize connection and define main table name
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(SpecialOffer::class, SpecialOfferResourceModel::class);
    }
}
