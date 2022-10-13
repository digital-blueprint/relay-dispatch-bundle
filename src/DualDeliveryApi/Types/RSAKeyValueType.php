<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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

    /**
     * @return CryptoBinary
     */
    public function getModulus()
    {
        return $this->Modulus;
    }

    /**
     * @param CryptoBinary $Modulus
     *
     * @return RSAKeyValueType
     */
    public function setModulus($Modulus)
    {
        $this->Modulus = $Modulus;

        return $this;
    }

    /**
     * @return CryptoBinary
     */
    public function getExponent()
    {
        return $this->Exponent;
    }

    /**
     * @param CryptoBinary $Exponent
     *
     * @return RSAKeyValueType
     */
    public function setExponent($Exponent)
    {
        $this->Exponent = $Exponent;

        return $this;
    }
}
