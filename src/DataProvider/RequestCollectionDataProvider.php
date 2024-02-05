<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\CoreBundle\Rest\Query\Pagination\Pagination;
use Dbp\Relay\CoreBundle\Rest\Query\Pagination\Paginator;
use Dbp\Relay\CoreBundle\Rest\Query\Pagination\WholeResultPaginator;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\Request;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class RequestCollectionDataProvider extends AbstractController implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    /**
     * @var DispatchService
     */
    private $dispatchService;
    /**
     * @var AuthorizationService
     */
    private $auth;

    public function __construct(DispatchService $dispatchService, AuthorizationService $auth)
    {
        $this->dispatchService = $dispatchService;
        $this->auth = $auth;
    }

    public function supports(string $resourceClass, ?string $operationName = null, array $context = []): bool
    {
        return Request::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, ?string $operationName = null, array $context = []): Paginator
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->auth->checkCanUse();

        $filters = $context['filters'] ?? [];

        $groupId = $filters['groupId'] ?? null;
        if ($groupId === null) {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'groupId query parameter missing');
        }
        $this->auth->checkCanReadMetadata($groupId);

        return new WholeResultPaginator(
            $this->dispatchService->getRequestsForGroupId($groupId),
            Pagination::getCurrentPageNumber($filters),
            Pagination::getMaxNumItemsPerPage($filters));
    }
}
