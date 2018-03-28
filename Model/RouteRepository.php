<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\ReLinker\Model;

use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * @SuppressWarnings(PHPMD.ShortVariable)
 * @SuppressWarnings(PHPMD.LongVariable)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class RouteRepository implements \MSP\ReLinkerApi\Api\RouteRepositoryInterface
{
    /**
     * @var \MSP\ReLinker\Model\Route\Command\SaveInterface
     */
    private $commandSave;

    /**
     * @var \MSP\ReLinker\Model\Route\Command\GetInterface
     */
    private $commandGet;
    /**
     * @var \MSP\ReLinker\Model\Route\Command\GetByPathInterface
     */
    private $commandGetByPath;

    /**
     * @var \MSP\ReLinker\Model\Route\Command\DeleteInterface
     */
    private $commandDeleteById;

    /**
     * @var \MSP\ReLinker\Model\Route\Command\GetListInterface
     */
    private $commandGetList;

    /**
     * @param \MSP\ReLinker\Model\Route\Command\SaveInterface $commandSave
     * @param \MSP\ReLinker\Model\Route\Command\GetInterface $commandGet
     * @param \MSP\ReLinker\Model\Route\Command\GetByPathInterface $commandGetByPath
     * @param \MSP\ReLinker\Model\Route\Command\DeleteInterface $commandDeleteById
     * @param \MSP\ReLinker\Model\Route\Command\GetListInterface $commandGetList
     */
    public function __construct(
        \MSP\ReLinker\Model\Route\Command\SaveInterface $commandSave,
        \MSP\ReLinker\Model\Route\Command\GetInterface $commandGet,
        \MSP\ReLinker\Model\Route\Command\GetByPathInterface $commandGetByPath,
        \MSP\ReLinker\Model\Route\Command\DeleteInterface $commandDeleteById,
        \MSP\ReLinker\Model\Route\Command\GetListInterface $commandGetList
    ) {
        $this->commandSave = $commandSave;
        $this->commandGet = $commandGet;
        $this->commandGetByPath = $commandGetByPath;
        $this->commandDeleteById = $commandDeleteById;
        $this->commandGetList = $commandGetList;
    }

    /**
     * @inheritdoc
     */
    public function save(\MSP\ReLinkerApi\Api\Data\RouteInterface $route): int
    {
        return $this->commandSave->execute($route);
    }

    /**
     * @inheritdoc
     */
    public function get(int $routeId): \MSP\ReLinkerApi\Api\Data\RouteInterface
    {
        return $this->commandGet->execute($routeId);
    }

    /**
     * @inheritdoc
     */
    public function getByPath(string $path): \MSP\ReLinkerApi\Api\Data\RouteInterface
    {
        return $this->commandGetByPath->execute($path);
    }

    /**
     * @inheritdoc
     */
    public function deleteById(int $routeId)
    {
        $this->commandDeleteById->execute($routeId);
    }

    /**
     * @inheritdoc
     */
    public function getList(
        SearchCriteriaInterface $searchCriteria = null
    ): \MSP\ReLinkerApi\Api\RouteSearchResultsInterface {
        return $this->commandGetList->execute($searchCriteria);
    }
}
