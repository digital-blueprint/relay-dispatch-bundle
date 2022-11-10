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

    public function getFormattedNumber(): string
    {
        return $this->FormattedNumber;
    }

    public function setFormattedNumber(string $FormattedNumber): self
    {
        $this->FormattedNumber = $FormattedNumber;

        return $this;
    }
}
