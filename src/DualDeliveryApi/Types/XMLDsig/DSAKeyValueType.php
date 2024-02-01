<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig;

class DSAKeyValueType
{
    /**
     * @var CryptoBinary
     */
    protected $P;

    /**
     * @var CryptoBinary
     */
    protected $Q;

    /**
     * @var CryptoBinary
     */
    protected $J;

    /**
     * @var CryptoBinary
     */
    protected $G;

    /**
     * @var CryptoBinary
     */
    protected $Y;

    /**
     * @var CryptoBinary
     */
    protected $Seed;

    /**
     * @var CryptoBinary
     */
    protected $PgenCounter;

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

    public function getP(): CryptoBinary
    {
        return $this->P;
    }

    public function setP(CryptoBinary $P): self
    {
        $this->P = $P;

        return $this;
    }

    public function getQ(): CryptoBinary
    {
        return $this->Q;
    }

    public function setQ(CryptoBinary $Q): self
    {
        $this->Q = $Q;

        return $this;
    }

    public function getJ(): CryptoBinary
    {
        return $this->J;
    }

    public function setJ(CryptoBinary $J): self
    {
        $this->J = $J;

        return $this;
    }

    public function getG(): CryptoBinary
    {
        return $this->G;
    }

    public function setG(CryptoBinary $G): self
    {
        $this->G = $G;

        return $this;
    }

    public function getY(): CryptoBinary
    {
        return $this->Y;
    }

    public function setY(CryptoBinary $Y): self
    {
        $this->Y = $Y;

        return $this;
    }

    public function getSeed(): CryptoBinary
    {
        return $this->Seed;
    }

    public function setSeed(CryptoBinary $Seed): self
    {
        $this->Seed = $Seed;

        return $this;
    }

    public function getPgenCounter(): CryptoBinary
    {
        return $this->PgenCounter;
    }

    public function setPgenCounter(CryptoBinary $PgenCounter): self
    {
        $this->PgenCounter = $PgenCounter;

        return $this;
    }
}
