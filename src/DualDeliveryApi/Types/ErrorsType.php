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
    public function getError()
    {
        return $this->Error;
    }

    /**
     * @param ErrorType[] $Error
     *
     * @return ErrorsType
     */
    public function setError($Error)
    {
        $this->Error = $Error;

        return $this;
    }
}
