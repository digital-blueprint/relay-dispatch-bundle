<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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

    /**
     * @return string
     */
    public function get_()
    {
        return $this->_;
    }

    /**
     * @param string $_
     *
     * @return ClassificationType
     */
    public function set_($_)
    {
        $this->_ = $_;

        return $this;
    }

    /**
     * @return string
     */
    public function getClassificationSchema()
    {
        return $this->ClassificationSchema;
    }

    /**
     * @param string $ClassificationSchema
     *
     * @return ClassificationType
     */
    public function setClassificationSchema($ClassificationSchema)
    {
        $this->ClassificationSchema = $ClassificationSchema;

        return $this;
    }
}
