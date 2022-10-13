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

    /**
     * @return AnyURI
     */
    public function getURL()
    {
        return $this->URL;
    }

    /**
     * @param AnyURI $URL
     *
     * @return DocumentReference
     */
    public function setURL($URL)
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
     *
     * @return DocumentReference
     */
    public function setMimeType($MimeType)
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
     *
     * @return DocumentReference
     */
    public function setFileName($FileName)
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
     *
     * @return DocumentReference
     */
    public function setMD5Checksum($MD5Checksum)
    {
        $this->MD5Checksum = $MD5Checksum;

        return $this;
    }
}
