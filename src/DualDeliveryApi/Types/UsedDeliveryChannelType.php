<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class UsedDeliveryChannelType
{
    /**
     * @var string
     */
    protected $Name = null;

    /**
     * @var StatusType
     */
    protected $Status = null;

    /**
     * @var ParametersType
     */
    protected $Parameters = null;

    /**
     * @var ErrorsType
     */
    protected $Errors = null;

    /**
     * @param string         $Name
     * @param StatusType     $Status
     * @param ParametersType $Parameters
     * @param ErrorsType     $Errors
     */
    public function __construct($Name, $Status, $Parameters, $Errors)
    {
        $this->Name = $Name;
        $this->Status = $Status;
        $this->Parameters = $Parameters;
        $this->Errors = $Errors;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * @param string $Name
     *
     * @return UsedDeliveryChannelType
     */
    public function setName($Name)
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * @return StatusType
     */
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * @param StatusType $Status
     *
     * @return UsedDeliveryChannelType
     */
    public function setStatus($Status)
    {
        $this->Status = $Status;

        return $this;
    }

    /**
     * @return ParametersType
     */
    public function getParameters()
    {
        return $this->Parameters;
    }

    /**
     * @param ParametersType $Parameters
     *
     * @return UsedDeliveryChannelType
     */
    public function setParameters($Parameters)
    {
        $this->Parameters = $Parameters;

        return $this;
    }

    /**
     * @return ErrorsType
     */
    public function getErrors()
    {
        return $this->Errors;
    }

    /**
     * @param ErrorsType $Errors
     *
     * @return UsedDeliveryChannelType
     */
    public function setErrors($Errors)
    {
        $this->Errors = $Errors;

        return $this;
    }
}
