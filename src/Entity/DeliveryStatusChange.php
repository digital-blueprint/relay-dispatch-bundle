<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Entity;

date_default_timezone_set('UTC');

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Dbp\Relay\DispatchBundle\Helpers\Tools;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="dispatch_delivery_status_changes")
 * @ApiResource(
 *     collectionOperations={
 *         "get" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY')",
 *             "path" = "/dispatch/request-status-changes",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"}
 *             },
 *         }
 *     },
 *     itemOperations={
 *         "get" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY')",
 *             "path" = "/dispatch/request-status-changes/{identifier}",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"}
 *             },
 *         },
 *     },
 *     iri="https://schema.org/Status",
 *     shortName="DispatchDeliveryStatusChange",
 *     normalizationContext={
 *         "groups" = {"DispatchDeliveryStatusChange:output"},
 *         "jsonld_embed_context" = true
 *     }
 * )
 */
class DeliveryStatusChange
{
    public const STATUS_SUBMITTED = 1;
    public const STATUS_IN_PROGRESS = 2;
    public const STATUS_SOAP_ERROR = 3;
    public const STATUS_DUAL_DELIVERY_REQUEST_FAILED = 4;
    public const STATUS_DUAL_DELIVERY_REQUEST_SUCCESS = 5;
    public const STATUS_STATUS_REQUEST_FAILED = 10;
    // TODO: Those seem very Vendo-specific
    public const STATUS_DUAL_DELIVERY_APPLICATION_ID_NOT_FOUND = 20;
    public const STATUS_DUAL_DELIVERY_STATUS_P1 = 21;
    public const STATUS_DUAL_DELIVERY_STATUS_P2 = 22;
    public const STATUS_DUAL_DELIVERY_STATUS_P3 = 23;
    public const STATUS_DUAL_DELIVERY_STATUS_P4 = 24;
    public const STATUS_DUAL_DELIVERY_STATUS_P5 = 25;
    public const STATUS_DUAL_DELIVERY_STATUS_P6 = 26;
    public const STATUS_DUAL_DELIVERY_STATUS_P7 = 27;
    public const STATUS_DUAL_DELIVERY_STATUS_P8 = 28;
    public const STATUS_DUAL_DELIVERY_STATUS_P9 = 29;
    public const STATUS_DUAL_DELIVERY_STATUS_P10 = 30;
    public const STATUS_DUAL_DELIVERY_STATUS_P11 = 31;
    public const STATUS_DUAL_DELIVERY_STATUS_P12 = 32;

    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=50)
     * @ApiProperty(identifier=true)
     * @Groups({"DispatchDeliveryStatusChange:output", "DispatchRequestRecipient:output", "DispatchRequest:output"})
     */
    private $identifier;

    /**
     * @ORM\Column(type="datetime")
     * @ApiProperty(iri="https://schema.org/dateCreated")
     * @Groups({"DispatchDeliveryStatusChange:output", "DispatchRequestRecipient:output", "DispatchRequest:output"})
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
     * @Groups({"DispatchDeliveryStatusChange:output", "DispatchRequestRecipient:output", "DispatchRequest:output"})
     *
     * @var int
     */
    private $statusType;

    /**
     * @ORM\Column(type="text")
     * @ApiProperty(iri="https://schema.org/description")
     * @Groups({"DispatchDeliveryStatusChange:output", "DispatchRequestRecipient:output", "DispatchRequest:output"})
     *
     * @var string
     */
    private $description;

    /**
     * @ORM\Column(type="binary", length=209715200)
     *
     * @var resource|string|int|false
     */
    private $fileData;

    /**
     * @ApiProperty(iri="https://schema.org/fileFormat")
     * @ORM\Column(type="string", length=100)
     * @Groups({"DispatchDeliveryStatusChange:output", "DispatchRequestRecipient:output"})
     *
     * @var string
     */
    private $fileFormat;

    /**
     * @ApiProperty(iri="http://schema.org/contentUrl")
     * @Groups({"DispatchDeliveryStatusChange:output"})
     *
     * @var string
     */
    private $fileContentUrl;

    /**
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $orderId;

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

    public function getFileContentUrl(): string
    {
        return Tools::getDataURI($this->getFileData(), $this->fileFormat);
    }

    public function getFileFormat(): string
    {
        return $this->fileFormat;
    }

    public function setFileFormat(string $fileFormat): void
    {
        $this->fileFormat = $fileFormat;
    }

    /**
     * @return resource|string|int|false
     */
    public function getFileData()
    {
        if (is_resource($this->fileData)) {
            rewind($this->fileData);
            $this->fileData = stream_get_contents($this->fileData);

            return $this->fileData;
        }

        return $this->fileData;
    }

    /**
     * @param $data resource|string
     */
    public function setFileData($data): void
    {
        $this->fileData = $data;
    }

    /**
     * Checks if a dual delivery status is final.
     * TODO: Those seem very Vendo-specific.
     */
    public function isFinalDualDeliveryStatus(): bool
    {
        return in_array($this->statusType, [
            self::STATUS_DUAL_DELIVERY_REQUEST_FAILED,
            self::STATUS_DUAL_DELIVERY_APPLICATION_ID_NOT_FOUND,
            self::STATUS_DUAL_DELIVERY_STATUS_P5,
            self::STATUS_DUAL_DELIVERY_STATUS_P6,
            self::STATUS_DUAL_DELIVERY_STATUS_P9,
            self::STATUS_DUAL_DELIVERY_STATUS_P10,
            self::STATUS_DUAL_DELIVERY_STATUS_P12,
        ], true);
    }
}
