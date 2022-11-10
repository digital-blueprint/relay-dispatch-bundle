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

    public function getAny(): string
    {
        return $this->any;
    }

    public function setAny(string $any): self
    {
        $this->any = $any;

        return $this;
    }

    public function getProfile(): AnyURI
    {
        return $this->profile;
    }

    public function setProfile(AnyURI $profile): self
    {
        $this->profile = $profile;

        return $this;
    }
}
