<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class NameIdentifierType
{
    /**
     * @var string
     */
    protected $_ = null;

    /**
     * @var string
     */
    protected $NameQualifier = null;

    /**
     * @var AnyURI
     */
    protected $Format = null;

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

    /**
     * @return string
     */
    public function get_()
    {
        return $this->_;
    }

    /**
     * @param string $_
     *
     * @return NameIdentifierType
     */
    public function set_($_)
    {
        $this->_ = $_;

        return $this;
    }

    /**
     * @return string
     */
    public function getNameQualifier()
    {
        return $this->NameQualifier;
    }

    /**
     * @param string $NameQualifier
     *
     * @return NameIdentifierType
     */
    public function setNameQualifier($NameQualifier)
    {
        $this->NameQualifier = $NameQualifier;

        return $this;
    }

    /**
     * @return AnyURI
     */
    public function getFormat()
    {
        return $this->Format;
    }

    /**
     * @param AnyURI $Format
     *
     * @return NameIdentifierType
     */
    public function setFormat($Format)
    {
        $this->Format = $Format;

        return $this;
    }
}
