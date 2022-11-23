<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

class ClassificationType
{
    /**
     * @var string
     */
    protected $_ = null;

    /**
     * @var string
     */
    protected $ClassificationSchema = null;

    /**
     * @param string $_
     * @param string $ClassificationSchema
     */
    public function __construct($_, $ClassificationSchema)
    {
        $this->_ = $_;
        $this->ClassificationSchema = $ClassificationSchema;
    }

    public function get_(): string
    {
        return $this->_;
    }

    public function set_(string $_): self
    {
        $this->_ = $_;

        return $this;
    }

    public function getClassificationSchema(): string
    {
        return $this->ClassificationSchema;
    }

    public function setClassificationSchema(string $ClassificationSchema): self
    {
        $this->ClassificationSchema = $ClassificationSchema;

        return $this;
    }
}
