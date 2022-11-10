<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class LocalFileReferenceType extends DocumentType
{
    /**
     * @var string
     */
    protected $File = null;

    /**
     * @param string $File
     */
    public function __construct($File)
    {
        $this->File = $File;
    }

    public function getFile(): string
    {
        return $this->File;
    }

    public function setFile(string $File): self
    {
        $this->File = $File;

        return $this;
    }
}
