<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ObjectType
{
    /**
     * @var string
     */
    protected $any = null;

    /**
     * @var string
     */
    protected $Id = null;

    /**
     * @var string
     */
    protected $MimeType = null;

    /**
     * @var AnyURI
     */
    protected $Encoding = null;

    /**
     * @param string $any
     * @param string $Id
     * @param string $MimeType
     * @param AnyURI $Encoding
     */
    public function __construct($any, $Id, $MimeType, $Encoding)
    {
        $this->any = $any;
        $this->Id = $Id;
        $this->MimeType = $MimeType;
        $this->Encoding = $Encoding;
    }

    /**
     * @return string
     */
    public function getAny()
    {
        return $this->any;
    }

    /**
     * @param string $any
     *
     * @return ObjectType
     */
    public function setAny($any)
    {
        $this->any = $any;

        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * @param string $Id
     *
     * @return ObjectType
     */
    public function setId($Id)
    {
        $this->Id = $Id;

        return $this;
    }

    /**
     * @return string
     */
    public function getMimeType()
    {
        return $this->MimeType;
    }

    /**
     * @param string $MimeType
     *
     * @return ObjectType
     */
    public function setMimeType($MimeType)
    {
        $this->MimeType = $MimeType;

        return $this;
    }

    /**
     * @return AnyURI
     */
    public function getEncoding()
    {
        return $this->Encoding;
    }

    /**
     * @param AnyURI $Encoding
     *
     * @return ObjectType
     */
    public function setEncoding($Encoding)
    {
        $this->Encoding = $Encoding;

        return $this;
    }
}
