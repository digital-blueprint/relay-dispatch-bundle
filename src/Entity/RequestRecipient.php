<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="dispatch_request_recipients")
 * @ApiResource(
 *     collectionOperations={
 *         "post" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY') and is_granted('ROLE_SCOPE_DISPATCH')",
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
 *                                 "addressCountry" = "AT",
 *                                 "postalCode" = "8010",
 *                                 "addressLocality" = "Graz",
 *                                 "streetAddress" = "Am Grund",
 *                                 "buildingNumber" = "1"
 *                             },
 *                         }
 *                     }
 *                 },
 *             }
 *         },
 *         "get" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY') and is_granted('ROLE_SCOPE_DISPATCH')",
 *             "path" = "/dispatch/request-recipients",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"}
 *             },
 *         }
 *     },
 *     itemOperations={
 *         "get" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY') and is_granted('ROLE_SCOPE_DISPATCH')",
 *             "path" = "/dispatch/request-recipients/{identifier}",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"}
 *             },
 *         },
 *         "put" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY') and is_granted('ROLE_SCOPE_DISPATCH')",
 *             "path" = "/dispatch/request-recipients/{identifier}",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"}
 *             },
 *         },
 *         "delete" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY') and is_granted('ROLE_SCOPE_DISPATCH')",
 *             "path" = "/dispatch/request-recipients/{identifier}",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"}
 *             },
 *         }
 *     },
 *     iri="https://schema.org/Person",
 *     shortName="DispatchRequestRecipient",
 *     normalizationContext={
 *         "groups" = {"DispatchRequestRecipient:output", "DispatchRequest:output"},
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
     * @ORM\Id
     * @ORM\Column(type="string", length=50)
     * @ApiProperty(identifier=true)
     * @Groups({"DispatchRequestRecipient:output", "DispatchRequest:output"})
     */
    private $identifier;

    /**
     * @ORM\Column(type="datetime")
     * @ApiProperty(iri="https://schema.org/dateCreated")
     * @Groups({"DispatchRequestRecipient:output", "DispatchRequest:output"})
     *
     * @var \DateTime
     */
    private $dateCreated;

    /**
     * @ORM\ManyToOne(targetEntity="Request", inversedBy="recipients")
     * @ORM\JoinColumn(name="dispatch_request_identifier", referencedColumnName="identifier")
     * @ApiProperty
     * @Groups({"DispatchRequestRecipient:output"})
     *
     * @var Request
     */
    private $request;

    /**
     * @ORM\Column(type="string", length=50)
     * @ApiProperty(iri="https://schema.org/identifier")
     * @Groups({"DispatchRequestRecipient:output", "DispatchRequestRecipient:input"})
     *
     * @var string
     */
    private $dispatchRequestIdentifier;

    /**
     * @ORM\Column(type="string", length=50)
     *
     * @var string
     */
    private $recipientId;

    /**
     * @ORM\Column(type="string", length=255)
     * @ApiProperty(iri="https://schema.org/givenName")
     * @Groups({"DispatchRequestRecipient:output", "DispatchRequestRecipient:input", "DispatchRequest:output"})
     *
     * @var string
     */
    private $givenName;

    /**
     * @ORM\Column(type="string", length=255)
     * @ApiProperty(iri="https://schema.org/familyName")
     * @Groups({"DispatchRequestRecipient:output", "DispatchRequestRecipient:input", "DispatchRequest:output"})
     *
     * @var string
     */
    private $familyName;

    /**
     * @ORM\Column(type="string", length=2)
     * @ApiProperty(iri="https://schema.org/addressCountry")
     * @Groups({"DispatchRequestRecipient:output", "DispatchRequestRecipient:input", "DispatchRequest:output"})
     *
     * @var string
     */
    private $addressCountry;

    /**
     * @ORM\Column(type="string", length=20)
     * @ApiProperty(iri="https://schema.org/postalCode")
     * @Groups({"DispatchRequestRecipient:output", "DispatchRequestRecipient:input", "DispatchRequest:output"})
     *
     * @var string
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string", length=120)
     * @ApiProperty(iri="https://schema.org/addressLocality")
     * @Groups({"DispatchRequestRecipient:output", "DispatchRequestRecipient:input", "DispatchRequest:output"})
     *
     * @var string
     */
    private $addressLocality;

    /**
     * @ORM\Column(type="string", length=120)
     * @ApiProperty(iri="https://schema.org/streetAddress")
     * @Groups({"DispatchRequestRecipient:output", "DispatchRequestRecipient:input", "DispatchRequest:output"})
     *
     * @var string
     */
    private $streetAddress;

    /**
     * @ORM\Column(type="string", length=10)
     * @ApiProperty
     * @Groups({"DispatchRequestRecipient:output", "DispatchRequestRecipient:input", "DispatchRequest:output"})
     *
     * @var string
     */
    private $buildingNumber;

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

    public function getDispatchRequest(): Request
    {
        return $this->request;
    }

    public function getDispatchRequestIdentifier(): string
    {
        return $this->dispatchRequestIdentifier;
    }

    public function setDispatchRequestIdentifier(string $dispatchRequestIdentifier): void
    {
        $this->dispatchRequestIdentifier = $dispatchRequestIdentifier;
    }

    public function getRecipientId(): string
    {
        return $this->recipientId;
    }

    public function setRecipientId(string $recipientId): void
    {
        $this->recipientId = $recipientId;
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

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function getAddressCountry(): string
    {
        return $this->addressCountry;
    }

    public function setAddressCountry(string $addressCountry): void
    {
        $this->addressCountry = $addressCountry;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function getAddressLocality(): string
    {
        return $this->addressLocality;
    }

    public function setAddressLocality(string $addressLocality): void
    {
        $this->addressLocality = $addressLocality;
    }

    public function getStreetAddress(): string
    {
        return $this->streetAddress;
    }

    public function setStreetAddress(string $streetAddress): void
    {
        $this->streetAddress = $streetAddress;
    }

    public function getBuildingNumber(): string
    {
        return $this->buildingNumber;
    }

    public function setBuildingNumber(string $buildingNumber): void
    {
        $this->buildingNumber = $buildingNumber;
    }
}