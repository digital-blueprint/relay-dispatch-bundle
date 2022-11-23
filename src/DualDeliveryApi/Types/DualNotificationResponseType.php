<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse\Success;

class DualNotificationResponseType
{
    /**
     * @var Success
     */
    protected $Success = null;

    /**
     * @var ErrorType
     */
    protected $Error = null;

    /**
     * @var string
     */
    protected $version = null;

    /**
     * @param Success   $Success
     * @param ErrorType $Error
     * @param string    $version
     */
    public function __construct($Success, $Error, $version)
    {
        $this->Success = $Success;
        $this->Error = $Error;
        $this->version = $version;
    }

    public function getSuccess(): Success
    {
        return $this->Success;
    }

    public function setSuccess(Success $Success): self
    {
        $this->Success = $Success;

        return $this;
    }

    public function getError(): ErrorType
    {
        return $this->Error;
    }

    public function setError(ErrorType $Error): self
    {
        $this->Error = $Error;

        return $this;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }
}
