<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\AlphaNumIDType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\AlphaNumType;

class OrderReferenceDetailType
{
    /**
     * @var AlphaNumIDType
     */
    protected $OrderID = null;

    /**
     * @var AlphaNumType
     */
    protected $OrderPositionNumber = null;

    /**
     * @param AlphaNumIDType $OrderID
     * @param AlphaNumType   $OrderPositionNumber
     */
    public function __construct($OrderID, $OrderPositionNumber)
    {
        $this->OrderID = $OrderID;
        $this->OrderPositionNumber = $OrderPositionNumber;
    }

    /**
     * @return AlphaNumIDType
     */
    public function getOrderID()
    {
        return $this->OrderID;
    }

    /**
     * @param AlphaNumIDType $OrderID
     */
    public function setOrderID($OrderID): self
    {
        $this->OrderID = $OrderID;

        return $this;
    }

    /**
     * @return AlphaNumType
     */
    public function getOrderPositionNumber()
    {
        return $this->OrderPositionNumber;
    }

    /**
     * @param AlphaNumType $OrderPositionNumber
     */
    public function setOrderPositionNumber($OrderPositionNumber): self
    {
        $this->OrderPositionNumber = $OrderPositionNumber;

        return $this;
    }
}
