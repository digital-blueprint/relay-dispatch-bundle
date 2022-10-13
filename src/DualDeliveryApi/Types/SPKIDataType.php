<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class SPKIDataType
{
    /**
     * @var CryptoBinary
     */
    protected $SPKISexp = null;

    /**
     * @var string
     */
    protected $any = null;

    /**
     * @param CryptoBinary $SPKISexp
     * @param string       $any
     */
    public function __construct($SPKISexp, $any)
    {
        $this->SPKISexp = $SPKISexp;
        $this->any = $any;
    }

    /**
     * @return CryptoBinary
     */
    public function getSPKISexp()
    {
        return $this->SPKISexp;
    }

    /**
     * @param CryptoBinary $SPKISexp
     *
     * @return SPKIDataType
     */
    public function setSPKISexp($SPKISexp)
    {
        $this->SPKISexp = $SPKISexp;

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
     * @return SPKIDataType
     */
    public function setAny($any)
    {
        $this->any = $any;

        return $this;
    }
}
