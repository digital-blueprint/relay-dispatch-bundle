<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="dispatch_requests")
 * @ApiResource(
 *     collectionOperations={
 *         "post" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY')",
 *             "path" = "/dispatch/requests",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"},
 *                 "requestBody" = {
 *                     "content" = {
 *                         "application/json" = {
 *                             "schema" = {"type" = "object"},
 *                             "example" = {"senderGivenName" = "Max", "senderFamilyName" = "Mustermann", "senderPostalAddress" = "Am Grund 1"},
 *                         }
 *                     }
 *                 },
 *             }
 *         },
 *         "get" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY')",
 *             "path" = "/dispatch/requests",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"}
 *             },
 *         }
 *     },
 *     itemOperations={
 *         "get" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY')",
 *             "path" = "/dispatch/requests/{identifier}",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"}
 *             },
 *         },
 *         "delete" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY')",
 *             "path" = "/dispatch/requests/{identifier}",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"}
 *             },
 *         }
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
     * @ORM\Column(type="string", length=255)
     * @ApiProperty(iri="https://schema.org/address")
     * @Groups({"DispatchRequest:output", "DispatchRequest:input"})
     *
     * @var string
     */
    private $senderPostalAddress;

    /**
     * @ORM\OneToMany(targetEntity="RequestRecipient", mappedBy="request")
     * @Groups({"DispatchRequest:output"})
     */
    private $recipients;

    public function __construct() {
        $this->recipients = new ArrayCollection();
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

    public function getSenderPostalAddress(): ?string
    {
        return $this->senderPostalAddress;
    }

    public function setSenderPostalAddress(string $senderPostalAddress): void
    {
        $this->senderPostalAddress = $senderPostalAddress;
    }

    /**
     * @return RequestRecipient[]
     */
    public function getRecipients()
    {
        return $this->recipients;
    }
}
