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

    /**
     * @return string
     */
    public function getX509IssuerName()
    {
        return $this->X509IssuerName;
    }

    /**
     * @param string $X509IssuerName
     *
     * @return X509IssuerSerialType
     */
    public function setX509IssuerName($X509IssuerName)
    {
        $this->X509IssuerName = $X509IssuerName;

        return $this;
    }

    /**
     * @return int
     */
    public function getX509SerialNumber()
    {
        return $this->X509SerialNumber;
    }

    /**
     * @param int $X509SerialNumber
     *
     * @return X509IssuerSerialType
     */
    public function setX509SerialNumber($X509SerialNumber)
    {
        $this->X509SerialNumber = $X509SerialNumber;

        return $this;
    }
}
