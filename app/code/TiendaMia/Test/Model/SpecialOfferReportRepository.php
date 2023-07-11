<?php declare(strict_types=1);
/**
 * @package  TiendaMia_Test
 * @author   Gustavo Iribarne <giribarne@gmail.com>
 */

namespace TiendaMia\Test\Model;

use TiendaMia\Test\Api\Data\SpecialOfferReportInterface;
use TiendaMia\Test\Api\Data\SpecialOfferReportInterfaceFactory;
use TiendaMia\Test\Api\SpecialOfferReportRepositoryInterface;
use TiendaMia\Test\Model\ResourceModel\SpecialOfferReportFactory as SpecialOfferReportResourceModelFactory;
use TiendaMia\Test\Model\ResourceModel\SpecialOfferReport\CollectionFactory;
use TiendaMia\Test\Api\Data\SpecialOfferReportSearchResultInterfaceFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class SpecialOfferReportRepository implements SpecialOfferReportRepositoryInterface
{
    /**
     * @var SpecialOfferReportInterfaceFactory
     */
    private SpecialOfferReportInterfaceFactory $specialOfferReportInterfaceFactory;

    /**
     * @var SpecialOfferReportResourceModelFactory
     */
    private SpecialOfferReportResourceModelFactory $specialOfferReportResourceModelFactory;

    /**
     * @var CollectionFactory
     */
    private CollectionFactory $collectionFactory;

    /**
     * @var SpecialOfferReportSearchResultInterfaceFactory
     */
    private SpecialOfferReportSearchResultInterfaceFactory $specialOfferReportSearchResultFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private CollectionProcessorInterface $collectionProcessor;

    /**
     * @param SpecialOfferReportInterfaceFactory $specialOfferReportInterfaceFactory
     * @param SpecialOfferReportResourceModelFactory $specialOfferReportResourceModelFactory
     * @param CollectionFactory $collectionFactory
     * @param SpecialOfferReportSearchResultInterfaceFactory $specialOfferReportSearchResultFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        SpecialOfferReportInterfaceFactory $specialOfferReportInterfaceFactory,
        SpecialOfferReportResourceModelFactory $specialOfferReportResourceModelFactory,
        CollectionFactory $collectionFactory,
        SpecialOfferReportSearchResultInterfaceFactory $specialOfferReportSearchResultFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->specialOfferReportInterfaceFactory = $specialOfferReportInterfaceFactory;
        $this->specialOfferReportResourceModelFactory = $specialOfferReportResourceModelFactory;
        $this->collectionFactory = $collectionFactory;
        $this->specialOfferReportSearchResultFactory = $specialOfferReportSearchResultFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function getById($id): SpecialOfferReportInterface
    {
        $specialOfferReport = $this->specialOfferReportInterfaceFactory->create();
        $this->specialOfferReportResourceModelFactory
            ->create()
            ->load($specialOfferReport, $id);
        if (!$specialOfferReport->getId()) {
            throw new NoSuchEntityException(__('Unable to find special offer report with ID "%1"', $id));
        }

        return $specialOfferReport;
    }

    /**
     * @inheritDoc
     */
    public function save(SpecialOfferReportInterface $object): SpecialOfferReportInterface
    {
        $this->specialOfferReportResourceModelFactory
            ->create()
            ->save($object);
        return $object;
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, ($collection));
        $searchResults = $this->specialOfferReportSearchResultFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());

        return $searchResults;
    }
}
