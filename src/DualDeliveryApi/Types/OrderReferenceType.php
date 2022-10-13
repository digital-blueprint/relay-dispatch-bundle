<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class OrderReferenceType
{
    /**
     * @var AlphaNumIDType
     */
    protected $OrderID = null;

    /**
     * @var date
     */
    protected $ReferenceDate = null;

    /**
     * @var string
     */
    protected $Description = null;

    /**
     * @param AlphaNumIDType $OrderID
     * @param date           $ReferenceDate
     * @param string         $Description
     */
    public function __construct($OrderID, $ReferenceDate, $Description)
    {
        $this->OrderID = $OrderID;
        $this->ReferenceDate = $ReferenceDate;
        $this->Description = $Description;
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
     * @return OrderReferenceType
     */
    public function setOrderID($OrderID)
    {
        $this->OrderID = $OrderID;

        return $this;
    }

    /**
     * @return date
     */
    public function getReferenceDate()
    {
        return $this->ReferenceDate;
    }

    /**
     * @param date $ReferenceDate
     *
     * @return OrderReferenceType
     */
    public function setReferenceDate($ReferenceDate)
    {
        $this->ReferenceDate = $ReferenceDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * @param string $Description
     *
     * @return OrderReferenceType
     */
    public function setDescription($Description)
    {
        $this->Description = $Description;

        return $this;
    }
}
