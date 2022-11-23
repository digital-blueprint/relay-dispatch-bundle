<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class ErrorsType
{
    /**
     * @var ?ErrorType[]
     */
    protected $Error = null;

    /**
     * @param ErrorType[] $Error
     */
    public function __construct(array $Error)
    {
        $this->Error = $Error;
    }

    /**
     * @return ErrorType[]
     */
    public function getError(): array
    {
        return $this->Error ?? [];
    }

    /**
     * @param ErrorType[] $Error
     */
    public function setError(array $Error): void
    {
        $this->Error = $Error;
    }
}
