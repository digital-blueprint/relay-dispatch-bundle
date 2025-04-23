<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Entity;

date_default_timezone_set('UTC');

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\OpenApi\Model\Operation;
use ApiPlatform\OpenApi\Model\RequestBody;
use ApiPlatform\OpenApi\Model\Response;
use Dbp\Relay\DispatchBundle\Helpers\Tools;
use Dbp\Relay\DispatchBundle\Rest\CreateRequestFileAction;
use Dbp\Relay\DispatchBundle\Rest\RequestFileProcessor;
use Dbp\Relay\DispatchBundle\Rest\RequestFileProvider;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    shortName: 'DispatchRequestFile',
    types: ['https://schema.org/DigitalDocument'],
    operations: [
        new Get(
            uriTemplate: '/dispatch/request-files/{identifier}',
            openapi: new Operation(
                tags: ['Dispatch']
            ),
            security: "is_granted('IS_AUTHENTICATED_FULLY')",
            provider: RequestFileProvider::class
        ),
        new Delete(
            uriTemplate: '/dispatch/request-files/{identifier}',
            openapi: new Operation(
                tags: ['Dispatch']
            ),
            security: "is_granted('IS_AUTHENTICATED_FULLY')",
            provider: RequestFileProvider::class,
            processor: RequestFileProcessor::class
        ),
        new Post(
            uriTemplate: '/dispatch/request-files',
            inputFormats: [
                'multipart' => 'multipart/form-data',
            ],
            controller: CreateRequestFileAction::class,
            openapi: new Operation(
                tags: ['Dispatch'],
                responses: [
                    415 => new Response(description: 'Unsupported Media Type - Only PDF files can be added!'),
                ],
                requestBody: new RequestBody(
                    content: new \ArrayObject([
                        'multipart/form-data' => [
                            'schema' => [
                                'type' => 'object',
                                'required' => ['file', 'dispatchRequestIdentifier'],
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
                                ],
                            ],
                        ],
                    ])
                )
            ),
            security: "is_granted('IS_AUTHENTICATED_FULLY')",
            deserialize: false
        ),
    ],
    normalizationContext: [
        'groups' => ['DispatchRequestFile:output', 'DispatchRequest:output'],
    ],
    denormalizationContext: [
        'groups' => ['DispatchRequestFile:input'],
    ]
)]
#[ORM\Table(name: 'dispatch_request_files')]
#[ORM\Entity]
class RequestFile
{
    #[ApiProperty(identifier: true)]
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 50)]
    #[Groups(['DispatchRequestFile:output', 'DispatchRequest:output'])]
    private ?string $identifier = null;

    #[ApiProperty(iris: ['https://schema.org/dateCreated'])]
    #[ORM\Column(type: 'datetime_immutable')]
    #[Groups(['DispatchRequestFile:output', 'DispatchRequest:output'])]
    private ?\DateTimeInterface $dateCreated = null;

    #[ApiProperty]
    #[ORM\JoinColumn(name: 'dispatch_request_identifier', referencedColumnName: 'identifier')]
    #[ORM\ManyToOne(targetEntity: Request::class, inversedBy: 'files')]
    #[Groups(['DispatchRequestFile:output'])]
    private ?Request $request = null;

    #[ApiProperty(iris: ['https://schema.org/identifier'])]
    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    #[Groups(['DispatchRequestFile:output', 'DispatchRequestFile:input'])]
    private ?string $dispatchRequestIdentifier = null;

    #[ApiProperty(iris: ['https://schema.org/name'])]
    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['DispatchRequestFile:output', 'DispatchRequestFile:input', 'DispatchRequest:output'])]
    private ?string $name = null;

    #[ApiProperty(iris: ['http://schema.org/contentUrl'])]
    #[Groups(['DispatchRequestFile:output'])]
    private ?string $contentUrl = null;

    #[ORM\Column(type: 'binary', length: 209715200)]
    private mixed $data = null;

    #[ApiProperty(iris: ['https://schema.org/fileFormat'])]
    #[ORM\Column(type: 'string', length: 100)]
    #[Groups(['DispatchRequestFile:output', 'DispatchRequest:output'])]
    private ?string $fileFormat = null;

    #[ApiProperty(iris: ['https://schema.org/contentSize'])]
    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['DispatchRequestFile:output', 'DispatchRequest:output'])]
    private ?int $contentSize = 0;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private ?string $fileStorageSystem = DispatchService::FILE_STORAGE_DATABASE;

    #[ORM\Column(type: 'string', length: 1000, nullable: true)]
    private ?string $fileStorageIdentifier = null;

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

    public function setDateCreated(\DateTimeInterface $dateCreated): void
    {
        $this->dateCreated = \DateTimeImmutable::createFromInterface($dateCreated);
    }

    public function getDispatchRequest(): ?Request
    {
        return $this->request;
    }

    public function getDispatchRequestIdentifier(): ?string
    {
        return $this->dispatchRequestIdentifier;
    }

    public function setDispatchRequestIdentifier(string $dispatchRequestIdentifier): void
    {
        $this->dispatchRequestIdentifier = $dispatchRequestIdentifier;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return resource|string|int|false|null
     *
     * @throws \Exception
     */
    public function getData(): mixed
    {
        // If the file is stored in the blob storage system, the contentUrl should already be set at that time
        if ($this->fileStorageSystem === 'blob') {
            if ($this->contentUrl === '') {
                return null;
            }

            return Tools::dataUriToBinary($this->contentUrl);
        }

        if (is_resource($this->data)) {
            rewind($this->data);
            $this->data = stream_get_contents($this->data);

            return $this->data;
        }

        return $this->data;
    }

    /**
     * @param $data resource|string
     */
    public function setData(mixed $data): void
    {
        $this->contentUrl = '';
        $this->data = $data;
    }

    public function getContentSize(): ?int
    {
        return $this->contentSize;
    }

    public function setContentSize(?int $contentSize): void
    {
        $this->contentSize = $contentSize;
    }

    public function getContentUrl(): string
    {
        if ($this->fileStorageSystem !== 'blob' && !$this->contentUrl) {
            $this->contentUrl = Tools::getDataURI($this->getData(), $this->fileFormat);
        }

        return $this->contentUrl;
    }

    public function setContentUrl(string $contentUrl): void
    {
        $this->contentUrl = $contentUrl;
    }

    public function getFileFormat(): ?string
    {
        return $this->fileFormat;
    }

    public function setFileFormat(string $fileFormat): void
    {
        $this->fileFormat = $fileFormat;
    }

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function getFileStorageSystem(): string
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
}
