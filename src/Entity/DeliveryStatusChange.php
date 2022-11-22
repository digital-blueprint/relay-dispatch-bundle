<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Entity;

date_default_timezone_set('UTC');

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="dispatch_delivery_status_changes")
 * @ApiResource(
 *     collectionOperations={
 *         "get" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY') and is_granted('ROLE_SCOPE_DISPATCH')",
 *             "path" = "/dispatch/request-status-changes",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"}
 *             },
 *         }
 *     },
 *     itemOperations={
 *         "get" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY') and is_granted('ROLE_SCOPE_DISPATCH')",
 *             "path" = "/dispatch/request-status-changes/{identifier}",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"}
 *             },
 *         },
 *     },
 *     iri="https://schema.org/Status",
 *     shortName="DispatchDeliveryStatusChange",
 *     normalizationContext={
 *         "groups" = {"DispatchDeliveryStatusChange:output", "DispatchRequest:output"},
 *         "jsonld_embed_context" = true
 *     }
 * )
 */
class DeliveryStatusChange
{
    // TODO: Get status values from "Statuswerte" xlsx file
    public const STATUS_SUBMITTED = 1;
    public const STATUS_IN_PROGRESS = 2;
    public const STATUS_SOAP_ERROR = 3;
    public const STATUS_DUAL_DELIVERY_REQUEST_FAILED = 4;
    public const STATUS_DUAL_DELIVERY_REQUEST_SUCCESS = 5;

    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=50)
     * @ApiProperty(identifier=true)
     * @Groups({"DispatchDeliveryStatusChange:output", "DispatchRequest:output"})
     */
    private $identifier;

    /**
     * @ORM\Column(type="datetime")
     * @ApiProperty(iri="https://schema.org/dateCreated")
     * @Groups({"DispatchDeliveryStatusChange:output", "DispatchRequest:output"})
     *
     * @var \DateTimeInterface
     */
    private $dateCreated;

    /**
     * @ORM\ManyToOne(targetEntity="RequestRecipient", inversedBy="statusChanges")
     * @ORM\JoinColumn(name="dispatch_request_recipient_identifier", referencedColumnName="identifier")
     * @ApiProperty
     * @Groups({"DispatchDeliveryStatusChange:output"})
     *
     * @var RequestRecipient
     */
    private $requestRecipient;

    /**
     * @ORM\Column(type="string", length=50)
     * @ApiProperty(iri="https://schema.org/identifier")
     * @Groups({"DispatchDeliveryStatusChange:output"})
     *
     * @var string
     */
    private $dispatchRequestRecipientIdentifier;

    /**
     * @ORM\Column(type="integer")
     * @ApiProperty(iri="https://schema.org/statusType")
     * @Groups({"DispatchDeliveryStatusChange:output", "DispatchRequest:output"})
     *
     * @var int
     */
    private $statusType;

    /**
     * @ORM\Column(type="text")
     * @ApiProperty(iri="https://schema.org/description")
     * @Groups({"DispatchDeliveryStatusChange:output", "DispatchRequest:output"})
     *
     * @var string
     */
    private $description;

    public function getIdentifier(): string
    {
        return (string) $this->identifier;
    }

    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getDateCreated(): \DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): void
    {
        $this->dateCreated = $dateCreated;
    }

    public function getDispatchRequestRecipient(): RequestRecipient
    {
        return $this->requestRecipient;
    }

    public function getDispatchRequestRecipientIdentifier(): string
    {
        return $this->dispatchRequestRecipientIdentifier;
    }

    public function setDispatchRequestRecipientIdentifier(string $dispatchRequestRecipientIdentifier): void
    {
        $this->dispatchRequestRecipientIdentifier = $dispatchRequestRecipientIdentifier;
    }

    public function getStatusType(): int
    {
        return $this->statusType;
    }

    public function setStatusType(int $statusType): void
    {
        $this->statusType = $statusType;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setRequestRecipient(RequestRecipient $requestRecipient): void
    {
        $this->requestRecipient = $requestRecipient;
    }
}
