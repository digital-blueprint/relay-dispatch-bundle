<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Dbp\Relay\DispatchBundle\Controller\PostSubmitRequest;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="dispatch_requests")
 * @ApiResource(
 *     collectionOperations={
 *         "post" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY') and is_granted('ROLE_SCOPE_DISPATCH')",
 *             "path" = "/dispatch/requests",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"},
 *                 "requestBody" = {
 *                     "content" = {
 *                         "application/json" = {
 *                             "schema" = {"type" = "object"},
 *                             "example" = {
 *                                 "senderGivenName" = "Max",
 *                                 "senderFamilyName" = "Mustermann",
 *                                 "senderAddressCountry" = "AT",
 *                                 "senderPostalCode" = "8010",
 *                                 "senderAddressLocality" = "Graz",
 *                                 "senderStreetAddress" = "Am Grund",
 *                                 "senderBuildingNumber" = "1"
 *                              },
 *                         }
 *                     }
 *                 },
 *             }
 *         },
 *         "get" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY') and is_granted('ROLE_SCOPE_DISPATCH')",
 *             "path" = "/dispatch/requests",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"}
 *             },
 *         }
 *     },
 *     itemOperations={
 *         "get" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY') and is_granted('ROLE_SCOPE_DISPATCH')",
 *             "path" = "/dispatch/requests/{identifier}",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"}
 *             },
 *         },
 *         "put" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY') and is_granted('ROLE_SCOPE_DISPATCH')",
 *             "path" = "/dispatch/requests/{identifier}",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"}
 *             },
 *         },
 *         "delete" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY') and is_granted('ROLE_SCOPE_DISPATCH')",
 *             "path" = "/dispatch/requests/{identifier}",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"}
 *             },
 *         },
 *         "post_submit" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY') and is_granted('ROLE_SCOPE_DISPATCH')",
 *             "method" = "POST",
 *             "path" = "/dispatch/requests/{identifier}/submit",
 *             "controller" = PostSubmitRequest::class,
 *             "read" = false,
 *             "write" = false,
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"},
 *                 "summary" = "Submits the request.",
 *                 "requestBody" = {
 *                     "content" = {
 *                         "application/json" = {
 *                             "schema" = {"type" = "object"},
 *                             "example" = {}
 *                         }
 *                     }
 *                 },
 *                 "parameters" = {
 *                     {"name" = "identifier", "in" = "path", "description" = "ID of the request", "required" = true, "type" = "string", "example" = "4d553985-d44f-404f-acf3-cd0eac7ae9c2"},
 *                 }
 *             },
 *         },
 *     },
 *     iri="https://schema.org/Action",
 *     shortName="DispatchRequest",
 *     normalizationContext={
 *         "groups" = {"DispatchRequest:output"},
 *         "jsonld_embed_context" = true
 *     },
 *     denormalizationContext={
 *         "groups" = {"DispatchRequest:input"},
 *         "jsonld_embed_context" = true
 *     }
 * )
 */
