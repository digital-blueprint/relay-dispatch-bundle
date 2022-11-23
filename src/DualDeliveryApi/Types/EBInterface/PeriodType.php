<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\date;

class PeriodType
{
    /**
     * @var date
     */
    protected $FromDate = null;

    /**
     * @var date
     */
    protected $ToDate = null;

    /**
     * @param date $FromDate
     * @param date $ToDate
     */
    public function __construct($FromDate, $ToDate)
    {
        $this->FromDate = $FromDate;
        $this->ToDate = $ToDate;
    }

    /**
     * @return date
     */
    public function getFromDate()
    {
        return $this->FromDate;
    }

    /**
     * @param date $FromDate
     */
    public function setFromDate($FromDate): self
    {
        $this->FromDate = $FromDate;

        return $this;
    }

    /**
     * @return date
     */
    public function getToDate()
    {
        return $this->ToDate;
    }

    /**
     * @param date $ToDate
     */
    public function setToDate($ToDate): self
    {
        $this->ToDate = $ToDate;

        return $this;
    }
}
