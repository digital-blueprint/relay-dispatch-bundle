<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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
     *
     * @return PeriodType
     */
    public function setFromDate($FromDate)
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
     *
     * @return PeriodType
     */
    public function setToDate($ToDate)
    {
        $this->ToDate = $ToDate;

        return $this;
    }
}
