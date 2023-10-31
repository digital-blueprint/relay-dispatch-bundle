<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Entity;

date_default_timezone_set('UTC');

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Dbp\Relay\DispatchBundle\DualDeliveryProvider\Vendo\Vendo;
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
 *         "groups" = {"DispatchDeliveryStatusChange:output"}
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
     * @ApiProperty(iri="https://schema.org/statusType")
     * @Groups({"DispatchDeliveryStatusChange:output", "DispatchRequestRecipient:output", "DispatchRequest:output"})
     *
     * @var string
     */
    private $dispatchStatus;

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
     * @ORM\Column(type="string", length=100)
     *
     * @var string
     */
    private $fileStorageSystem;

    /**
     * @ORM\Column(type="string", length=1000)
     *
     * @var string
     */
    private $fileStorageIdentifier;

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
        if ($this->fileStorageSystem !== 'blob' && !$this->isFileContentUrlSet()) {
            $this->fileContentUrl = Tools::getDataURI($this->getFileData(), $this->fileFormat);
        }

        return $this->fileContentUrl;
    }

    public function isFileContentUrlSet(): bool
    {
        return $this->fileContentUrl !== '' && $this->fileContentUrl !== null;
    }

    public function setFileContentUrl(string $contentUrl): void
    {
        $this->fileContentUrl = $contentUrl;
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
     * @return resource|string|int|false|null
     */
    public function getFileData()
    {
        // If the file is stored in the blob storage system, the contentUrl should already be set at that time
        if ($this->fileStorageSystem === 'blob') {
            if ($this->fileContentUrl === '') {
                return null;
            }

            return Tools::dataUriToBinary($this->fileContentUrl);
        }

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
        $this->fileContentUrl = '';
        $this->fileData = $data;
    }

    public function getFileStorageSystem(): string
    {
        return $this->fileStorageSystem;
    }

    public function setFileStorageSystem(string $fileStorageSystem): void
    {
        $this->fileStorageSystem = $fileStorageSystem;
    }

    public function getFileStorageIdentifier(): string
    {
        return $this->fileStorageIdentifier;
    }

    public function setFileStorageIdentifier(string $fileStorageIdentifier): void
    {
        $this->fileStorageIdentifier = $fileStorageIdentifier;
    }

    /**
     * Checks if a dual delivery status is final.
     */
    public function isFinalDualDeliveryStatus(): bool
    {
        return in_array($this->statusType, [
            self::STATUS_DUAL_DELIVERY_REQUEST_FAILED, ], true) ||
            Vendo::isFinalStatus($this->statusType);
    }

    public function getDispatchStatus(): string
    {
        if (in_array($this->statusType, [
            self::STATUS_SOAP_ERROR,
            self::STATUS_DUAL_DELIVERY_REQUEST_FAILED,
            self::STATUS_STATUS_REQUEST_FAILED,
        ], true) || Vendo::isFailureStatus($this->statusType)) {
            return 'failure';
        }

        if (Vendo::isSuccessStatus($this->statusType)) {
            return 'success';
        }

        if (in_array($this->statusType, [
            self::STATUS_SUBMITTED,
            self::STATUS_IN_PROGRESS,
            self::STATUS_DUAL_DELIVERY_REQUEST_SUCCESS,
        ], true) || Vendo::isPendingStatus($this->statusType)) {
            return 'pending';
        }

        return 'unknown';
    }
}
