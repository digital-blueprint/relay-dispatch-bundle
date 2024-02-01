<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

class AdditionalInformationType
{
    /**
     * @var AlphaNumType
     */
    protected $SerialNumber;

    /**
     * @var AlphaNumType
     */
    protected $ChargeNumber;

    /**
     * @var ClassificationType
     */
    protected $Classification;

    /**
     * @var UnitType
     */
    protected $AlternativeQuantity;

    /**
     * @var AlphaNumType
     */
    protected $Size;

    /**
     * @var UnitType
     */
    protected $Weight;

    /**
     * @var int
     */
    protected $Boxes;

    /**
     * @var string
     */
    protected $Color;

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
     */
    public function setSerialNumber($SerialNumber): self
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
     */
    public function setChargeNumber($ChargeNumber): self
    {
        $this->ChargeNumber = $ChargeNumber;

        return $this;
    }

    public function getClassification(): ClassificationType
    {
        return $this->Classification;
    }

    public function setClassification(ClassificationType $Classification): self
    {
        $this->Classification = $Classification;

        return $this;
    }

    public function getAlternativeQuantity(): UnitType
    {
        return $this->AlternativeQuantity;
    }

    public function setAlternativeQuantity(UnitType $AlternativeQuantity): self
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
     */
    public function setSize($Size): self
    {
        $this->Size = $Size;

        return $this;
    }

    public function getWeight(): UnitType
    {
        return $this->Weight;
    }

    public function setWeight(UnitType $Weight): self
    {
        $this->Weight = $Weight;

        return $this;
    }

    public function getBoxes(): int
    {
        return $this->Boxes;
    }

    public function setBoxes(int $Boxes): self
    {
        $this->Boxes = $Boxes;

        return $this;
    }

    public function getColor(): string
    {
        return $this->Color;
    }

    public function setColor(string $Color): self
    {
        $this->Color = $Color;

        return $this;
    }
}
