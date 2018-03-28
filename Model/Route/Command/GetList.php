<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\ReLinker\Model\Route\Command;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * @inheritdoc
 */
class GetList implements GetListInterface
{
    /**
     * @var \MSP\ReLinker\Model\ResourceModel\Route\CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var \MSP\ReLinkerApi\Api\RouteSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @param \MSP\ReLinker\Model\ResourceModel\Route\CollectionFactory $collectionFactory
     * @param \MSP\ReLinkerApi\Api\RouteSearchResultsInterfaceFactory $searchResultsFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @SuppressWarnings(PHPMD.LongVariable)
     */
    public function __construct(
        \MSP\ReLinker\Model\ResourceModel\Route\CollectionFactory $collectionFactory,
        \MSP\ReLinkerApi\Api\RouteSearchResultsInterfaceFactory $searchResultsFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @inheritdoc
     */
    public function execute(): \MSP\ReLinkerApi\Api\RouteSearchResultsInterface
    {
        /** @var \MSP\ReLinker\Model\ResourceModel\Route\Collection $collection */
        $collection = $this->collectionFactory->create();

        /** @var \MSP\ReLinkerApi\Api\RouteSearchResultsInterface $searchResult */
        $searchResult = $this->searchResultsFactory->create();
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($this->searchCriteriaBuilder->create());

        return $searchResult;
    }
}
