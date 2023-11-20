<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Entity;

date_default_timezone_set('UTC');

use Dbp\Relay\DispatchBundle\Helpers\Tools;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 *
 * @ORM\Table(name="dispatch_request_files")
 */
class RequestFile
{
    /**
     * @ORM\Id
     *
     * @ORM\Column(type="string", length=50)
     *
     * @Groups({"DispatchRequestFile:output", "DispatchRequest:output"})
     */
    private $identifier;

    /**
     * @ORM\Column(type="datetime")
     *
     * @Groups({"DispatchRequestFile:output", "DispatchRequest:output"})
     *
     * @var \DateTimeInterface
     */
    private $dateCreated;

    /**
     * @ORM\ManyToOne(targetEntity="Request", inversedBy="files")
     *
     * @ORM\JoinColumn(name="dispatch_request_identifier", referencedColumnName="identifier")
     *
     * @Groups({"DispatchRequestFile:output"})
     *
     * @var Request
     */
    private $request;

    /**
     * @ORM\Column(type="string", length=50)
     *
     * @Groups({"DispatchRequestFile:output", "DispatchRequestFile:input"})
     *
     * @var string
     */
    private $dispatchRequestIdentifier;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Groups({"DispatchRequestFile:output", "DispatchRequestFile:input", "DispatchRequest:output"})
     *
     * @var string
     */
    private $name;

    /**
     * @Groups({"DispatchRequestFile:output"})
     *
     * @var string
     */
    private $contentUrl = '';

    /**
     * @ORM\Column(type="binary", length=209715200)
     *
     * @var resource|string|int|false
     */
    private $data;

    /**
     * @ORM\Column(type="string", length=100)
     *
     * @Groups({"DispatchRequestFile:output", "DispatchRequest:output"})
     *
     * @var string
     */
    private $fileFormat;

    /**
     * @ORM\Column(type="integer")
     *
     * @Groups({"DispatchRequestFile:output", "DispatchRequest:output"})
     *
     * @var int
     */
    private $contentSize;

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
     * @return resource|string|int|false|null
     *
     * @throws \Exception
     */
    public function getData()
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
    public function setData($data): void
    {
        $this->contentUrl = '';
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
        if ($this->fileStorageSystem !== 'blob' && !$this->isContentUrlSet()) {
            $this->contentUrl = Tools::getDataURI($this->getData(), $this->fileFormat);
        }

        return $this->contentUrl;
    }

    public function isContentUrlSet(): bool
    {
        return $this->contentUrl !== '' && $this->contentUrl !== null;
    }

    public function setContentUrl(string $contentUrl): void
    {
        $this->contentUrl = $contentUrl;
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
}
