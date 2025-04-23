<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Entity;

date_default_timezone_set('UTC');

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\OpenApi\Model\Operation;
use ApiPlatform\OpenApi\Model\RequestBody;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\DispatchBundle\Rest\RequestRecipientProcessor;
use Dbp\Relay\DispatchBundle\Rest\RequestRecipientProvider;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    shortName: 'DispatchRequestRecipient',
    types: ['https://schema.org/Person'],
    operations: [
        new GetCollection(
            uriTemplate: '/dispatch/request-recipients',
            openapi: new Operation(
                tags: ['Dispatch']
            ),
            security: "is_granted('IS_AUTHENTICATED_FULLY')",
            provider: RequestRecipientProvider::class
        ),
        new Post(
            uriTemplate: '/dispatch/request-recipients',
            openapi: new Operation(
                tags: ['Dispatch'],
                requestBody: new RequestBody(
                    content: new \ArrayObject([
                        'application/ld+json' => [
                            'schema' => [
                                'type' => 'object',
                                'example' => [
                                    'dispatchRequestIdentifier' => '4d553985-d44f-404f-acf3-cd0eac7ae9c2',
                                    'givenName' => 'Max',
                                    'familyName' => 'Mustermann',
                                    'addressCountry' => 'AT',
                                    'postalCode' => '8010',
                                    'addressLocality' => 'Graz',
                                    'streetAddress' => 'Am Grund',
                                    'buildingNumber' => '1',
                                    'birthDate' => '1980-01-01',
                                ],
                            ],
                        ],
                    ])
                )
            ),
            security: "is_granted('IS_AUTHENTICATED_FULLY')",
            processor: RequestRecipientProcessor::class
        ),
        new Get(
            uriTemplate: '/dispatch/request-recipients/{identifier}',
            openapi: new Operation(
                tags: ['Dispatch']
            ),
            security: "is_granted('IS_AUTHENTICATED_FULLY')",
            provider: RequestRecipientProvider::class
        ),
        new Delete(
            uriTemplate: '/dispatch/request-recipients/{identifier}',
            openapi: new Operation(
                tags: ['Dispatch']
            ),
            security: "is_granted('IS_AUTHENTICATED_FULLY')",
            provider: RequestRecipientProvider::class,
            processor: RequestRecipientProcessor::class
        ),
    ],
    normalizationContext: [
        'groups' => ['DispatchRequestRecipient:output'],
    ],
    denormalizationContext: [
        'groups' => ['DispatchRequestRecipient:input'],
    ]
)]
#[ORM\Table(name: 'dispatch_request_recipients')]
#[ORM\Entity]
class RequestRecipient
{
    #[ApiProperty(identifier: true)]
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 50)]
    #[Groups(['DispatchRequestRecipient:output', 'DispatchRequest:output'])]
    private ?string $identifier = null;

    #[ApiProperty(iris: ['https://schema.org/dateCreated'])]
    #[ORM\Column(type: 'datetime_immutable')]
    #[Groups(['DispatchRequestRecipient:output', 'DispatchRequest:output'])]
    private ?\DateTimeInterface $dateCreated = null;

    #[ApiProperty]
    #[ORM\JoinColumn(name: 'dispatch_request_identifier', referencedColumnName: 'identifier', nullable: true)]
    #[ORM\ManyToOne(targetEntity: Request::class, inversedBy: 'recipients')]
    #[Groups(['DispatchRequestRecipient:output'])]
    private ?Request $request = null;

    #[ApiProperty(iris: ['https://schema.org/identifier'])]
    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    #[Groups(['DispatchRequestRecipient:output', 'DispatchRequestRecipient:input'])]
    private ?string $dispatchRequestIdentifier = null;

    #[ORM\Column(type: 'string', length: 50)]
    private ?string $recipientId = null;

    #[ApiProperty(iris: ['https://schema.org/givenName'])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['DispatchRequestRecipient:output', 'DispatchRequestRecipient:input', 'DispatchRequest:output'])]
    #[Assert\Length(max: 255, maxMessage: 'Only {{ limit }} letters are allowed')]
    private ?string $givenName = null;

    #[ApiProperty(iris: ['https://schema.org/familyName'])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['DispatchRequestRecipient:output', 'DispatchRequestRecipient:input', 'DispatchRequest:output'])]
    #[Assert\Length(max: 255, maxMessage: 'Only {{ limit }} letters are allowed')]
    private ?string $familyName = null;

    #[ApiProperty(iris: ['https://schema.org/addressCountry'])]
    #[ORM\Column(type: 'string', length: 2, nullable: true)]
    #[Groups(['DispatchRequestRecipient:read_address', 'DispatchRequestRecipient:input'])]
    #[Assert\Length(max: 2, maxMessage: 'Only {{ limit }} letter country codes are allowed')]
    private ?string $addressCountry = null;

    #[ApiProperty(iris: ['https://schema.org/postalCode'])]
    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    #[Groups(['DispatchRequestRecipient:read_address', 'DispatchRequestRecipient:input'])]
    #[Assert\Length(max: 20, maxMessage: 'Only {{ limit }} letter postal codes are allowed')]
    private ?string $postalCode = null;

    #[ApiProperty(iris: ['https://schema.org/addressLocality'])]
    #[ORM\Column(type: 'string', length: 120, nullable: true)]
    #[Groups(['DispatchRequestRecipient:read_address', 'DispatchRequestRecipient:input'])]
    #[Assert\Length(max: 120, maxMessage: 'Only {{ limit }} letters are allowed')]
    private ?string $addressLocality = null;

    #[ApiProperty(iris: ['https://schema.org/streetAddress'])]
    #[ORM\Column(type: 'string', length: 120, nullable: true)]
    #[Groups(['DispatchRequestRecipient:read_address', 'DispatchRequestRecipient:input'])]
    #[Assert\Length(max: 120, maxMessage: 'Only {{ limit }} letters are allowed')]
    private ?string $streetAddress = null;

    #[ApiProperty]
    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    #[Groups(['DispatchRequestRecipient:read_address', 'DispatchRequestRecipient:input'])]
    #[Assert\Length(max: 10, maxMessage: 'Only {{ limit }} letters are allowed')]
    private ?string $buildingNumber = null;

    #[ApiProperty(iris: ['http://schema.org/birthDate'])]
    #[ORM\Column(type: 'date_immutable', nullable: true)]
    #[Groups(['DispatchRequestRecipient:read_birth_date', 'DispatchRequestRecipient:input'])] // I could not find an Assert that doesn't cause an error to do proper checks
    private ?\DateTimeInterface $birthDate = null;

    #[ApiProperty]
    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    #[Groups(['DispatchRequestRecipient:output'])]
    private ?string $dualDeliveryID = null;

    #[ApiProperty]
    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    #[Groups(['DispatchRequestRecipient:output'])]
    private ?string $appDeliveryID = null;

    #[ApiProperty(iris: ['https://schema.org/endDate'])]
    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    #[Groups(['DispatchRequestRecipient:output'])]
    private ?\DateTimeInterface $deliveryEndDate = null;

    #[ApiProperty(iris: ['https://schema.org/identifier'])]
    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    #[Groups(['DispatchRequestRecipient:output', 'DispatchRequestRecipient:input', 'DispatchRequest:output'])]
    #[Assert\Length(max: 100, maxMessage: 'Only {{ limit }} letters are allowed')]
    private ?string $personIdentifier = null;

    #[ApiProperty]
    #[ORM\Column(type: 'boolean', nullable: true)]
    #[Groups(['DispatchRequestRecipient:output', 'DispatchRequest:output'])]
    private ?bool $postalDeliverable = false;

    #[ApiProperty]
    #[ORM\Column(type: 'boolean', nullable: true)]
    #[Groups(['DispatchRequestRecipient:output', 'DispatchRequest:output'])]
    private ?bool $electronicallyDeliverable = false;

    #[ApiProperty]
    #[Groups(['DispatchRequestRecipient:output', 'DispatchRequest:output'])]
    private ?DeliveryStatusChange $lastStatusChange = null;

    #[ApiProperty]
    #[ORM\OneToMany(targetEntity: DeliveryStatusChange::class, mappedBy: 'requestRecipient')]
    #[ORM\OrderBy(['orderId' => 'DESC'])]
    #[Groups(['DispatchRequestRecipient:output'])]
    private Collection $statusChanges;

    public function __construct()
    {
        $this->statusChanges = new ArrayCollection();
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

    public function getDispatchRequest(): ?Request
    {
        return $this->request;
    }

    public function getDispatchRequestIdentifier(): ?string
    {
        return $this->dispatchRequestIdentifier;
    }

    public function setDispatchRequestIdentifier(?string $dispatchRequestIdentifier): void
    {
        $this->dispatchRequestIdentifier = $dispatchRequestIdentifier;
    }

    public function getRecipientId(): ?string
    {
        return $this->recipientId;
    }

    public function setRecipientId(string $recipientId): void
    {
        $this->recipientId = $recipientId;
    }

    public function getFullName(): string
    {
        return $this->givenName.' '.$this->familyName;
    }

    public function getFullAddress(): string
    {
        return $this->streetAddress.' '.$this->buildingNumber.', '.$this->postalCode.
            ' '.$this->addressLocality.', '.$this->addressCountry;
    }

    public function getGivenName(): ?string
    {
        return $this->givenName;
    }

    public function setGivenName(?string $givenName): void
    {
        $this->givenName = $givenName;
    }

    public function getFamilyName(): ?string
    {
        return $this->familyName;
    }

    public function setFamilyName(?string $familyName): void
    {
        $this->familyName = $familyName;
    }

    public function setRequest(?Request $request): void
    {
        $this->request = $request;
    }

    public function getAddressCountry(): ?string
    {
        return $this->addressCountry;
    }

    public function setAddressCountry(?string $addressCountry): void
    {
        $this->addressCountry = $addressCountry;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function getAddressLocality(): ?string
    {
        return $this->addressLocality;
    }

    public function setAddressLocality(?string $addressLocality): void
    {
        $this->addressLocality = $addressLocality;
    }

    public function getStreetAddress(): ?string
    {
        return $this->streetAddress;
    }

    public function setStreetAddress(?string $streetAddress): void
    {
        $this->streetAddress = $streetAddress;
    }

    public function getBuildingNumber(): ?string
    {
        return $this->buildingNumber;
    }

    public function setBuildingNumber(?string $buildingNumber): void
    {
        $this->buildingNumber = $buildingNumber;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTimeInterface $birthDate): void
    {
        $this->birthDate = $birthDate !== null ? \DateTimeImmutable::createFromInterface($birthDate) : null;
    }

    public function getDualDeliveryID(): ?string
    {
        return $this->dualDeliveryID;
    }

    public function setDualDeliveryID(?string $dualDeliveryID): void
    {
        $this->dualDeliveryID = $dualDeliveryID;
    }

    public function getStatusChanges(): Collection
    {
        return $this->statusChanges;
    }

    public function getDeliveryEndDate(): ?\DateTimeInterface
    {
        return $this->deliveryEndDate;
    }

    public function setDeliveryEndDate(?\DateTimeInterface $deliveryEndDate): void
    {
        $this->deliveryEndDate = \DateTimeImmutable::createFromInterface($deliveryEndDate);
    }

    public function getAppDeliveryID(): string
    {
        return $this->appDeliveryID ??
            $this->request->getIdentifier().'-'.$this->identifier;
    }

    public function setAppDeliveryID(?string $appDeliveryID): void
    {
        $this->appDeliveryID = $appDeliveryID;
    }

    public function getPersonIdentifier(): ?string
    {
        return $this->personIdentifier;
    }

    public function setPersonIdentifier(?string $personIdentifier): void
    {
        $this->personIdentifier = $personIdentifier;
    }

    public function isPostalDeliverable(): ?bool
    {
        return $this->postalDeliverable;
    }

    public function setPostalDeliverable(?bool $postalDeliverable): void
    {
        $this->postalDeliverable = $postalDeliverable;
    }

    public function isElectronicallyDeliverable(): ?bool
    {
        return $this->electronicallyDeliverable;
    }

    public function setElectronicallyDeliverable(?bool $electronicallyDeliverable): void
    {
        $this->electronicallyDeliverable = $electronicallyDeliverable;
    }

    public function canDoPreAddressingRequest(): bool
    {
        return $this->getGivenName() && $this->getFamilyName() && $this->getBirthDate();
    }

    public function hasValidAddress(): bool
    {
        // We don't check the building number, because it's not always available
        return $this->getStreetAddress()
            && $this->getPostalCode()
            && $this->getAddressLocality()
            && $this->getAddressCountry();
    }

    public function postValidityCheck(): void
    {
        // If there is a person identifier, then there must not be any other personal data set
        if ($this->personIdentifier
            && (
                $this->givenName
                || $this->familyName
                || $this->streetAddress
                || $this->buildingNumber
                || $this->postalCode
                || $this->addressLocality
                || $this->addressCountry
                || $this->birthDate
            )
        ) {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'A request recipient can\'t contain a personIdentifier and personal data together!', 'dispatch:request-recipient-person-identifier-and-person-data-set');
        }
    }

    public function getLastStatusChange(): ?DeliveryStatusChange
    {
        return $this->lastStatusChange;
    }

    public function setLastStatusChange(?DeliveryStatusChange $lastStatusChange): void
    {
        $this->lastStatusChange = $lastStatusChange;
    }
}
