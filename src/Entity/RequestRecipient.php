<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={
 *         "post" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY')",
 *             "path" = "/dispatch/request-recipients",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"},
 *                 "requestBody" = {
 *                     "content" = {
 *                         "application/json" = {
 *                             "schema" = {"type" = "object"},
 *                             "example" = {
 *                                 "dispatchRequestIdentifier" = "4d553985-d44f-404f-acf3-cd0eac7ae9c2",
 *                                 "givenName" = "Max",
 *                                 "familyName" = "Mustermann",
 *                                 "postalAddress" = "Am Grund 1"
 *                             },
 *                         }
 *                     }
 *                 },
 *             }
 *         },
 *         "get" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY')",
 *             "path" = "/dispatch/request-recipients",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"}
 *             },
 *         }
 *     },
 *     itemOperations={
 *         "get" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY')",
 *             "path" = "/dispatch/request-recipients/{identifier}",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"}
 *             },
 *         },
 *         "delete" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY')",
 *             "path" = "/dispatch/request-recipients/{identifier}",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"}
 *             },
 *         }
 *     },
 *     iri="https://schema.org/Action",
 *     shortName="DispatchRequestRecipient",
 *     normalizationContext={
 *         "groups" = {"DispatchRequestRecipient:output"},
 *         "jsonld_embed_context" = true
 *     },
 *     denormalizationContext={
 *         "groups" = {"DispatchRequestRecipient:input"},
 *         "jsonld_embed_context" = true
 *     }
 * )
 */
class RequestRecipient
{
    /**
     * @ApiProperty(identifier=true)
     * @Groups({"DispatchRequestRecipient:output"})
     */
    private $identifier;

    /**
     * @ApiProperty(iri="https://schema.org/dateCreated")
     * @Groups({"DispatchRequestRecipient:output"})
     *
     * @var \DateTime
     */
    private $dateCreated;

    /**
     * @ApiProperty(iri="https://schema.org/identifier")
     * @Groups({"DispatchRequestRecipient:output", "DispatchRequestRecipient:input"})
     *
     * @var string
     */
    private $dispatchRequestIdentifier;

    /**
     * @ApiProperty(iri="https://schema.org/givenName")
     * @Groups({"DispatchRequestRecipient:output", "DispatchRequestRecipient:input"})
     *
     * @var string
     */
    private $givenName;

    /**
     * @ApiProperty(iri="https://schema.org/familyName")
     * @Groups({"DispatchRequestRecipient:output", "DispatchRequestRecipient:input"})
     *
     * @var string
     */
    private $familyName;

    /**
     * @ApiProperty(iri="https://schema.org/address")
     * @Groups({"DispatchRequestRecipient:output", "DispatchRequestRecipient:input"})
     *
     * @var string
     */
    private $postalAddress;

    public function getIdentifier(): string
    {
        return (string) $this->identifier;
    }

    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getDateCreated(): \DateTime
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTime $dateCreated): void
    {
        $this->dateCreated = $dateCreated;
    }

    public function getDispatchRequestIdentifier(): string
    {
        return $this->dispatchRequestIdentifier;
    }

    public function setDispatchRequestIdentifier(string $dispatchRequestIdentifier): void
    {
        $this->dispatchRequestIdentifier = $dispatchRequestIdentifier;
    }

    public function getGivenName(): ?string
    {
        return $this->givenName;
    }

    public function setGivenName(string $givenName): void
    {
        $this->givenName = $givenName;
    }

    public function getFamilyName(): ?string
    {
        return $this->familyName;
    }

    public function setFamilyName(string $familyName): void
    {
        $this->familyName = $familyName;
    }

    public function getPostalAddress(): ?string
    {
        return $this->postalAddress;
    }

    public function setPostalAddress(string $postalAddress): void
    {
        $this->postalAddress = $postalAddress;
    }

    public static function fromRequestRecipientPersistence(RequestRecipientPersistence $requestRecipientPersistence): RequestRecipient
    {
        $requestRecipient = new RequestRecipient();
        $requestRecipient->setIdentifier($requestRecipientPersistence->getIdentifier());
        $requestRecipient->setDispatchRequestIdentifier($requestRecipientPersistence->getDispatchRequestIdentifier() === null ? '' : $requestRecipientPersistence->getDispatchRequestIdentifier());
        $requestRecipient->setGivenName($requestRecipientPersistence->getGivenName() === null ? '' : $requestRecipientPersistence->getGivenName());
        $requestRecipient->setFamilyName($requestRecipientPersistence->getFamilyName() === null ? '' : $requestRecipientPersistence->getFamilyName());
        $requestRecipient->setPostalAddress($requestRecipientPersistence->getPostalAddress() === null ? '' : $requestRecipientPersistence->getPostalAddress());

        if ($requestRecipientPersistence->getDateCreated() !== null) {
            $requestRecipient->setDateCreated($requestRecipientPersistence->getDateCreated());
        }

        return $requestRecipient;
    }

    /**
     * @return RequestRecipient[]
     */
    public static function fromRequestRecipientPersistences(array $requestRecipientPersistences): array
    {
        $requestRecipients = [];

        foreach ($requestRecipientPersistences as $requestRecipientPersistence) {
            $requestRecipients[] = self::fromRequestRecipientPersistence($requestRecipientPersistence);
        }

        return $requestRecipients;
    }
}
