<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class X509IssuerSerialType
{
    /**
     * @var string
     */
    protected $X509IssuerName = null;

    /**
     * @var int
     */
    protected $X509SerialNumber = null;

    /**
     * @param string $X509IssuerName
     * @param int    $X509SerialNumber
     */
    public function __construct($X509IssuerName, $X509SerialNumber)
    {
        $this->X509IssuerName = $X509IssuerName;
        $this->X509SerialNumber = $X509SerialNumber;
    }

    public function getX509IssuerName(): string
    {
        return $this->X509IssuerName;
    }

    public function setX509IssuerName(string $X509IssuerName): self
    {
        $this->X509IssuerName = $X509IssuerName;

        return $this;
    }

    public function getX509SerialNumber(): int
    {
        return $this->X509SerialNumber;
    }

    public function setX509SerialNumber(int $X509SerialNumber): self
    {
        $this->X509SerialNumber = $X509SerialNumber;

        return $this;
    }
}
