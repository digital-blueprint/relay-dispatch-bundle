<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class AddressingResults
{
    /**
     * @var ?AddressingResult[]
     */
    protected $AddressingResult = null;

    /**
     * @param AddressingResult[] $AddressingResult
     */
    public function __construct(array $AddressingResult)
    {
        $this->AddressingResult = $AddressingResult;
    }

    /**
     * @return AddressingResult[]
     */
    public function getAddressingResult(): array
    {
        return $this->AddressingResult ?? [];
    }

    /**
     * @param AddressingResult[] $AddressingResult
     */
    public function setAddressingResult(array $AddressingResult): void
    {
        $this->AddressingResult = $AddressingResult;
    }
}
