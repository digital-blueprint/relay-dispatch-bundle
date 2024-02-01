<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class LocalAccount
{
    /**
     * @var string
     */
    protected $BLZ;

    /**
     * @var string
     */
    protected $AccountNr;

    public function __construct(string $BLZ, string $AccountNr)
    {
        $this->BLZ = $BLZ;
        $this->AccountNr = $AccountNr;
    }

    public function getBLZ(): string
    {
        return $this->BLZ;
    }

    public function setBLZ(string $BLZ): void
    {
        $this->BLZ = $BLZ;
    }

    public function getAccountNr(): string
    {
        return $this->AccountNr;
    }

    public function setAccountNr(string $AccountNr): void
    {
        $this->AccountNr = $AccountNr;
    }
}
