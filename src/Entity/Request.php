<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Entity;

date_default_timezone_set('UTC');

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\OpenApi\Model\Operation;
use ApiPlatform\OpenApi\Model\Parameter;
use ApiPlatform\OpenApi\Model\RequestBody;
use Dbp\Relay\DispatchBundle\Rest\PostSubmitRequest;
use Dbp\Relay\DispatchBundle\Rest\RequestProcessor;
use Dbp\Relay\DispatchBundle\Rest\RequestProvider;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    shortName: 'DispatchRequest',
    types: ['https://schema.org/Action'],
    operations: [
        new Get(
            uriTemplate: '/dispatch/requests/{identifier}',
            openapi: new Operation(
                tags: ['Dispatch']
            ),
            security: "is_granted('IS_AUTHENTICATED_FULLY')",
            provider: RequestProvider::class
        ),
        new Patch(
            uriTemplate: '/dispatch/requests/{identifier}',
            inputFormats: [
                'json' => ['application/merge-patch+json'],
            ],
            openapi: new Operation(
                tags: ['Dispatch']
            ),
            security: "is_granted('IS_AUTHENTICATED_FULLY')",
            provider: RequestProvider::class,
            processor: RequestProcessor::class
        ),
        new Delete(
            uriTemplate: '/dispatch/requests/{identifier}',
            openapi: new Operation(
                tags: ['Dispatch']
            ),
            security: "is_granted('IS_AUTHENTICATED_FULLY')",
            provider: RequestProvider::class,
            processor: RequestProcessor::class
        ),
        new Post(
            uriTemplate: '/dispatch/requests',
            openapi: new Operation(
                tags: ['Dispatch'],
                requestBody: new RequestBody(
                    content: new \ArrayObject([
                        'application/ld+json' => [
                            'schema' => [
                                'type' => 'object',
                                'example' => [
                                    'name' => 'Aussendung 42',
                                    'senderFullName' => 'Max Mustermann',
                                    'senderOrganizationName' => 'Studienservice TU Graz',
                                    'senderAddressCountry' => 'AT',
                                    'senderPostalCode' => '8010',
                                    'senderAddressLocality' => 'Graz',
                                    'senderStreetAddress' => 'Am Grund',
                                    'senderBuildingNumber' => '1',
                                    'groupId' => '11072',
                                    'referenceNumber' => 'GZ-2023/01-13',
                                ],
                            ],
                        ],
                    ])
                )
            ),
            security: "is_granted('IS_AUTHENTICATED_FULLY')",
            processor: RequestProcessor::class
        ),
        new GetCollection(
            uriTemplate: '/dispatch/requests',
            openapi: new Operation(
                tags: ['Dispatch'],
                parameters: [
                    new Parameter(
                        name: 'groupId',
                        in: 'query',
                        description: 'The group ID for which to fetch requests',
                        required: true,
                        schema: ['type' => 'string']
                    ),
                ]
            ),
            security: "is_granted('IS_AUTHENTICATED_FULLY')",
            provider: RequestProvider::class
        ),
        new Post(
            uriTemplate: '/dispatch/requests/{identifier}/submit',
            controller: PostSubmitRequest::class,
            openapi: new Operation(
                tags: ['Dispatch'],
                summary: 'Submits the request.',
                parameters: [
                    new Parameter(
                        name: 'identifier',
                        in: 'path',
                        description: 'ID of the request',
                        required: true,
                        schema: ['type' => 'string'],
                        example: '4d553985-d44f-404f-acf3-cd0eac7ae9c2'
                    ),
                ],
                requestBody: new RequestBody(
                    content: new \ArrayObject([
                        'application/ld+json' => [
                            'schema' => [
                                'type' => 'object',
                                'example' => '{}',
                            ],
                        ],
                    ])
                )
            ),
            security: "is_granted('IS_AUTHENTICATED_FULLY')",
            read: false,
            deserialize: false,
            validate: false,
            write: false,
            name: 'post_submit'
        ),
    ],
    normalizationContext: [
        'groups' => ['DispatchRequest:output'],
    ],
    denormalizationContext: [
        'groups' => ['DispatchRequest:input'],
    ]
)]
#[ORM\Table(name: 'dispatch_requests')]
#[ORM\Entity]
class Request
{
    #[ApiProperty(identifier: true)]
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 50)]
    #[Groups(['DispatchRequest:output'])]
    private ?string $identifier = null;

    #[ApiProperty(iris: ['https://schema.org/name'])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['DispatchRequest:read_content', 'DispatchRequest:input'])]
    #[Assert\Length(max: 255, maxMessage: 'Only {{ limit }} letters are allowed')]
    private ?string $name = null;

    #[ApiProperty(iris: ['https://schema.org/dateCreated'])]
    #[ORM\Column(type: 'datetime_immutable')]
    #[Groups(['DispatchRequest:output'])]
    private ?\DateTimeInterface $dateCreated = null;

    #[ApiProperty(iris: ['https://schema.org/identifier'])]
    #[ORM\Column(type: 'string', length: 50)]
    #[Groups(['DispatchRequest:output'])]
    private ?string $personIdentifier = null;

    #[ApiProperty(iris: ['https://schema.org/alternateName'])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['DispatchRequest:output', 'DispatchRequest:input'])]
    #[Assert\Length(max: 255, maxMessage: 'Only {{ limit }} letters are allowed')]
    private ?string $senderFullName = null;

    #[ApiProperty(iris: ['https://schema.org/alternateName'])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['DispatchRequest:output', 'DispatchRequest:input'])]
    #[Assert\Length(max: 255, maxMessage: 'Only {{ limit }} letters are allowed')]
    private ?string $senderOrganizationName = null;

    #[ApiProperty]
    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    #[Groups(['DispatchRequest:output'])]
    private ?\DateTimeInterface $dateSubmitted = null;

    #[ApiProperty(iris: ['https://schema.org/addressCountry'])]
    #[ORM\Column(type: 'string', length: 2, nullable: true)]
    #[Groups(['DispatchRequest:output', 'DispatchRequest:input'])]
    #[Assert\Length(max: 2, maxMessage: 'Only {{ limit }} letter country codes are allowed')]
    private ?string $senderAddressCountry = null;

    #[ApiProperty(iris: ['https://schema.org/postalCode'])]
    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    #[Groups(['DispatchRequest:output', 'DispatchRequest:input'])]
    #[Assert\Length(max: 20, maxMessage: 'Only {{ limit }} letter postal codes are allowed')]
    private ?string $senderPostalCode = null;

    #[ApiProperty(iris: ['https://schema.org/addressLocality'])]
    #[ORM\Column(type: 'string', length: 120, nullable: true)]
    #[Groups(['DispatchRequest:output', 'DispatchRequest:input'])]
    #[Assert\Length(max: 120, maxMessage: 'Only {{ limit }} letters are allowed')]
    private ?string $senderAddressLocality = null;

    #[ApiProperty(iris: ['https://schema.org/streetAddress'])]
    #[ORM\Column(type: 'string', length: 120, nullable: true)]
    #[Groups(['DispatchRequest:output', 'DispatchRequest:input'])]
    #[Assert\Length(max: 120, maxMessage: 'Only {{ limit }} letters are allowed')]
    private ?string $senderStreetAddress = null;

    #[ApiProperty]
    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    #[Groups(['DispatchRequest:output', 'DispatchRequest:input'])]
    #[Assert\Length(max: 10, maxMessage: 'Only {{ limit }} letters are allowed')]
    private ?string $senderBuildingNumber = null;

    #[ApiProperty]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['DispatchRequest:output', 'DispatchRequest:input'])]
    #[Assert\Length(max: 255, maxMessage: 'Only {{ limit }} letters are allowed')]
    #[Assert\NotNull]
    private ?string $groupId = null;

    #[ApiProperty]
    #[ORM\Column(type: 'string', length: 25, nullable: true)]
    #[Groups(['DispatchRequest:output', 'DispatchRequest:input'])]
    #[Assert\Length(max: 25, maxMessage: 'Only {{ limit }} letters are allowed')]
    private ?string $referenceNumber = null;

    #[ORM\OneToMany(targetEntity: RequestRecipient::class, mappedBy: 'request')]
    #[ORM\OrderBy(['dateCreated' => 'ASC'])]
    #[Groups(['DispatchRequest:output'])]
    private Collection $recipients;

    #[ORM\OneToMany(targetEntity: RequestFile::class, mappedBy: 'request')]
    #[ORM\OrderBy(['dateCreated' => 'ASC'])]
    #[Groups(['DispatchRequest:read_content'])]
    private Collection $files;

    public function __construct()
    {
        $this->recipients = new ArrayCollection();
        $this->files = new ArrayCollection();
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): void
    {
        $this->dateCreated = \DateTimeImmutable::createFromInterface($dateCreated);
    }

    public function getPersonIdentifier(): ?string
    {
        return $this->personIdentifier;
    }

    public function setPersonIdentifier(string $personIdentifier): void
    {
        $this->personIdentifier = $personIdentifier;
    }

    public function getSenderFullName(): ?string
    {
        return $this->senderFullName;
    }

    public function setSenderFullName(?string $senderFullName): void
    {
        $this->senderFullName = $senderFullName;
    }

    public function getSenderOrganizationName(): ?string
    {
        return $this->senderOrganizationName;
    }

    public function setSenderOrganizationName(?string $senderOrganizationName): void
    {
        $this->senderOrganizationName = $senderOrganizationName;
    }

    public function getRecipients(): Collection
    {
        return $this->recipients;
    }

    public function getFiles(): Collection
    {
        return $this->files;
    }

    public function getDateSubmitted(): ?\DateTimeInterface
    {
        return $this->dateSubmitted;
    }

    public function isSubmitted(): bool
    {
        return $this->dateSubmitted !== null;
    }

    public function setDateSubmitted(?\DateTimeInterface $dateSubmitted): void
    {
        $this->dateSubmitted = \DateTimeImmutable::createFromInterface($dateSubmitted);
    }

    public function getSenderAddressCountry(): ?string
    {
        return $this->senderAddressCountry;
    }

    public function setSenderAddressCountry(?string $senderAddressCountry): void
    {
        $this->senderAddressCountry = $senderAddressCountry;
    }

    public function getSenderPostalCode(): ?string
    {
        return $this->senderPostalCode;
    }

    public function setSenderPostalCode(?string $senderPostalCode): void
    {
        $this->senderPostalCode = $senderPostalCode;
    }

    public function getSenderAddressLocality(): ?string
    {
        return $this->senderAddressLocality;
    }

    public function setSenderAddressLocality(?string $senderAddressLocality): void
    {
        $this->senderAddressLocality = $senderAddressLocality;
    }

    public function getSenderStreetAddress(): ?string
    {
        return $this->senderStreetAddress;
    }

    public function setSenderStreetAddress(?string $senderStreetAddress): void
    {
        $this->senderStreetAddress = $senderStreetAddress;
    }

    public function getSenderBuildingNumber(): ?string
    {
        return $this->senderBuildingNumber;
    }

    public function setSenderBuildingNumber(?string $senderBuildingNumber): void
    {
        $this->senderBuildingNumber = $senderBuildingNumber;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getGroupId(): ?string
    {
        return $this->groupId;
    }

    public function setGroupId(?string $groupId): void
    {
        $this->groupId = $groupId;
    }

    public function setRequestRecipients(Collection $recipients): void
    {
        $this->recipients = $recipients;
    }

    public function setRequestFiles(Collection $files): void
    {
        $this->files = $files;
    }

    public function getReferenceNumber(): ?string
    {
        return $this->referenceNumber;
    }

    public function setReferenceNumber(?string $referenceNumber): void
    {
        $this->referenceNumber = $referenceNumber;
    }
}
