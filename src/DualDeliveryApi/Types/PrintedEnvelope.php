<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class PrintedEnvelope
{
    /**
     * @var string
     */
    protected $RsID = null;

    /**
     * @var ?string
     */
    protected $Spec_Info_Adr = null;

    /**
     * @var ?string
     */
    protected $Spec_Info_Top = null;

    /**
     * @var ?string
     */
    protected $Spec_Info_Center = null;

    /**
     * @var ?string
     */
    protected $Spec_Info_Bottom = null;

    /**
     * @var ?string
     */
    protected $Name_Row = null;

    /**
     * @var ?string
     */
    protected $Zustellverfuegung = null;

    /**
     * @var ?string
     */
    protected $ZustellverfuegungErgaenzung = null;

    public function __construct(?string $RsID, ?string $Spec_Info_Adr, ?string $Spec_Info_Top, ?string $Spec_Info_Center, ?string $Spec_Info_Bottom, ?string $Name_Row, ?string $Zustellverfuegung, ?string $ZustellverfuegungErgaenzung)
    {
        $this->RsID = $RsID;
        $this->Spec_Info_Adr = $Spec_Info_Adr;
        $this->Spec_Info_Top = $Spec_Info_Top;
        $this->Spec_Info_Center = $Spec_Info_Center;
        $this->Spec_Info_Bottom = $Spec_Info_Bottom;
        $this->Name_Row = $Name_Row;
        $this->Zustellverfuegung = $Zustellverfuegung;
        $this->ZustellverfuegungErgaenzung = $ZustellverfuegungErgaenzung;
    }

    public function getRsID(): ?string
    {
        return $this->RsID;
    }

    public function setRsID(string $RsID): void
    {
        $this->RsID = $RsID;
    }

    public function getSpec_Info_Adr(): ?string
    {
        return $this->Spec_Info_Adr;
    }

    public function setSpec_Info_Adr(string $Spec_Info_Adr): void
    {
        $this->Spec_Info_Adr = $Spec_Info_Adr;
    }

    public function getSpec_Info_Top(): ?string
    {
        return $this->Spec_Info_Top;
    }

    public function setSpec_Info_Top(string $Spec_Info_Top): void
    {
        $this->Spec_Info_Top = $Spec_Info_Top;
    }

    public function getSpec_Info_Center(): ?string
    {
        return $this->Spec_Info_Center;
    }

    public function setSpec_Info_Center(string $Spec_Info_Center): void
    {
        $this->Spec_Info_Center = $Spec_Info_Center;
    }

    public function getSpec_Info_Bottom(): ?string
    {
        return $this->Spec_Info_Bottom;
    }

    public function setSpec_Info_Bottom(string $Spec_Info_Bottom): void
    {
        $this->Spec_Info_Bottom = $Spec_Info_Bottom;
    }

    public function getName_Row(): ?string
    {
        return $this->Name_Row;
    }

    public function setName_Row(string $Name_Row): void
    {
        $this->Name_Row = $Name_Row;
    }

    public function getZustellverfuegung(): ?string
    {
        return $this->Zustellverfuegung;
    }

    public function setZustellverfuegung(string $Zustellverfuegung): void
    {
        $this->Zustellverfuegung = $Zustellverfuegung;
    }

    public function getZustellverfuegungErgaenzung(): ?string
    {
        return $this->ZustellverfuegungErgaenzung;
    }

    public function setZustellverfuegungErgaenzung(string $ZustellverfuegungErgaenzung): void
    {
        $this->ZustellverfuegungErgaenzung = $ZustellverfuegungErgaenzung;
    }
}
