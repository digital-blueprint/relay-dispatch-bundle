<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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

    /**
     * @return X509IssuerSerialType
     */
    public function getX509IssuerSerial()
    {
        return $this->X509IssuerSerial;
    }

    /**
     * @param X509IssuerSerialType $X509IssuerSerial
     *
     * @return X509DataType
     */
    public function setX509IssuerSerial($X509IssuerSerial)
    {
        $this->X509IssuerSerial = $X509IssuerSerial;

        return $this;
    }

    /**
     * @return CryptoBinary
     */
    public function getX509SKI()
    {
        return $this->X509SKI;
    }

    /**
     * @param CryptoBinary $X509SKI
     *
     * @return X509DataType
     */
    public function setX509SKI($X509SKI)
    {
        $this->X509SKI = $X509SKI;

        return $this;
    }

    /**
     * @return string
     */
    public function getX509SubjectName()
    {
        return $this->X509SubjectName;
    }

    /**
     * @param string $X509SubjectName
     *
     * @return X509DataType
     */
    public function setX509SubjectName($X509SubjectName)
    {
        $this->X509SubjectName = $X509SubjectName;

        return $this;
    }

    /**
     * @return CryptoBinary
     */
    public function getX509Certificate()
    {
        return $this->X509Certificate;
    }

    /**
     * @param CryptoBinary $X509Certificate
     *
     * @return X509DataType
     */
    public function setX509Certificate($X509Certificate)
    {
        $this->X509Certificate = $X509Certificate;

        return $this;
    }

    /**
     * @return CryptoBinary
     */
    public function getX509CRL()
    {
        return $this->X509CRL;
    }

    /**
     * @param CryptoBinary $X509CRL
     *
     * @return X509DataType
     */
    public function setX509CRL($X509CRL)
    {
        $this->X509CRL = $X509CRL;

        return $this;
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
     * @return X509DataType
     */
    public function setAny($any)
    {
        $this->any = $any;

        return $this;
    }
}
