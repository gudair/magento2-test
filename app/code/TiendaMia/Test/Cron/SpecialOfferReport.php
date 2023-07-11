<?php declare(strict_types=1);
/**
 * @package  TiendaMia_Test
 * @author   Gustavo Iribarne <giribarne@gmail.com>
 */

namespace TiendaMia\Test\Cron;

use Psr\Log\LoggerInterface;
use TiendaMia\Test\Api\SpecialOfferRepositoryInterface;
use TiendaMia\Test\Api\Data\SpecialOfferReportInterfaceFactory;
use TiendaMia\Test\Api\Data\SpecialOfferInterface;
use TiendaMia\Test\Api\SpecialOfferReportRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

class SpecialOfferReport
{
    /**
     * @var SpecialOfferRepositoryInterface
     */
    private SpecialOfferRepositoryInterface $specialOfferRepository;

    /**
     * @var SpecialOfferReportInterfaceFactory
     */
    private SpecialOfferReportInterfaceFactory $specialOfferReportInterfaceFactory;

    /**
     * @var SpecialOfferReportRepositoryInterface
     */
    private SpecialOfferReportRepositoryInterface $specialOfferReportRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private SearchCriteriaBuilder $searchCriteriaBuilder;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param SpecialOfferRepositoryInterface $specialOfferRepository
     * @param SpecialOfferReportInterfaceFactory $specialOfferReportInterfaceFactory
     * @param SpecialOfferReportRepositoryInterface $specialOfferReportRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param LoggerInterface $logger
     */
    public function __construct(
        SpecialOfferRepositoryInterface $specialOfferRepository,
        SpecialOfferReportInterfaceFactory $specialOfferReportInterfaceFactory,
        SpecialOfferReportRepositoryInterface $specialOfferReportRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        LoggerInterface $logger
    ) {
       $this->specialOfferRepository = $specialOfferRepository;
       $this->specialOfferReportInterfaceFactory = $specialOfferReportInterfaceFactory;
       $this->specialOfferReportRepository = $specialOfferReportRepository;
       $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->logger = $logger;
    }

    /**
     * Generate report in secondary table
     *
     * @return void
     */
    public function execute()
    {
        $yesterday = date('Y-m-d', strtotime('-1 day'));
        $today = date('Y-m-d', time());
        $this->searchCriteriaBuilder->addFilter(
            SpecialOfferInterface::CREATED_AT,
            $yesterday . '%',
            'like'
        );
        $sales = $this->specialOfferRepository->getList($this->searchCriteriaBuilder->create());
        $report = [];
        foreach ($sales->getItems() as $sale) {
            if (isset($report[$sale->getProductSKU()])) {
                $report[$sale->getProductSKU()] = $report[$sale->getProductSKU()] + $sale->getQty();
            } else {
                $report[$sale->getProductSKU()] = $sale->getQty();
            }
        }

        foreach ($report as $sku => $qty) {
            try {
                $reportLine = $this->specialOfferReportInterfaceFactory->create();
                $reportLine
                    ->setDate($today)
                    ->setProductSKU($sku)
                    ->setQty($qty);
                $this->specialOfferReportRepository->save($reportLine);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
