<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

class DocumentReference
{
    /**
     * @var string
     */
    protected $URL = null;

    /**
     * @var ?string
     */
    protected $MimeType = null;

    /**
     * @var ?string
     */
    protected $FileName = null;

    /**
     * @var ?string
     */
    protected $MD5Checksum = null;

    public function __construct(string $URL, ?string $MimeType, ?string $FileName, ?string $MD5Checksum)
    {
        $this->URL = $URL;
        $this->MimeType = $MimeType;
        $this->FileName = $FileName;
        $this->MD5Checksum = $MD5Checksum;
    }

    public function getURL(): string
    {
        return $this->URL;
    }

    public function setURL(string $URL): void
    {
        $this->URL = $URL;
    }

    public function getMimeType(): string
    {
        return $this->MimeType;
    }

    public function setMimeType(string $MimeType): void
    {
        $this->MimeType = $MimeType;
    }

    public function getFileName(): string
    {
        return $this->FileName;
    }

    public function setFileName(string $FileName): void
    {
        $this->FileName = $FileName;
    }

    public function getMD5Checksum(): string
    {
        return $this->MD5Checksum;
    }

    public function setMD5Checksum(string $MD5Checksum): void
    {
        $this->MD5Checksum = $MD5Checksum;
    }
}
