<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig;

class KeyValueType
{
    /**
     * @var DSAKeyValueType
     */
    protected $DSAKeyValue;

    /**
     * @var RSAKeyValueType
     */
    protected $RSAKeyValue;

    /**
     * @var string
     */
    protected $any;

    /**
     * @param DSAKeyValueType $DSAKeyValue
     * @param RSAKeyValueType $RSAKeyValue
     * @param string          $any
     */
    public function __construct($DSAKeyValue, $RSAKeyValue, $any)
    {
        $this->DSAKeyValue = $DSAKeyValue;
        $this->RSAKeyValue = $RSAKeyValue;
        $this->any = $any;
    }

    public function getDSAKeyValue(): DSAKeyValueType
    {
        return $this->DSAKeyValue;
    }

    public function setDSAKeyValue(DSAKeyValueType $DSAKeyValue): self
    {
        $this->DSAKeyValue = $DSAKeyValue;

        return $this;
    }

    public function getRSAKeyValue(): RSAKeyValueType
    {
        return $this->RSAKeyValue;
    }

    public function setRSAKeyValue(RSAKeyValueType $RSAKeyValue): self
    {
        $this->RSAKeyValue = $RSAKeyValue;

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
