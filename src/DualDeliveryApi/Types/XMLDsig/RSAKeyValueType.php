<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig;

class RSAKeyValueType
{
    /**
     * @var CryptoBinary
     */
    protected $Modulus = null;

    /**
     * @var CryptoBinary
     */
    protected $Exponent = null;

    /**
     * @param CryptoBinary $Modulus
     * @param CryptoBinary $Exponent
     */
    public function __construct($Modulus, $Exponent)
    {
        $this->Modulus = $Modulus;
        $this->Exponent = $Exponent;
    }

    public function getModulus(): CryptoBinary
    {
        return $this->Modulus;
    }

    public function setModulus(CryptoBinary $Modulus): self
    {
        $this->Modulus = $Modulus;

        return $this;
    }

    public function getExponent(): CryptoBinary
    {
        return $this->Exponent;
    }

    public function setExponent(CryptoBinary $Exponent): self
    {
        $this->Exponent = $Exponent;

        return $this;
    }
}
