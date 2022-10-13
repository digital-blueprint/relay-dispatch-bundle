<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class DSAKeyValueType
{
    /**
     * @var CryptoBinary
     */
    protected $P = null;

    /**
     * @var CryptoBinary
     */
    protected $Q = null;

    /**
     * @var CryptoBinary
     */
    protected $J = null;

    /**
     * @var CryptoBinary
     */
    protected $G = null;

    /**
     * @var CryptoBinary
     */
    protected $Y = null;

    /**
     * @var CryptoBinary
     */
    protected $Seed = null;

    /**
     * @var CryptoBinary
     */
    protected $PgenCounter = null;

    /**
     * @param CryptoBinary $P
     * @param CryptoBinary $Q
     * @param CryptoBinary $Y
     * @param CryptoBinary $Seed
     * @param CryptoBinary $PgenCounter
     */
    public function __construct($P, $Q, $Y, $Seed, $PgenCounter)
    {
        $this->P = $P;
        $this->Q = $Q;
        $this->Y = $Y;
        $this->Seed = $Seed;
        $this->PgenCounter = $PgenCounter;
    }

    /**
     * @return CryptoBinary
     */
    public function getP()
    {
        return $this->P;
    }

    /**
     * @param CryptoBinary $P
     *
     * @return DSAKeyValueType
     */
    public function setP($P)
    {
        $this->P = $P;

        return $this;
    }

    /**
     * @return CryptoBinary
     */
    public function getQ()
    {
        return $this->Q;
    }

    /**
     * @param CryptoBinary $Q
     *
     * @return DSAKeyValueType
     */
    public function setQ($Q)
    {
        $this->Q = $Q;

        return $this;
    }

    /**
     * @return CryptoBinary
     */
    public function getJ()
    {
        return $this->J;
    }

    /**
     * @param CryptoBinary $J
     *
     * @return DSAKeyValueType
     */
    public function setJ($J)
    {
        $this->J = $J;

        return $this;
    }

    /**
     * @return CryptoBinary
     */
    public function getG()
    {
        return $this->G;
    }

    /**
     * @param CryptoBinary $G
     *
     * @return DSAKeyValueType
     */
    public function setG($G)
    {
        $this->G = $G;

        return $this;
    }

    /**
     * @return CryptoBinary
     */
    public function getY()
    {
        return $this->Y;
    }

    /**
     * @param CryptoBinary $Y
     *
     * @return DSAKeyValueType
     */
    public function setY($Y)
    {
        $this->Y = $Y;

        return $this;
    }

    /**
     * @return CryptoBinary
     */
    public function getSeed()
    {
        return $this->Seed;
    }

    /**
     * @param CryptoBinary $Seed
     *
     * @return DSAKeyValueType
     */
    public function setSeed($Seed)
    {
        $this->Seed = $Seed;

        return $this;
    }

    /**
     * @return CryptoBinary
     */
    public function getPgenCounter()
    {
        return $this->PgenCounter;
    }

    /**
     * @param CryptoBinary $PgenCounter
     *
     * @return DSAKeyValueType
     */
    public function setPgenCounter($PgenCounter)
    {
        $this->PgenCounter = $PgenCounter;

        return $this;
    }
}
