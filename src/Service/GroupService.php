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
        $groups = [];

        $groupsMayRead = $this->auth->getGroupsMayRead();
        $groupsMayWrite = $this->auth->getGroupsMayWrite();
        $groupsMayAccess = array_merge($groupsMayRead, $groupsMayWrite);
        $groupsMayAccess = array_unique($groupsMayAccess);

        if (!empty($groupsMayAccess)) {
            $options['identifiers'] = $groupsMayAccess;

            foreach ($this->organizationProvider->getOrganizations($currentPageNumber, $maxNumItemsPerPage, $options) as $orgUnit) {
                $group = new Group();
                $group->setIdentifier($orgUnit->getIdentifier());
                $group->setName($orgUnit->getName());
                $group->setMayRead(in_array($orgUnit->getIdentifier(), $groupsMayRead, true));
                $group->setMayWrite(in_array($orgUnit->getIdentifier(), $groupsMayWrite, true));
                $groups[] = $group;
            }
        }

        return $groups;
    }
}
