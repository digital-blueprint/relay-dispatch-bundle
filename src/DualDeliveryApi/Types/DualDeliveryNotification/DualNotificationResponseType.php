<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\ErrorType;

class DualNotificationResponseType
{
    /**
     * @var ?string
     */
    protected $Success;

    /**
     * @var ErrorType
     */
    protected $Error;

    /**
     * @var string
     */
    protected $version;

    public function __construct(?string $Success, ErrorType $Error, string $version)
    {
        $this->Success = $Success;
        $this->Error = $Error;
        $this->version = $version;
    }

    public function getSuccess(): ?string
    {
        return $this->Success;
    }

    public function setSuccess(string $Success): void
    {
        $this->Success = $Success;
    }

    public function getError(): ErrorType
    {
        return $this->Error;
    }

    public function setError(ErrorType $Error): void
    {
        $this->Error = $Error;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): void
    {
        $this->version = $version;
    }
}
