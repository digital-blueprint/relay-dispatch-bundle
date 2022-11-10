<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ErrorsType
{
    /**
     * @var ErrorType[]
     */
    protected $Error = null;

    /**
     * @param ErrorType[] $Error
     */
    public function __construct($Error)
    {
        $this->Error[] = $Error;
    }

    /**
     * @return ErrorType[]
     */
    public function getError(): array
    {
        return $this->Error;
    }

    /**
     * @param ErrorType[] $Error
     */
    public function setError(array $Error): self
    {
        $this->Error = $Error;

        return $this;
    }
}
