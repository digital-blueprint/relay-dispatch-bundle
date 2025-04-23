<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Entity;

date_default_timezone_set('UTC');

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\OpenApi\Model\Operation;
use ApiPlatform\OpenApi\Model\RequestBody;
use Dbp\Relay\DispatchBundle\Rest\PreAddressingRequestProcessor;
use Dbp\Relay\DispatchBundle\Rest\PreAddressingRequestProvider;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    shortName: 'DispatchPreAddressingRequest',
    types: ['https://schema.org/Action'],
    operations: [
        new Get(
            uriTemplate: '/dispatch/pre-addressing-requests/{identifier}',
            openapi: new Operation(
                tags: ['Dispatch']
            ),
            security: "is_granted('IS_AUTHENTICATED_FULLY')",
            provider: PreAddressingRequestProvider::class
        ),
        new GetCollection(
            uriTemplate: '/dispatch/pre-addressing-requests',
            openapi: new Operation(
                tags: ['Dispatch']
            ),
            security: "is_granted('IS_AUTHENTICATED_FULLY')",
            provider: PreAddressingRequestProvider::class
        ),
        new Post(
            uriTemplate: '/dispatch/pre-addressing-requests',
            openapi: new Operation(
                tags: ['Dispatch'],
                requestBody: new RequestBody(
                    content: new \ArrayObject([
                        'application/ld+json' => [
                            'schema' => [
                                'type' => 'object',
                                'example' => [
                                    'givenName' => 'Max',
                                    'familyName' => 'Mustermann',
                                    'birthDate' => '1980-01-01',
                                ],
                            ],
                        ],
                    ])
                )
            ),
            security: "is_granted('IS_AUTHENTICATED_FULLY')",
            processor: PreAddressingRequestProcessor::class
        ),
    ],
    normalizationContext: [
        'groups' => ['DispatchPreAddressingRequest:output'],
    ],
    denormalizationContext: [
        'groups' => ['DispatchPreAddressingRequest:input'],
    ]
)]
class PreAddressingRequest
{
    #[ApiProperty(identifier: true)]
    #[Groups(['DispatchPreAddressingRequest:output'])]
    private ?string $identifier = null;

    #[ApiProperty(iris: ['https://schema.org/givenName'])]
    #[Groups(['DispatchPreAddressingRequest:output', 'DispatchPreAddressingRequest:input', 'DispatchRequest:output'])]
    #[Assert\Length(max: 255, maxMessage: 'Only {{ limit }} letters are allowed')]
    private ?string $givenName = null;

    #[ApiProperty(iris: ['https://schema.org/familyName'])]
    #[Groups(['DispatchPreAddressingRequest:output', 'DispatchPreAddressingRequest:input', 'DispatchRequest:output'])]
    #[Assert\Length(max: 255, maxMessage: 'Only {{ limit }} letters are allowed')]
    private ?string $familyName = null;

    #[ApiProperty(iris: ['http://schema.org/birthDate'])]
    #[Groups(['DispatchPreAddressingRequest:output', 'DispatchPreAddressingRequest:input'])] // I could not find an Assert that doesn't cause an error to do proper checks
    #[Assert\NotBlank]
    private ?\DateTimeInterface $birthDate = null;

    #[Groups(['DispatchPreAddressingRequest:output'])]
    private ?string $dualDeliveryID = null;

    public function __construct()
    {
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(?string $identifier): void
    {
        $this->identifier = $identifier;
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

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTimeInterface $birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    public function getDualDeliveryID(): ?string
    {
        return $this->dualDeliveryID;
    }

    public function setDualDeliveryID(?string $dualDeliveryID): void
    {
        $this->dualDeliveryID = $dualDeliveryID;
    }
}
