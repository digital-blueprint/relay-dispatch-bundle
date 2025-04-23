<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\date;

class OrderReferenceType
{
    /**
     * @var string
     */
    protected $OrderID;

    /**
     * @var date
     */
    protected $ReferenceDate;

    /**
     * @var string
     */
    protected $Description;

    /**
     * @param string $OrderID
     * @param date   $ReferenceDate
     * @param string $Description
     */
    public function __construct($OrderID, $ReferenceDate, $Description)
    {
        $this->OrderID = $OrderID;
        $this->ReferenceDate = $ReferenceDate;
        $this->Description = $Description;
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
     * @return date
     */
    public function getReferenceDate()
    {
        return $this->ReferenceDate;
    }

    /**
     * @param date $ReferenceDate
     */
    public function setReferenceDate($ReferenceDate): self
    {
        $this->ReferenceDate = $ReferenceDate;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }
}
