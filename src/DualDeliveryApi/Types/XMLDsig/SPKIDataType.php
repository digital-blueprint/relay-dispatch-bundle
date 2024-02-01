<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig;

class SPKIDataType
{
    /**
     * @var CryptoBinary
     */
    protected $SPKISexp;

    /**
     * @var string
     */
    protected $any;

    /**
     * @param CryptoBinary $SPKISexp
     * @param string       $any
     */
    public function __construct($SPKISexp, $any)
    {
        $this->SPKISexp = $SPKISexp;
        $this->any = $any;
    }

    public function getSPKISexp(): CryptoBinary
    {
        return $this->SPKISexp;
    }

    public function setSPKISexp(CryptoBinary $SPKISexp): self
    {
        $this->SPKISexp = $SPKISexp;

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
