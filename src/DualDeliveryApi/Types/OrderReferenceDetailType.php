<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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
     *
     * @return OrderReferenceDetailType
     */
    public function setOrderID($OrderID)
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
     *
     * @return OrderReferenceDetailType
     */
    public function setOrderPositionNumber($OrderPositionNumber)
    {
        $this->OrderPositionNumber = $OrderPositionNumber;

        return $this;
    }
}
