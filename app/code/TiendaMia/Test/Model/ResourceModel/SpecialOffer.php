<?php declare(strict_types=1);
/**
 * @package  TiendaMia_Test
 * @author   Gustavo Iribarne <giribarne@gmail.com>
 */

namespace TiendaMia\Test\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use TiendaMia\Test\Api\Data\SpecialOfferInterface;

class SpecialOffer extends AbstractDb
{
    /**
     * Initialize connection and define main table name
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(SpecialOfferInterface::TABLE, 'id');
    }
}
