<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SAML;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\AnyURI;

class NameIdentifierType
{
    /**
     * @var string
     */
    protected $_;

    /**
     * @var string
     */
    protected $NameQualifier;

    /**
     * @var AnyURI
     */
    protected $Format;

    /**
     * @param string $_
     * @param string $NameQualifier
     * @param AnyURI $Format
     */
    public function __construct($_, $NameQualifier, $Format)
    {
        $this->_ = $_;
        $this->NameQualifier = $NameQualifier;
        $this->Format = $Format;
    }

    public function get_(): string
    {
        return $this->_;
    }

    public function set_(string $_): self
    {
        $this->_ = $_;

        return $this;
    }

    public function getNameQualifier(): string
    {
        return $this->NameQualifier;
    }

    public function setNameQualifier(string $NameQualifier): self
    {
        $this->NameQualifier = $NameQualifier;

        return $this;
    }

    public function getFormat(): AnyURI
    {
        return $this->Format;
    }

    public function setFormat(AnyURI $Format): self
    {
        $this->Format = $Format;

        return $this;
    }
}
