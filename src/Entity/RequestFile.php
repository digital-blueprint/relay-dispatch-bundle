<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Entity;

date_default_timezone_set('UTC');

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Dbp\Relay\DispatchBundle\Controller\CreateRequestFileAction;
use Dbp\Relay\DispatchBundle\Helpers\Tools;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="dispatch_request_files")
 * @ApiResource(
 *     collectionOperations={
 *         "post" = {
 *             "method" = "POST",
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY') and is_granted('ROLE_SCOPE_DISPATCH')",
 *             "path" = "/dispatch/request-files",
 *             "controller" = CreateRequestFileAction::class,
 *             "deserialize" = false,
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"},
 *                 "requestBody" = {
 *                     "content" = {
 *                         "multipart/form-data" = {
 *                             "schema" = {
 *                                 "type" = "object",
 *                                 "properties" = {
 *                                     "dispatchRequestIdentifier" = {"description" = "ID of the request", "type" = "string", "example" = "4d553985-d44f-404f-acf3-cd0eac7ae9c2"},
 *                                     "file" = {"type" = "string", "format" = "binary"}
 *                                 },
 *                                 "required" = {"file", "dispatchRequestIdentifier"},
 *                             }
 *                         }
 *                     }
 *                 },
 *                 "responses" = {
 *                     "415" = {
 *                         "description" = "Unsupported Media Type - Only PDF files can be added!",
 *                         "content" = {}
 *                     }
 *                 }
 *             }
 *         },
 *         "get" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY') and is_granted('ROLE_SCOPE_DISPATCH')",
 *             "path" = "/dispatch/request-files",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"}
 *             },
 *         }
 *     },
 *     itemOperations={
 *         "get" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY') and is_granted('ROLE_SCOPE_DISPATCH')",
 *             "path" = "/dispatch/request-files/{identifier}",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"}
 *             },
 *         },
 *         "delete" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY') and is_granted('ROLE_SCOPE_DISPATCH')",
 *             "path" = "/dispatch/request-files/{identifier}",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"}
 *             },
 *         }
 *     },
 *     iri="https://schema.org/DigitalDocument",
 *     shortName="DispatchRequestFile",
 *     normalizationContext={
 *         "groups" = {"DispatchRequestFile:output", "DispatchRequest:output"},
 *         "jsonld_embed_context" = true
 *     },
 *     denormalizationContext={
 *         "groups" = {"DispatchRequestFile:input"},
 *         "jsonld_embed_context" = true
 *     }
 * )
 */
class RequestFile
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=50)
     * @ApiProperty(identifier=true)
     * @Groups({"DispatchRequestFile:output", "DispatchRequest:output"})
     */
    private $identifier;

    /**
     * @ORM\Column(type="datetime")
     * @ApiProperty(iri="https://schema.org/dateCreated")
     * @Groups({"DispatchRequestFile:output", "DispatchRequest:output"})
     *
     * @var \DateTimeInterface
     */
    private $dateCreated;

    /**
     * @ORM\ManyToOne(targetEntity="Request", inversedBy="files")
     * @ORM\JoinColumn(name="dispatch_request_identifier", referencedColumnName="identifier")
     * @ApiProperty
     * @Groups({"DispatchRequestFile:output"})
     *
     * @var Request
     */
    private $request;

    /**
     * @ORM\Column(type="string", length=50)
     * @ApiProperty(iri="https://schema.org/identifier")
     * @Groups({"DispatchRequestFile:output", "DispatchRequestFile:input"})
     *
     * @var string
     */
    private $dispatchRequestIdentifier;

    /**
     * @ORM\Column(type="string", length=255)
     * @ApiProperty(iri="https://schema.org/name")
     * @Groups({"DispatchRequestFile:output", "DispatchRequestFile:input", "DispatchRequest:output"})
     *
     * @var string
     */
    private $name;

    /**
     * @ApiProperty(iri="http://schema.org/contentUrl")
     * @Groups({"DispatchRequestFile:output", "DispatchRequest:output"})
     *
     * @var string
     */
    private $contentUrl;

    /**
     * @ORM\Column(type="binary", length=209715200)
     *
     * @var resource
     */
    private $data;

    /**
     * @ApiProperty(iri="https://schema.org/fileFormat")
     * @ORM\Column(type="string", length=100)
     * @Groups({"DispatchRequestFile:output", "DispatchRequest:output"})
     *
     * @var string
     */
    private $fileFormat;

    /**
     * @ORM\Column(type="integer")
     * @ApiProperty(iri="https://schema.org/contentSize")
     * @Groups({"DispatchRequestFile:output", "DispatchRequest:output"})
     *
     * @var int
     */
    private $contentSize;

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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return resource|string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param $data resource|string
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    public function getContentSize(): int
    {
        return $this->contentSize;
    }

    public function setContentSize(int $contentSize): void
    {
        $this->contentSize = $contentSize;
    }

    public function getContentUrl(): string
    {
        return Tools::getDataURI(is_resource($this->data) ? stream_get_contents($this->data) : $this->data, $this->fileFormat);
    }

    public function getFileFormat(): string
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
}
