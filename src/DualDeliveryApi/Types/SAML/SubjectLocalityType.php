<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SAML;

class SubjectLocalityType
{
    /**
     * @var string
     */
    protected $IPAddress;

    /**
     * @var string
     */
    protected $DNSAddress;

    /**
     * @param string $IPAddress
     * @param string $DNSAddress
     */
    public function __construct($IPAddress, $DNSAddress)
    {
        $this->IPAddress = $IPAddress;
        $this->DNSAddress = $DNSAddress;
    }

    public function getIPAddress(): string
    {
        return $this->IPAddress;
    }

    public function setIPAddress(string $IPAddress): self
    {
        $this->IPAddress = $IPAddress;

        return $this;
    }

    public function getDNSAddress(): string
    {
        return $this->DNSAddress;
    }

    public function setDNSAddress(string $DNSAddress): self
    {
        $this->DNSAddress = $DNSAddress;

        return $this;
    }
}
