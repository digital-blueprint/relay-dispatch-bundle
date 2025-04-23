<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

class OrderReferenceDetailType
{
    /**
     * @var string
     */
    protected $OrderID;

    /**
     * @var string
     */
    protected $OrderPositionNumber;

    /**
     * @param string $OrderID
     * @param string $OrderPositionNumber
     */
    public function __construct($OrderID, $OrderPositionNumber)
    {
        $this->OrderID = $OrderID;
        $this->OrderPositionNumber = $OrderPositionNumber;
    }

    /**
     * @return string
     */
    public function getOrderID()
    {
        return $this->OrderID;
    }

    /**
     * @param string $OrderID
     */
    public function setOrderID($OrderID): self
    {
        $this->OrderID = $OrderID;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrderPositionNumber()
    {
        return $this->OrderPositionNumber;
    }

    /**
     * @param string $OrderPositionNumber
     */
    public function setOrderPositionNumber($OrderPositionNumber): self
    {
        $this->OrderPositionNumber = $OrderPositionNumber;

        return $this;
    }
}
