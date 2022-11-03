<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Service;

use Dbp\CampusonlineApi\LegacyWebService\ApiException;
use Dbp\Relay\BaseOrganizationBundle\API\OrganizationProviderInterface;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\Group;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;

class GroupService implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    /** @var AuthorizationService */
    private $auth;

    /** @var OrganizationProviderInterface */
    private $organizationProvider;

    public function __construct(AuthorizationService $auth, OrganizationProviderInterface $organizationProvider)
    {
        $this->auth = $auth;
        $this->organizationProvider = $organizationProvider;
    }

    /**
     * @throws ApiException
     */
    public function getGroupById(string $identifier, array $options = []): Group
    {
        $orgUnit = $this->organizationProvider->getOrganizationById($identifier, $options);

        $group = new Group();
        $group->setIdentifier($orgUnit->getIdentifier());
        $group->setName($orgUnit->getName());

        return $group;
    }

    /**
     * @throws ApiException
     */
    public function getGroups(int $currentPageNumber, int $maxNumItemsPerPage, array $options = []): array
    {
        $options['page'] = $currentPageNumber;
        $options['perPage'] = $maxNumItemsPerPage;
        $options['identifiers'] = $this->auth->getGroups();

        $groups = [];
        foreach ($this->organizationProvider->getOrganizations($options)->getItems() as $orgUnit) {
            $group = new Group();
            $group->setIdentifier($orgUnit->getIdentifier());
            $group->setName($orgUnit->getName());
            $groups[] = $group;
        }

        return $groups;
    }
}
