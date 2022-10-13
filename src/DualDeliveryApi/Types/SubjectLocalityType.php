<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class SubjectLocalityType
{
    /**
     * @var string
     */
    protected $IPAddress = null;

    /**
     * @var string
     */
    protected $DNSAddress = null;

    /**
     * @param string $IPAddress
     * @param string $DNSAddress
     */
    public function __construct($IPAddress, $DNSAddress)
    {
        $this->IPAddress = $IPAddress;
        $this->DNSAddress = $DNSAddress;
    }

    /**
     * @return string
     */
    public function getIPAddress()
    {
        return $this->IPAddress;
    }

    /**
     * @param string $IPAddress
     *
     * @return SubjectLocalityType
     */
    public function setIPAddress($IPAddress)
    {
        $this->IPAddress = $IPAddress;

        return $this;
    }

    /**
     * @return string
     */
    public function getDNSAddress()
    {
        return $this->DNSAddress;
    }

    /**
     * @param string $DNSAddress
     *
     * @return SubjectLocalityType
     */
    public function setDNSAddress($DNSAddress)
    {
        $this->DNSAddress = $DNSAddress;

        return $this;
    }
}
