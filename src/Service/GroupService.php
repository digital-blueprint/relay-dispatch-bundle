<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Service;

use ApiPlatform\Core\Api\IriConverterInterface;
use Dbp\CampusonlineApi\LegacyWebService\ApiException;
use Dbp\Relay\CoreBundle\Entity\NamedEntityInterface;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\CoreBundle\LocalData\LocalData;
use Dbp\Relay\CoreBundle\LocalData\LocalDataAwareInterface;
use Dbp\Relay\CoreBundle\Pagination\Pagination;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\DependencyInjection\Configuration;
use Dbp\Relay\DispatchBundle\Entity\Group;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\HttpFoundation\Response;

class GroupService implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    /** @var AuthorizationService */
    private $auth;

    /** @var IriConverterInterface */
    private $iriConverter;

    /** @var array */
    private $config;

    public function __construct(AuthorizationService $auth, IriConverterInterface $iriConverter)
    {
        $this->config = [];
        $this->auth = $auth;
        $this->iriConverter = $iriConverter;
    }

    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    /**
     * @throws ApiException
     */
    public function getGroupById(string $identifier, array $options = []): Group
    {
        return $this->createGroup($identifier);
    }

    /**
     * @throws ApiException
     */
    public function getGroups(int $currentPageNumber, int $maxNumItemsPerPage, array $options = []): array
    {
        $groups = $this->auth->getGroups();
        $groupsMyAccess = [];
        foreach (array_slice($groups, Pagination::getFirstItemIndex($currentPageNumber, $maxNumItemsPerPage), $maxNumItemsPerPage) as $groupId) {
            $groupsMyAccess[] = $this->createGroup($groupId);
        }

        return $groupsMyAccess;
    }

    private function createGroup(string $groupId): Group
    {
        $options = [];
        LocalData::addIncludeParameter($options, $this->getAddressAttributes());

        $entity = $this->iriConverter->getItemFromIri(sprintf($this->config[Configuration::GROUP_DATA_IRI_TEMPLATE], $groupId),
            ['filters' => $options]);

        if ($entity instanceof NamedEntityInterface === false ||
            $entity instanceof LocalDataAwareInterface === false) {
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'object not suitable to provide group name and address');
        }

        $group = new Group();
        $group->setIdentifier($entity->getIdentifier());
        $group->setName($entity->getName());
        if ($this->auth->getCanReadMetadata($groupId)) {
            $group->addAccessRight(Group::ACCESS_RIGHT_READ_METADATA);
        }
        if ($this->auth->getCanReadContent($groupId)) {
            $group->addAccessRight(Group::ACCESS_RIGHT_READ_CONTENT);
        }
        if ($this->auth->getCanWrite($groupId)) {
            $group->addAccessRight(Group::ACCESS_RIGHT_WRITE);
        }
        $group->setStreet($entity->getLocalDataValue(
                $this->getAddressAttributes()[Configuration::GROUP_STREET_ATTRIBUTE]) ?? '');
        $group->setPostalCode($entity->getLocalDataValue(
                $this->getAddressAttributes()[Configuration::GROUP_POSTAL_CODE_ATTRIBUTE]) ?? '');
        $group->setLocality($entity->getLocalDataValue(
                $this->getAddressAttributes()[Configuration::GROUP_LOCALITY_ATTRIBUTE]) ?? '');
        $group->setCountry($entity->getLocalDataValue(
                $this->getAddressAttributes()[Configuration::GROUP_COUNTRY_ATTRIBUTE]) ?? '');

        return $group;
    }

    private function getAddressAttributes(): array
    {
        return $this->config[Configuration::GROUP_DATA_ADDRESS_ATTRIBUTES_NODE];
    }
}
