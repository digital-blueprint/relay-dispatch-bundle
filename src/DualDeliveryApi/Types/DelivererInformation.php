<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class DelivererInformation
{
    /**
     * @var string
     */
    protected $Deliverer = null;

    /**
     * @var string
     */
    protected $DelivererReference = null;

    /**
     * @param string $Deliverer
     * @param string $DelivererReference
     */
    public function __construct($Deliverer, $DelivererReference)
    {
        $this->Deliverer = $Deliverer;
        $this->DelivererReference = $DelivererReference;
    }

    /**
     * @return string
     */
    public function getDeliverer()
    {
        return $this->Deliverer;
    }

    /**
     * @param string $Deliverer
     *
     * @return DelivererInformation
     */
    public function setDeliverer($Deliverer)
    {
        $this->Deliverer = $Deliverer;

        return $this;
    }

    /**
     * @return string
     */
    public function getDelivererReference()
    {
        return $this->DelivererReference;
    }

    /**
     * @param string $DelivererReference
     *
     * @return DelivererInformation
     */
    public function setDelivererReference($DelivererReference)
    {
        $this->DelivererReference = $DelivererReference;

        return $this;
    }
}
