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
use ApiPlatform\OpenApi\Model\Response;
use Dbp\Relay\DispatchBundle\DualDeliveryProvider\Vendo\Vendo;
use Dbp\Relay\DispatchBundle\Helpers\Tools;
use Dbp\Relay\DispatchBundle\Rest\DeliveryStatusChangeProcessor;
use Dbp\Relay\DispatchBundle\Rest\DeliveryStatusChangeProvider;
use Dbp\Relay\DispatchBundle\Rest\UpdateDeliveryStatusChangeFileAction;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ApiResource(
    shortName: 'DispatchDeliveryStatusChange',
    types: ['https://schema.org/Status'],
    operations: [
        new Get(
            uriTemplate: '/dispatch/request-status-changes/{identifier}',
            openapi: new Operation(
                tags: ['Dispatch']
            ),
            security: "is_granted('IS_AUTHENTICATED_FULLY')",
            provider: DeliveryStatusChangeProvider::class
        ),
        new GetCollection(
            uriTemplate: '/dispatch/request-status-changes',
            openapi: new Operation(
                tags: ['Dispatch']
            ),
            security: "is_granted('IS_AUTHENTICATED_FULLY')",
            provider: DeliveryStatusChangeProvider::class
        ),
        new Delete(
            uriTemplate: '/dispatch/request-status-changes/{identifier}/file',
            openapi: new Operation(
                tags: ['Dispatch'],
                summary: 'Removes the DispatchDeliveryStatusChange file resource.'
            ),
            security: "is_granted('IS_AUTHENTICATED_FULLY')",
            provider: DeliveryStatusChangeProvider::class,
            processor: DeliveryStatusChangeProcessor::class
        ),
        new Post(
            uriTemplate: '/dispatch/request-status-changes/{identifier}/file',
            inputFormats: [
                'multipart' => 'multipart/form-data',
            ],
            controller: UpdateDeliveryStatusChangeFileAction::class,
            openapi: new Operation(
                tags: ['Dispatch'],
                responses: [
                    415 => new Response(description: 'Unsupported Media Type - Only PDF files can be added!'),
                ],
                summary: 'Updates the DispatchDeliveryStatusChange file resource.',
                requestBody: new RequestBody(
                    content: new \ArrayObject([
                        'multipart/form-data' => [
                            'schema' => [
                                'type' => 'object',
                                'required' => ['file', 'dispatchRequestIdentifier', 'fileUploaderIdentifier'],
                                'properties' => [
                                    'dispatchRequestIdentifier' => [
                                        'description' => 'ID of the request',
                                        'type' => 'string',
                                        'example' => '4d553985-d44f-404f-acf3-cd0eac7ae9c2',
                                    ],
                                    'file' => [
                                        'type' => 'string',
                                        'format' => 'binary',
                                    ],
                                    'fileUploaderIdentifier' => [
                                        'description' => 'User ID of the file uploader',
                                        'type' => 'string',
                                        'example' => 'F957F2400C941B72',
                                    ],
                                ],
                            ],
                        ],
                    ])
                )
            ),
            security: "is_granted('IS_AUTHENTICATED_FULLY')",
            deserialize: false,
            provider: DeliveryStatusChangeProvider::class
        ),
    ],
    normalizationContext: [
        'groups' => ['DispatchDeliveryStatusChange:output'],
    ]
)]
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

    #[ApiProperty(identifier: true)]
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 50)]
    #[Groups(['DispatchDeliveryStatusChange:output', 'DispatchRequestRecipient:output', 'DispatchRequest:output'])]
    private ?string $identifier = null;

    #[ApiProperty(iris: ['https://schema.org/dateCreated'])]
    #[ORM\Column(type: 'datetime_immutable')]
    #[Groups(['DispatchDeliveryStatusChange:output', 'DispatchRequestRecipient:output', 'DispatchRequest:output'])]
    private ?\DateTimeInterface $dateCreated = null;

    #[ApiProperty]
    #[ORM\JoinColumn(name: 'dispatch_request_recipient_identifier', referencedColumnName: 'identifier')]
    #[ORM\ManyToOne(targetEntity: RequestRecipient::class, inversedBy: 'statusChanges')]
    #[Groups(['DispatchDeliveryStatusChange:output'])]
    private ?RequestRecipient $requestRecipient = null;

    #[ApiProperty(iris: ['https://schema.org/identifier'])]
    #[ORM\Column(type: 'string', length: 50)]
    #[Groups(['DispatchDeliveryStatusChange:output'])]
    private ?string $dispatchRequestRecipientIdentifier = null;

    #[ApiProperty(iris: ['https://schema.org/statusType'])]
    #[ORM\Column(type: 'integer')]
    #[Groups(['DispatchDeliveryStatusChange:output', 'DispatchRequestRecipient:output', 'DispatchRequest:output'])]
    private ?int $statusType = null;

    #[ApiProperty(iris: ['https://schema.org/description'])]
    #[ORM\Column(type: 'text')]
    #[Groups(['DispatchDeliveryStatusChange:output', 'DispatchRequestRecipient:output', 'DispatchRequest:output'])]
    private ?string $description = null;

    /**
     * @var resource|string|int|false
     */
    #[ORM\Column(type: 'binary', length: 209715200, nullable: true)]
    private mixed $fileData;

    #[ApiProperty(iris: ['https://schema.org/fileFormat'])]
    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    #[Groups(['DispatchDeliveryStatusChange:output', 'DispatchRequestRecipient:output'])]
    private ?string $fileFormat = null;

    #[ApiProperty(iris: ['http://schema.org/contentUrl'])]
    #[Groups(['DispatchDeliveryStatusChange:output'])]
    private ?string $fileContentUrl = null;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private ?string $fileStorageSystem = DispatchService::FILE_STORAGE_DATABASE;

    #[ORM\Column(type: 'string', length: 1000, nullable: true)]
    private ?string $fileStorageIdentifier = null;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    #[Groups(['DispatchDeliveryStatusChange:output', 'DispatchRequestRecipient:output'])]
    private ?\DateTimeInterface $fileDateAdded = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    #[Groups(['DispatchDeliveryStatusChange:output', 'DispatchRequestRecipient:output'])]
    private ?string $fileUploaderIdentifier = null;

    #[ORM\Column(type: 'boolean', nullable: true)]
    #[Groups(['DispatchDeliveryStatusChange:output', 'DispatchRequestRecipient:output'])]
    private ?bool $fileIsUploadedManually = null;

    #[ORM\Column(type: 'integer')]
    private ?int $orderId = 0;

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

    public function setDateCreated(?\DateTimeInterface $dateCreated): void
    {
        $this->dateCreated = \DateTimeImmutable::createFromInterface($dateCreated);
    }

    public function getDispatchRequestRecipient(): ?RequestRecipient
    {
        return $this->requestRecipient;
    }

    public function getDispatchRequestRecipientIdentifier(): ?string
    {
        return $this->dispatchRequestRecipientIdentifier;
    }

    public function setDispatchRequestRecipientIdentifier(string $dispatchRequestRecipientIdentifier): void
    {
        $this->dispatchRequestRecipientIdentifier = $dispatchRequestRecipientIdentifier;
    }

    public function getStatusType(): ?int
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
        if ($this->fileStorageSystem !== 'blob' && !$this->fileContentUrl) {
            $this->fileContentUrl = Tools::getDataURI($this->getFileData(), $this->fileFormat);
        }

        return $this->fileContentUrl;
    }

    public function setFileContentUrl(string $contentUrl): void
    {
        $this->fileContentUrl = $contentUrl;
    }

    public function getFileFormat(): ?string
    {
        return $this->fileFormat;
    }

    public function setFileFormat(string $fileFormat): void
    {
        $this->fileFormat = $fileFormat;
    }

    /**
     * @return resource|string|int|false|null
     *
     * @throws \Exception
     */
    public function getFileData(): mixed
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
    public function setFileData(mixed $data): void
    {
        $this->fileContentUrl = '';
        $this->fileData = $data;
    }

    public function getFileStorageSystem(): ?string
    {
        return $this->fileStorageSystem;
    }

    public function setFileStorageSystem(?string $fileStorageSystem): void
    {
        $this->fileStorageSystem = $fileStorageSystem;
    }

    public function getFileStorageIdentifier(): ?string
    {
        return $this->fileStorageIdentifier;
    }

    public function setFileStorageIdentifier(?string $fileStorageIdentifier): void
    {
        $this->fileStorageIdentifier = $fileStorageIdentifier;
    }

    public function getFileDateAdded(): ?\DateTimeInterface
    {
        return $this->fileDateAdded;
    }

    public function setFileDateAdded(?\DateTimeInterface $fileDateAdded): void
    {
        $this->fileDateAdded = $fileDateAdded !== null ? \DateTimeImmutable::createFromInterface($fileDateAdded) : null;
    }

    public function getFileUploaderIdentifier(): ?string
    {
        return $this->fileUploaderIdentifier;
    }

    public function setFileUploaderIdentifier(?string $fileUploaderIdentifier): void
    {
        $this->fileUploaderIdentifier = $fileUploaderIdentifier;
    }

    public function getFileIsUploadedManually(): ?bool
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
        return $this->statusType === self::STATUS_DUAL_DELIVERY_REQUEST_FAILED
            || Vendo::isFinalStatus($this->statusType);
    }

    /**
     * Checks if a dual delivery status is final.
     */
    public function isInReceiptUploadAllowedStatus(): bool
    {
        return Vendo::isSuccessStatus($this->statusType);
    }

    #[ApiProperty(iris: ['https://schema.org/statusType'])]
    #[SerializedName('dispatchStatus')]
    #[Groups(['DispatchDeliveryStatusChange:output', 'DispatchRequestRecipient:output', 'DispatchRequest:output'])]
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
