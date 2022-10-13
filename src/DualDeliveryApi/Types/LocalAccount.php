<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class LocalAccount
{
    /**
     * @var BLZ
     */
    protected $BLZ = null;

    /**
     * @var AccountNr
     */
    protected $AccountNr = null;

    /**
     * @param BLZ       $BLZ
     * @param AccountNr $AccountNr
     */
    public function __construct($BLZ, $AccountNr)
    {
        $this->BLZ = $BLZ;
        $this->AccountNr = $AccountNr;
    }

    /**
     * @return BLZ
     */
    public function getBLZ()
    {
        return $this->BLZ;
    }

    /**
     * @param BLZ $BLZ
     *
     * @return LocalAccount
     */
    public function setBLZ($BLZ)
    {
        $this->BLZ = $BLZ;

        return $this;
    }

    /**
     * @return AccountNr
     */
    public function getAccountNr()
    {
        return $this->AccountNr;
    }

    /**
     * @param AccountNr $AccountNr
     *
     * @return LocalAccount
     */
    public function setAccountNr($AccountNr)
    {
        $this->AccountNr = $AccountNr;

        return $this;
    }
}
