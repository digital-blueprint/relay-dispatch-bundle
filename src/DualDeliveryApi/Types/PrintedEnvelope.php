<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class PrintedEnvelope
{
    /**
     * @var RsID
     */
    protected $RsID = null;

    /**
     * @var Spec_Info_Adr
     */
    protected $Spec_Info_Adr = null;

    /**
     * @var Spec_Info_Top
     */
    protected $Spec_Info_Top = null;

    /**
     * @var Spec_Info_Center
     */
    protected $Spec_Info_Center = null;

    /**
     * @var Spec_Info_Bottom
     */
    protected $Spec_Info_Bottom = null;

    /**
     * @var Name_Row
     */
    protected $Name_Row = null;

    /**
     * @var string
     */
    protected $Zustellverfuegung = null;

    /**
     * @var string
     */
    protected $ZustellverfuegungErgaenzung = null;

    /**
     * @param RsID             $RsID
     * @param Spec_Info_Adr    $Spec_Info_Adr
     * @param Spec_Info_Top    $Spec_Info_Top
     * @param Spec_Info_Center $Spec_Info_Center
     * @param Spec_Info_Bottom $Spec_Info_Bottom
     * @param Name_Row         $Name_Row
     * @param string           $Zustellverfuegung
     * @param string           $ZustellverfuegungErgaenzung
     */
    public function __construct($RsID, $Spec_Info_Adr, $Spec_Info_Top, $Spec_Info_Center, $Spec_Info_Bottom, $Name_Row, $Zustellverfuegung, $ZustellverfuegungErgaenzung)
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

    /**
     * @return RsID
     */
    public function getRsID()
    {
        return $this->RsID;
    }

    /**
     * @param RsID $RsID
     */
    public function setRsID($RsID): self
    {
        $this->RsID = $RsID;

        return $this;
    }

    /**
     * @return Spec_Info_Adr
     */
    public function getSpec_Info_Adr()
    {
        return $this->Spec_Info_Adr;
    }

    /**
     * @param Spec_Info_Adr $Spec_Info_Adr
     */
    public function setSpec_Info_Adr($Spec_Info_Adr): self
    {
        $this->Spec_Info_Adr = $Spec_Info_Adr;

        return $this;
    }

    /**
     * @return Spec_Info_Top
     */
    public function getSpec_Info_Top()
    {
        return $this->Spec_Info_Top;
    }

    /**
     * @param Spec_Info_Top $Spec_Info_Top
     */
    public function setSpec_Info_Top($Spec_Info_Top): self
    {
        $this->Spec_Info_Top = $Spec_Info_Top;

        return $this;
    }

    /**
     * @return Spec_Info_Center
     */
    public function getSpec_Info_Center()
    {
        return $this->Spec_Info_Center;
    }

    /**
     * @param Spec_Info_Center $Spec_Info_Center
     */
    public function setSpec_Info_Center($Spec_Info_Center): self
    {
        $this->Spec_Info_Center = $Spec_Info_Center;

        return $this;
    }

    /**
     * @return Spec_Info_Bottom
     */
    public function getSpec_Info_Bottom()
    {
        return $this->Spec_Info_Bottom;
    }

    /**
     * @param Spec_Info_Bottom $Spec_Info_Bottom
     */
    public function setSpec_Info_Bottom($Spec_Info_Bottom): self
    {
        $this->Spec_Info_Bottom = $Spec_Info_Bottom;

        return $this;
    }

    /**
     * @return Name_Row
     */
    public function getName_Row()
    {
        return $this->Name_Row;
    }

    /**
     * @param Name_Row $Name_Row
     */
    public function setName_Row($Name_Row): self
    {
        $this->Name_Row = $Name_Row;

        return $this;
    }

    public function getZustellverfuegung(): string
    {
        return $this->Zustellverfuegung;
    }

    public function setZustellverfuegung(string $Zustellverfuegung): self
    {
        $this->Zustellverfuegung = $Zustellverfuegung;

        return $this;
    }

    public function getZustellverfuegungErgaenzung(): string
    {
        return $this->ZustellverfuegungErgaenzung;
    }

    public function setZustellverfuegungErgaenzung(string $ZustellverfuegungErgaenzung): self
    {
        $this->ZustellverfuegungErgaenzung = $ZustellverfuegungErgaenzung;

        return $this;
    }
}
