<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class DocumentReference
{
    /**
     * @var AnyURI
     */
    protected $URL = null;

    /**
     * @var token255
     */
    protected $MimeType = null;

    /**
     * @var string255
     */
    protected $FileName = null;

    /**
     * @var token255
     */
    protected $MD5Checksum = null;

    /**
     * @param AnyURI    $URL
     * @param token255  $MimeType
     * @param string255 $FileName
     * @param token255  $MD5Checksum
     */
    public function __construct($URL, $MimeType, $FileName, $MD5Checksum)
    {
        $this->URL = $URL;
        $this->MimeType = $MimeType;
        $this->FileName = $FileName;
        $this->MD5Checksum = $MD5Checksum;
    }

    public function getURL(): AnyURI
    {
        return $this->URL;
    }

    public function setURL(AnyURI $URL): self
    {
        $this->URL = $URL;

        return $this;
    }

    /**
     * @return token255
     */
    public function getMimeType()
    {
        return $this->MimeType;
    }

    /**
     * @param token255 $MimeType
     */
    public function setMimeType($MimeType): self
    {
        $this->MimeType = $MimeType;

        return $this;
    }

    /**
     * @return string255
     */
    public function getFileName()
    {
        return $this->FileName;
    }

    /**
     * @param string255 $FileName
     */
    public function setFileName($FileName): self
    {
        $this->FileName = $FileName;

        return $this;
    }

    /**
     * @return token255
     */
    public function getMD5Checksum()
    {
        return $this->MD5Checksum;
    }

    /**
     * @param token255 $MD5Checksum
     */
    public function setMD5Checksum($MD5Checksum): self
    {
        $this->MD5Checksum = $MD5Checksum;

        return $this;
    }
}
