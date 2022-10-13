<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class PrintParameter
{
    /**
     * @var string
     */
    protected $any = null;

    /**
     * @var AnyURI
     */
    protected $profile = null;

    /**
     * @param string $any
     * @param AnyURI $profile
     */
    public function __construct($any, $profile)
    {
        $this->any = $any;
        $this->profile = $profile;
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
     * @return PrintParameter
     */
    public function setAny($any)
    {
        $this->any = $any;

        return $this;
    }

    /**
     * @return AnyURI
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * @param AnyURI $profile
     *
     * @return PrintParameter
     */
    public function setProfile($profile)
    {
        $this->profile = $profile;

        return $this;
    }
}
