<?php declare(strict_types=1);
/**
 * @package  TiendaMia_Test
 * @author   Gustavo Iribarne <giribarne@gmail.com>
 */

namespace TiendaMia\Test\Model;

use TiendaMia\Test\Api\Data\SpecialOfferInterface;
use TiendaMia\Test\Api\Data\SpecialOfferInterfaceFactory;
use TiendaMia\Test\Api\SpecialOfferRepositoryInterface;
use TiendaMia\Test\Model\ResourceModel\SpecialOfferFactory as SpecialOfferResourceModelFactory;
use TiendaMia\Test\Model\ResourceModel\SpecialOffer\CollectionFactory;
use TiendaMia\Test\Api\Data\SpecialOfferSearchResultInterfaceFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class SpecialOfferRepository implements SpecialOfferRepositoryInterface
{
    /**
     * @var SpecialOfferInterfaceFactory
     */
    private SpecialOfferInterfaceFactory $specialOfferInterfaceFactory;

    /**
     * @var SpecialOfferResourceModelFactory
     */
    private SpecialOfferResourceModelFactory $specialOfferResourceModelFactory;

    /**
     * @var CollectionFactory
     */
    private CollectionFactory $collectionFactory;

    /**
     * @var SpecialOfferSearchResultInterfaceFactory
     */
    private SpecialOfferSearchResultInterfaceFactory $specialOfferSearchResultFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private CollectionProcessorInterface $collectionProcessor;

    /**
     * @param SpecialOfferInterfaceFactory $specialOfferInterfaceFactory
     * @param SpecialOfferResourceModelFactory $specialOfferResourceModelFactory
     * @param CollectionFactory $collectionFactory
     * @param SpecialOfferSearchResultInterfaceFactory $specialOfferSearchResultFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        SpecialOfferInterfaceFactory $specialOfferInterfaceFactory,
        SpecialOfferResourceModelFactory $specialOfferResourceModelFactory,
        CollectionFactory $collectionFactory,
        SpecialOfferSearchResultInterfaceFactory $specialOfferSearchResultFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->specialOfferInterfaceFactory = $specialOfferInterfaceFactory;
        $this->specialOfferResourceModelFactory = $specialOfferResourceModelFactory;
        $this->collectionFactory = $collectionFactory;
        $this->SpecialOfferSearchResultFactory = $specialOfferSearchResultFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function getById($id): SpecialOfferInterface
    {
        $specialOffer = $this->specialOfferInterfaceFactory->create();
        $this->specialOfferResourceModelFactory
            ->create()
            ->load($specialOffer, $id);
        if (!$specialOffer->getId()) {
            throw new NoSuchEntityException(__('Unable to find special offer with ID "%1"', $id));
        }

        return $specialOffer;
    }

    /**
     * @inheritDoc
     */
    public function save(SpecialOfferInterface $object): SpecialOfferInterface
    {
        $this->specialOfferResourceModelFactory
            ->create()
            ->save($object);
        return $object;
    }

    /**
     * @inheritDoc
     */
    public function delete(SpecialOfferInterface $object)
    {
        $this->specialOfferResourceModelFactory
            ->create()
            ->delete($object);
        return $object;
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, ($collection));
        $searchResults = $this->SpecialOfferSearchResultFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());

        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($id): bool
    {
        $specialOfferModel = $this->getById($id);
        $this->delete($specialOfferModel);

        return true;
    }
}
