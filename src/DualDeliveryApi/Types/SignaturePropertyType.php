<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class SignaturePropertyType
{
    /**
     * @var string
     */
    protected $any = null;

    /**
     * @var AnyURI
     */
    protected $Target = null;

    /**
     * @var string
     */
    protected $Id = null;

    /**
     * @param string $any
     * @param AnyURI $Target
     * @param string $Id
     */
    public function __construct($any, $Target, $Id)
    {
        $this->any = $any;
        $this->Target = $Target;
        $this->Id = $Id;
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
     * @return SignaturePropertyType
     */
    public function setAny($any)
    {
        $this->any = $any;

        return $this;
    }

    /**
     * @return AnyURI
     */
    public function getTarget()
    {
        return $this->Target;
    }

    /**
     * @param AnyURI $Target
     *
     * @return SignaturePropertyType
     */
    public function setTarget($Target)
    {
        $this->Target = $Target;

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
     * @return SignaturePropertyType
     */
    public function setId($Id)
    {
        $this->Id = $Id;

        return $this;
    }
}
