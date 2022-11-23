<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse\AbstractAddressType;

class TelephoneAddressType extends AbstractAddressType
{
    /**
     * @var TelcomNumberType
     */
    protected $Number = null;

    /**
     * @param string           $Id
     * @param TelcomNumberType $Number
     */
    public function __construct($Id, $Number)
    {
        parent::__construct($Id);
        $this->Number = $Number;
    }

    public function getNumber(): TelcomNumberType
    {
        return $this->Number;
    }

    public function setNumber(TelcomNumberType $Number): self
    {
        $this->Number = $Number;

        return $this;
    }
}
