<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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

    /**
     * @return TelcomNumberType
     */
    public function getNumber()
    {
        return $this->Number;
    }

    /**
     * @param TelcomNumberType $Number
     *
     * @return TelephoneAddressType
     */
    public function setNumber($Number)
    {
        $this->Number = $Number;

        return $this;
    }
}
