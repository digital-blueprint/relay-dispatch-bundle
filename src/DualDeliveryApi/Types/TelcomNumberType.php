<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class TelcomNumberType
{
    /**
     * @var string
     */
    protected $FormattedNumber = null;

    /**
     * @param string $FormattedNumber
     */
    public function __construct($FormattedNumber)
    {
        $this->FormattedNumber = $FormattedNumber;
    }

    /**
     * @return string
     */
    public function getFormattedNumber()
    {
        return $this->FormattedNumber;
    }

    /**
     * @param string $FormattedNumber
     *
     * @return TelcomNumberType
     */
    public function setFormattedNumber($FormattedNumber)
    {
        $this->FormattedNumber = $FormattedNumber;

        return $this;
    }
}
