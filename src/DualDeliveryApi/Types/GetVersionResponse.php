<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class GetVersionResponse
{
    /**
     * @var string
     */
    protected $Version = null;

    public function __construct(string $Version)
    {
        $this->Version = $Version;
    }

    public function getVersion(): string
    {
        return $this->Version;
    }

    public function setVersion(string $Version): void
    {
        $this->Version = $Version;
    }
}
