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

    public function getAny(): string
    {
        return $this->any;
    }

    public function setAny(string $any): self
    {
        $this->any = $any;

        return $this;
    }

    public function getId(): string
    {
        return $this->Id;
    }

    public function setId(string $Id): self
    {
        $this->Id = $Id;

        return $this;
    }

    public function getMimeType(): string
    {
        return $this->MimeType;
    }

    public function setMimeType(string $MimeType): self
    {
        $this->MimeType = $MimeType;

        return $this;
    }

    public function getEncoding(): AnyURI
    {
        return $this->Encoding;
    }

    public function setEncoding(AnyURI $Encoding): self
    {
        $this->Encoding = $Encoding;

        return $this;
    }
}
