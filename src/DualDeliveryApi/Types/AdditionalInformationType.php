<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class AdditionalInformationType
{
    /**
     * @var AlphaNumType
     */
    protected $SerialNumber = null;

    /**
     * @var AlphaNumType
     */
    protected $ChargeNumber = null;

    /**
     * @var ClassificationType
     */
    protected $Classification = null;

    /**
     * @var UnitType
     */
    protected $AlternativeQuantity = null;

    /**
     * @var AlphaNumType
     */
    protected $Size = null;

    /**
     * @var UnitType
     */
    protected $Weight = null;

    /**
     * @var int
     */
    protected $Boxes = null;

    /**
     * @var string
     */
    protected $Color = null;

    /**
     * @param AlphaNumType       $SerialNumber
     * @param AlphaNumType       $ChargeNumber
     * @param ClassificationType $Classification
     * @param UnitType           $AlternativeQuantity
     * @param AlphaNumType       $Size
     * @param UnitType           $Weight
     * @param int                $Boxes
     * @param string             $Color
     */
    public function __construct($SerialNumber, $ChargeNumber, $Classification, $AlternativeQuantity, $Size, $Weight, $Boxes, $Color)
    {
        $this->SerialNumber = $SerialNumber;
        $this->ChargeNumber = $ChargeNumber;
        $this->Classification = $Classification;
        $this->AlternativeQuantity = $AlternativeQuantity;
        $this->Size = $Size;
        $this->Weight = $Weight;
        $this->Boxes = $Boxes;
        $this->Color = $Color;
    }

    /**
     * @return AlphaNumType
     */
    public function getSerialNumber()
    {
        return $this->SerialNumber;
    }

    /**
     * @param AlphaNumType $SerialNumber
     *
     * @return AdditionalInformationType
     */
    public function setSerialNumber($SerialNumber)
    {
        $this->SerialNumber = $SerialNumber;

        return $this;
    }

    /**
     * @return AlphaNumType
     */
    public function getChargeNumber()
    {
        return $this->ChargeNumber;
    }

    /**
     * @param AlphaNumType $ChargeNumber
     *
     * @return AdditionalInformationType
     */
    public function setChargeNumber($ChargeNumber)
    {
        $this->ChargeNumber = $ChargeNumber;

        return $this;
    }

    /**
     * @return ClassificationType
     */
    public function getClassification()
    {
        return $this->Classification;
    }

    /**
     * @param ClassificationType $Classification
     *
     * @return AdditionalInformationType
     */
    public function setClassification($Classification)
    {
        $this->Classification = $Classification;

        return $this;
    }

    /**
     * @return UnitType
     */
    public function getAlternativeQuantity()
    {
        return $this->AlternativeQuantity;
    }

    /**
     * @param UnitType $AlternativeQuantity
     *
     * @return AdditionalInformationType
     */
    public function setAlternativeQuantity($AlternativeQuantity)
    {
        $this->AlternativeQuantity = $AlternativeQuantity;

        return $this;
    }

    /**
     * @return AlphaNumType
     */
    public function getSize()
    {
        return $this->Size;
    }

    /**
     * @param AlphaNumType $Size
     *
     * @return AdditionalInformationType
     */
    public function setSize($Size)
    {
        $this->Size = $Size;

        return $this;
    }

    /**
     * @return UnitType
     */
    public function getWeight()
    {
        return $this->Weight;
    }

    /**
     * @param UnitType $Weight
     *
     * @return AdditionalInformationType
     */
    public function setWeight($Weight)
    {
        $this->Weight = $Weight;

        return $this;
    }

    /**
     * @return int
     */
    public function getBoxes()
    {
        return $this->Boxes;
    }

    /**
     * @param int $Boxes
     *
     * @return AdditionalInformationType
     */
    public function setBoxes($Boxes)
    {
        $this->Boxes = $Boxes;

        return $this;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->Color;
    }

    /**
     * @param string $Color
     *
     * @return AdditionalInformationType
     */
    public function setColor($Color)
    {
        $this->Color = $Color;

        return $this;
    }
}
