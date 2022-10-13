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

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->File;
    }

    /**
     * @param string $File
     *
     * @return LocalFileReferenceType
     */
    public function setFile($File)
    {
        $this->File = $File;

        return $this;
    }
}
