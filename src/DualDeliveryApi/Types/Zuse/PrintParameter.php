<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

class PrintParameter
{
    /**
     * @var string
     */
    protected $any = null;

    /**
     * @var string
     */
    protected $profile = null;

    public function __construct(string $any, string $profile)
    {
        $this->any = $any;
        $this->profile = $profile;
    }

    public function getAny(): string
    {
        return $this->any;
    }

    public function setAny(string $any): void
    {
        $this->any = $any;
    }

    public function getProfile(): string
    {
        return $this->profile;
    }

    public function setProfile(string $profile): void
    {
        $this->profile = $profile;
    }
}
