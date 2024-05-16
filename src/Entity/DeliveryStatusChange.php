<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Entity;

date_default_timezone_set('UTC');

use Dbp\Relay\DispatchBundle\DualDeliveryProvider\Vendo\Vendo;
use Dbp\Relay\DispatchBundle\Helpers\Tools;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Table(name: 'dispatch_delivery_status_changes')]
#[ORM\Entity]
class DeliveryStatusChange
{
    public const STATUS_SUBMITTED = 1;
    public const STATUS_IN_PROGRESS = 2;
    public const STATUS_SOAP_ERROR = 3;
    public const STATUS_DUAL_DELIVERY_REQUEST_FAILED = 4;
    public const STATUS_DUAL_DELIVERY_REQUEST_SUCCESS = 5;
    public const STATUS_STATUS_REQUEST_FAILED = 10;

    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 50)]
    #[Groups(['DispatchDeliveryStatusChange:output', 'DispatchRequestRecipient:output', 'DispatchRequest:output'])]
    private $identifier;

    /**
     * @var \DateTimeInterface
     */
    #[ORM\Column(type: 'datetime')]
    #[Groups(['DispatchDeliveryStatusChange:output', 'DispatchRequestRecipient:output', 'DispatchRequest:output'])]
    private $dateCreated;

    /**
     * @var RequestRecipient
     */
    #[ORM\JoinColumn(name: 'dispatch_request_recipient_identifier', referencedColumnName: 'identifier')]
    #[ORM\ManyToOne(targetEntity: RequestRecipient::class, inversedBy: 'statusChanges')]
    #[Groups(['DispatchDeliveryStatusChange:output'])]
    private $requestRecipient;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', length: 50)]
    #[Groups(['DispatchDeliveryStatusChange:output'])]
    private $dispatchRequestRecipientIdentifier;

    /**
     * @var int
     */
    #[ORM\Column(type: 'integer')]
    #[Groups(['DispatchDeliveryStatusChange:output', 'DispatchRequestRecipient:output', 'DispatchRequest:output'])]
    private $statusType;

    /**
     * @var string
     */
    #[Groups(['DispatchDeliveryStatusChange:output', 'DispatchRequestRecipient:output', 'DispatchRequest:output'])]
    private $dispatchStatus;

    /**
     * @var string
     */
    #[ORM\Column(type: 'text')]
    #[Groups(['DispatchDeliveryStatusChange:output', 'DispatchRequestRecipient:output', 'DispatchRequest:output'])]
    private $description;

    /**
     * @var resource|string|int|false
     */
    #[ORM\Column(type: 'binary', length: 209715200)]
    private $fileData;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', length: 100)]
    #[Groups(['DispatchDeliveryStatusChange:output', 'DispatchRequestRecipient:output'])]
    private $fileFormat;

    /**
     * @var string
     */
    #[Groups(['DispatchDeliveryStatusChange:output'])]
    private $fileContentUrl;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', length: 100)]
    private $fileStorageSystem;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', length: 1000)]
    private $fileStorageIdentifier;

    /**
     * @var \DateTimeInterface|null
     */
    #[ORM\Column(type: 'datetime', nullable: true)]
    #[Groups(['DispatchDeliveryStatusChange:output', 'DispatchRequestRecipient:output'])]
    private $fileDateAdded;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', length: 50)]
    #[Groups(['DispatchDeliveryStatusChange:output', 'DispatchRequestRecipient:output'])]
    private $fileUploaderIdentifier;

    /**
     * @var bool
     */
    #[ORM\Column(type: 'boolean')]
    #[Groups(['DispatchDeliveryStatusChange:output', 'DispatchRequestRecipient:output'])]
    private $fileIsUploadedManually;

    /**
     * @var int
     */
    #[ORM\Column(type: 'integer')]
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

    public function getFileStorageSystem(): ?string
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

    public function getFileDateAdded(): \DateTimeInterface
    {
        return $this->fileDateAdded;
    }

    public function setFileDateAdded(?\DateTimeInterface $fileDateAdded): void
    {
        $this->fileDateAdded = $fileDateAdded;
    }

    public function getFileUploaderIdentifier(): string
    {
        return $this->fileUploaderIdentifier;
    }

    public function setFileUploaderIdentifier(?string $fileUploaderIdentifier): void
    {
        $this->fileUploaderIdentifier = $fileUploaderIdentifier;
    }

    public function getFileIsUploadedManually(): bool
    {
        return $this->fileIsUploadedManually;
    }

    public function setFileIsUploadedManually(?bool $fileIsUploadedManually = null): void
    {
        $this->fileIsUploadedManually = $fileIsUploadedManually;
    }

    /**
     * Checks if a dual delivery status is final.
     */
    public function isFinalDualDeliveryStatus(): bool
    {
        return in_array($this->statusType, [
            self::STATUS_DUAL_DELIVERY_REQUEST_FAILED, ], true)
            || Vendo::isFinalStatus($this->statusType);
    }

    /**
     * Checks if a dual delivery status is final.
     */
    public function isInReceiptUploadAllowedStatus(): bool
    {
        return Vendo::isSuccessStatus($this->statusType);
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
