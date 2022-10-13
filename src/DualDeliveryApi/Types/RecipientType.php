<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class RecipientType
{
    /**
     * @var PersonDataType
     */
    protected $RecipientData = null;

    /**
     * @var ParametersType
     */
    protected $Parameters = null;

    /**
     * @param PersonDataType $RecipientData
     * @param ParametersType $Parameters
     */
    public function __construct($RecipientData, $Parameters)
    {
        $this->RecipientData = $RecipientData;
        $this->Parameters = $Parameters;
    }

    /**
     * @return PersonDataType
     */
    public function getRecipientData()
    {
        return $this->RecipientData;
    }

    /**
     * @param PersonDataType $RecipientData
     *
     * @return RecipientType
     */
    public function setRecipientData($RecipientData)
    {
        $this->RecipientData = $RecipientData;

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
     * @return RecipientType
     */
    public function setParameters($Parameters)
    {
        $this->Parameters = $Parameters;

        return $this;
    }
}
