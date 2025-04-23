<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\OpenApi\Model\Operation;
use Dbp\Relay\DispatchBundle\Rest\GroupProvider;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    shortName: 'DispatchGroup',
    types: ['https://schema.org/Organization'],
    operations: [
        new Get(
            uriTemplate: '/dispatch/groups/{identifier}',
            openapi: new Operation(
                tags: ['Dispatch']
            ),
            provider: GroupProvider::class
        ),
        new GetCollection(
            uriTemplate: '/dispatch/groups',
            openapi: new Operation(
                tags: ['Dispatch']
            ),
            provider: GroupProvider::class
        ),
    ],
    normalizationContext: [
        'groups' => ['DispatchGroup:output'],
    ]
)]
class Group
{
    public const ROLE_READ_METADATA = 'rm';
    public const ROLE_READ_CONTENT = 'rc';
    public const ROLE_WRITE = 'w';
    public const ROLE_WRITE_READ_ADDRESS = 'wra';

    #[ApiProperty(identifier: true)]
    #[Groups(['DispatchGroup:output'])]
    private ?string $identifier = null;

    #[ApiProperty(iris: ['https://schema.org/name'])]
    #[Groups(['DispatchGroup:output'])]
    private ?string $name = null;

    #[ApiProperty(iris: ['https://schema.org/streetAddress'])]
    #[Groups(['DispatchGroup:output'])]
    private ?string $street = null;

    #[ApiProperty(iris: ['https://schema.org/addressLocality'])]
    #[Groups(['DispatchGroup:output'])]
    private ?string $locality = null;

    #[ApiProperty(iris: ['https://schema.org/postalCode'])]
    #[Groups(['DispatchGroup:output'])]
    private ?string $postalCode = null;

    #[ApiProperty(iris: ['https://schema.org/addressCountry'])]
    #[Groups(['DispatchGroup:output'])]
    private ?string $country = null;

    /**
     * @var string[]
     */
    #[ApiProperty]
    #[Groups(['DispatchGroup:output'])]
    private array $accessRights = [];

    public function setIdentifier(?string $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): void
    {
        $this->street = $street;
    }

    public function getLocality(): ?string
    {
        return $this->locality;
    }

    public function setLocality(?string $locality): void
    {
        $this->locality = $locality;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): void
    {
        $this->country = $country;
    }

    public function addGroupRole(string $groupRole): void
    {
        if (!in_array($groupRole, $this->accessRights, true) ?? (
            $groupRole === self::ROLE_READ_CONTENT
            || $groupRole === self::ROLE_READ_METADATA
            || $groupRole === self::ROLE_WRITE
            || $groupRole === self::ROLE_WRITE_READ_ADDRESS)) {
            $this->accessRights[] = $groupRole;
        }
    }

    public function getAccessRights(): array
    {
        return $this->accessRights;
    }
}