class Request
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=50)
     * @ApiProperty(identifier=true)
     * @Groups({"DispatchRequest:output"})
     */
    private $identifier;

    /**
     * @ORM\Column(type="datetime")
     * @ApiProperty(iri="https://schema.org/dateCreated")
     * @Groups({"DispatchRequest:output"})
     *
     * @var \DateTime
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="string", length=50)
     * @ApiProperty(iri="https://schema.org/identifier")
     * @Groups({"DispatchRequest:output"})
     *
     * @var string
     */
    private $personIdentifier;

    /**
     * @ORM\Column(type="string", length=255)
     * @ApiProperty(iri="https://schema.org/givenName")
     * @Groups({"DispatchRequest:output", "DispatchRequest:input"})
     *
     * @var string
     */
    private $senderGivenName;

    /**
     * @ORM\Column(type="string", length=255)
     * @ApiProperty(iri="https://schema.org/familyName")
     * @Groups({"DispatchRequest:output", "DispatchRequest:input"})
     *
     * @var string
     */
    private $senderFamilyName;

    /**
     * @ORM\Column(type="datetime")
     * @ApiProperty
     * @Groups({"DispatchRequest:output"})
     *
     * @var \DateTime
     */
    private $dateSubmitted;

    /**
     * @ORM\Column(type="string", length=2)
     * @ApiProperty(iri="https://schema.org/addressCountry")
     * @Groups({"DispatchRequest:output", "DispatchRequest:input"})
     *
     * @var string
     */
    private $senderAddressCountry;

    /**
     * @ORM\Column(type="string", length=20)
     * @ApiProperty(iri="https://schema.org/postalCode")
     * @Groups({"DispatchRequest:output", "DispatchRequest:input"})
     *
     * @var string
     */
    private $senderPostalCode;

    /**
     * @ORM\Column(type="string", length=120)
     * @ApiProperty(iri="https://schema.org/addressLocality")
     * @Groups({"DispatchRequest:output", "DispatchRequest:input"})
     *
     * @var string
     */
    private $senderAddressLocality;

    /**
     * @ORM\Column(type="string", length=120)
     * @ApiProperty(iri="https://schema.org/streetAddress")
     * @Groups({"DispatchRequest:output", "DispatchRequest:input"})
     *
     * @var string
     */
    private $senderStreetAddress;

    /**
     * @ORM\Column(type="string", length=10)
     * @ApiProperty
     * @Groups({"DispatchRequest:output", "DispatchRequest:input"})
     *
     * @var string
     */
    private $senderBuildingNumber;

    /**
     * @ORM\OneToMany(targetEntity="RequestRecipient", mappedBy="request")
     * @ORM\OrderBy({"dateCreated" = "ASC"})
     * @Groups({"DispatchRequest:output"})
     */
    private $recipients;

    /**
     * @ORM\OneToMany(targetEntity="RequestFile", mappedBy="request")
     * @ORM\OrderBy({"dateCreated" = "ASC"})
     * @Groups({"DispatchRequest:output"})
     */
    private $files;

    /**
     * @ORM\OneToMany(targetEntity="RequestStatusChange", mappedBy="request")
     * @ORM\OrderBy({"dateCreated" = "DESC"})
     * @Groups({"DispatchRequest:output"})
     */
    private $statusChanges;

    public function __construct()
    {
        $this->recipients = new ArrayCollection();
        $this->files = new ArrayCollection();
        $this->statusChanges = new ArrayCollection();
    }

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

    public function getPersonIdentifier(): string
    {
        return $this->personIdentifier;
    }

    public function setPersonIdentifier(string $personIdentifier): void
    {
        $this->personIdentifier = $personIdentifier;
    }

    public function getSenderGivenName(): ?string
    {
        return $this->senderGivenName;
    }

    public function setSenderGivenName(string $senderGivenName): void
    {
        $this->senderGivenName = $senderGivenName;
    }

    public function getSenderFamilyName(): ?string
    {
        return $this->senderFamilyName;
    }

    public function setSenderFamilyName(string $senderFamilyName): void
    {
        $this->senderFamilyName = $senderFamilyName;
    }

    public function getRecipients()
    {
        return $this->recipients;
    }

    public function getFiles()
    {
        return $this->files;
    }

    public function getStatusChanges()
    {
        return $this->statusChanges;
    }

    public function getDateSubmitted(): ?\DateTime
    {
        return $this->dateSubmitted;
    }

    public function setDateSubmitted(\DateTime $dateSubmitted): void
    {
        $this->dateSubmitted = $dateSubmitted;
    }

    public function getSenderAddressCountry(): string
    {
        return $this->senderAddressCountry;
    }

    public function setSenderAddressCountry(string $senderAddressCountry): void
    {
        $this->senderAddressCountry = $senderAddressCountry;
    }

    public function getSenderPostalCode(): string
    {
        return $this->senderPostalCode;
    }

    public function setSenderPostalCode(string $senderPostalCode): void
    {
        $this->senderPostalCode = $senderPostalCode;
    }

    public function getSenderAddressLocality(): string
    {
        return $this->senderAddressLocality;
    }

    public function setSenderAddressLocality(string $senderAddressLocality): void
    {
        $this->senderAddressLocality = $senderAddressLocality;
    }

    public function getSenderStreetAddress(): string
    {
        return $this->senderStreetAddress;
    }

    public function setSenderStreetAddress(string $senderStreetAddress): void
    {
        $this->senderStreetAddress = $senderStreetAddress;
    }

    public function getSenderBuildingNumber(): string
    {
        return $this->senderBuildingNumber;
    }

    public function setSenderBuildingNumber(string $senderBuildingNumber): void
    {
        $this->senderBuildingNumber = $senderBuildingNumber;
    }
}
