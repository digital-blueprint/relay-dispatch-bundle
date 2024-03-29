<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

class TelcomNumberType
{
    /**
     * @var string
     */
    protected $FormattedNumber;

    public function __construct(string $FormattedNumber)
    {
        $this->FormattedNumber = $FormattedNumber;
    }

    public function getFormattedNumber(): string
    {
        return $this->FormattedNumber;
    }

    public function setFormattedNumber(string $FormattedNumber): void
    {
        $this->FormattedNumber = $FormattedNumber;
    }
}
