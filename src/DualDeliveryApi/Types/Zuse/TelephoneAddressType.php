<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

class TelephoneAddressType extends AbstractAddressType
{
    /**
     * @var ?TelcomNumberType
     */
    protected $Number;

    public function __construct(string $Id, ?TelcomNumberType $Number)
    {
        parent::__construct($Id);
        $this->Number = $Number;
    }

    public function getNumber(): ?TelcomNumberType
    {
        return $this->Number;
    }

    public function setNumber(TelcomNumberType $Number): void
    {
        $this->Number = $Number;
    }
}
