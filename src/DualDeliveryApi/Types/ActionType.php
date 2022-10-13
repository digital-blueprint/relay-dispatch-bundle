<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ActionType
{
    /**
     * @var string
     */
    protected $_ = null;

    /**
     * @var AnyURI
     */
    protected $Namespace = null;

    /**
     * @param string $_
     * @param AnyURI $Namespace
     */
    public function __construct($_, $Namespace)
    {
        $this->_ = $_;
        $this->Namespace = $Namespace;
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
     * @return ActionType
     */
    public function set_($_)
    {
        $this->_ = $_;

        return $this;
    }

    /**
     * @return AnyURI
     */
    public function getNamespace()
    {
        return $this->Namespace;
    }

    /**
     * @param AnyURI $Namespace
     *
     * @return ActionType
     */
    public function setNamespace($Namespace)
    {
        $this->Namespace = $Namespace;

        return $this;
    }
}
