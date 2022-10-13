<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class IdentificationType
{
    /**
     * @var Value
     */
    protected $Value = null;

    /**
     * @var AnyURI
     */
    protected $Type = null;

    /**
     * @var AnyURI
     */
    protected $Authority = null;

    /**
     * @var string
     */
    protected $any = null;

    /**
     * @var string
     */
    protected $Id = null;

    /**
     * @param Value  $Value
     * @param AnyURI $Type
     * @param AnyURI $Authority
     * @param string $any
     * @param string $Id
     */
    public function __construct($Value, $Type, $Authority, $any, $Id)
    {
        $this->Value = $Value;
        $this->Type = $Type;
        $this->Authority = $Authority;
        $this->any = $any;
        $this->Id = $Id;
    }

    /**
     * @return Value
     */
    public function getValue()
    {
        return $this->Value;
    }

    /**
     * @param Value $Value
     *
     * @return stringentificationType
     */
    public function setValue($Value)
    {
        $this->Value = $Value;

        return $this;
    }

    /**
     * @return AnyURI
     */
    public function getType()
    {
        return $this->Type;
    }

    /**
     * @param AnyURI $Type
     *
     * @return stringentificationType
     */
    public function setType($Type)
    {
        $this->Type = $Type;

        return $this;
    }

    /**
     * @return AnyURI
     */
    public function getAuthority()
    {
        return $this->Authority;
    }

    /**
     * @param AnyURI $Authority
     *
     * @return stringentificationType
     */
    public function setAuthority($Authority)
    {
        $this->Authority = $Authority;

        return $this;
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
     * @return stringentificationType
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
     * @return stringentificationType
     */
    public function setId($Id)
    {
        $this->Id = $Id;

        return $this;
    }
}
