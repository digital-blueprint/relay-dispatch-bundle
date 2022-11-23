<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class LocalFileReferenceType extends DocumentType
{
    /**
     * @var string
     */
    protected $File = null;

    public function __construct(string $File)
    {
        $this->File = $File;
    }

    public function getFile(): string
    {
        return $this->File;
    }

    public function setFile(string $File): void
    {
        $this->File = $File;
    }
}
