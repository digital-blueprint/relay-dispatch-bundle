<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class AddressingResults
{
    /**
     * @var AddressingResult
     */
    protected $AddressingResult = null;

    /**
     * @param AddressingResult $AddressingResult
     */
    public function __construct($AddressingResult)
    {
        $this->AddressingResult = $AddressingResult;
    }

    /**
     * @return AddressingResult
     */
    public function getAddressingResult()
    {
        return $this->AddressingResult;
    }

    /**
     * @param AddressingResult $AddressingResult
     *
     * @return AddressingResults
     */
    public function setAddressingResult($AddressingResult)
    {
        $this->AddressingResult = $AddressingResult;

        return $this;
    }
}
