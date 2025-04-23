<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig;

class ObjectType
{
    /**
     * @var string
     */
    protected $any;

    /**
     * @var string
     */
    protected $Id;

    /**
     * @var string
     */
    protected $MimeType;

    /**
     * @var string
     */
    protected $Encoding;

    /**
     * @param string $any
     * @param string $Id
     * @param string $MimeType
     * @param string $Encoding
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

    public function getEncoding(): string
    {
        return $this->Encoding;
    }

    public function setEncoding(string $Encoding): self
    {
        $this->Encoding = $Encoding;

        return $this;
    }
}
