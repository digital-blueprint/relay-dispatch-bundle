<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\ApiPlatform;

use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\Pagination\PartialPaginatorInterface;
use ApiPlatform\State\ProviderInterface;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\CoreBundle\Rest\Query\Pagination\Pagination;
use Dbp\Relay\CoreBundle\Rest\Query\Pagination\WholeResultPaginator;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\Request;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * @implements ProviderInterface<Request>
 */
final class RequestProvider extends AbstractController implements ProviderInterface
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

    /**
     * @return PartialPaginatorInterface|Request
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->auth->checkCanUse();

        if ($operation instanceof CollectionOperationInterface) {
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
        } else {
            $id = $uriVariables['identifier'];
            assert(is_string($id));
            $request = $this->dispatchService->getRequestById($id);
            $groupId = $request->getGroupId();
            $this->auth->checkCanReadMetadata($groupId);

            return $request;
        }
    }
}
