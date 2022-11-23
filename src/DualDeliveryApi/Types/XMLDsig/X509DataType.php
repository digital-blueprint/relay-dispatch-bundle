<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig;

class X509DataType
{
    /**
     * @var X509IssuerSerialType
     */
    protected $X509IssuerSerial = null;

    /**
     * @var CryptoBinary
     */
    protected $X509SKI = null;

    /**
     * @var string
     */
    protected $X509SubjectName = null;

    /**
     * @var CryptoBinary
     */
    protected $X509Certificate = null;

    /**
     * @var CryptoBinary
     */
    protected $X509CRL = null;

    /**
     * @var string
     */
    protected $any = null;

    /**
     * @param X509IssuerSerialType $X509IssuerSerial
     * @param CryptoBinary         $X509SKI
     * @param string               $X509SubjectName
     * @param CryptoBinary         $X509Certificate
     * @param CryptoBinary         $X509CRL
     * @param string               $any
     */
    public function __construct($X509IssuerSerial, $X509SKI, $X509SubjectName, $X509Certificate, $X509CRL, $any)
    {
        $this->X509IssuerSerial = $X509IssuerSerial;
        $this->X509SKI = $X509SKI;
        $this->X509SubjectName = $X509SubjectName;
        $this->X509Certificate = $X509Certificate;
        $this->X509CRL = $X509CRL;
        $this->any = $any;
    }

    public function getX509IssuerSerial(): X509IssuerSerialType
    {
        return $this->X509IssuerSerial;
    }

    public function setX509IssuerSerial(X509IssuerSerialType $X509IssuerSerial): self
    {
        $this->X509IssuerSerial = $X509IssuerSerial;

        return $this;
    }

    public function getX509SKI(): CryptoBinary
    {
        return $this->X509SKI;
    }

    public function setX509SKI(CryptoBinary $X509SKI): self
    {
        $this->X509SKI = $X509SKI;

        return $this;
    }

    public function getX509SubjectName(): string
    {
        return $this->X509SubjectName;
    }

    public function setX509SubjectName(string $X509SubjectName): self
    {
        $this->X509SubjectName = $X509SubjectName;

        return $this;
    }

    public function getX509Certificate(): CryptoBinary
    {
        return $this->X509Certificate;
    }

    public function setX509Certificate(CryptoBinary $X509Certificate): self
    {
        $this->X509Certificate = $X509Certificate;

        return $this;
    }

    public function getX509CRL(): CryptoBinary
    {
        return $this->X509CRL;
    }

    public function setX509CRL(CryptoBinary $X509CRL): self
    {
        $this->X509CRL = $X509CRL;

        return $this;
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
}
