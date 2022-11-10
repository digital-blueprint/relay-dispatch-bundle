<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class PostalNotificationType extends NotificationChannelSetType
{
    /**
     * @var Pages
     */
    protected $Pages = null;

    /**
     * @var \DateTime
     */
    protected $Printtime = null;

    /**
     * @var PrintType
     */
    protected $PrintType = null;

    /**
     * @var Weight
     */
    protected $Weight = null;

    /**
     * @var EnvelopeType
     */
    protected $EnvelopeType = null;

    /**
     * @var \DateTime
     */
    protected $PostalDeliveryTime = null;

    /**
     * @var \DateTime
     */
    protected $ServiceDeliveryTime = null;

    /**
     * @var Sheets
     */
    protected $Sheets = null;

    /**
     * @var PaymentForms
     */
    protected $PaymentForms = null;

    /**
     * @var Costs
     */
    protected $Costs = null;

    /**
     * @var AdditonalPrintResults
     */
    protected $AdditonalPrintResults = null;

    /**
     * @var DelivererInformation
     */
    protected $DelivererInformation = null;

    /**
     * @var ScannedData
     */
    protected $ScannedData = null;

    /**
     * @param AdditonalPrintResults $AdditonalPrintResults
     */
    public function __construct($AdditonalPrintResults)
    {
        $this->AdditonalPrintResults = $AdditonalPrintResults;
    }

    /**
     * @return Pages
     */
    public function getPages()
    {
        return $this->Pages;
    }

    /**
     * @param Pages $Pages
     */
    public function setPages($Pages): self
    {
        $this->Pages = $Pages;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPrinttime()
    {
        if ($this->Printtime === null) {
            return null;
        } else {
            try {
                return new \DateTime($this->Printtime);
            } catch (\Exception $e) {
                return false;
            }
        }
    }

    /**
     * @param \DateTime $Printtime
     */
    public function setPrinttime(\DateTime $Printtime = null): self
    {
        if ($Printtime === null) {
            $this->Printtime = null;
        } else {
            $this->Printtime = $Printtime->format(\DateTime::ATOM);
        }

        return $this;
    }

    /**
     * @return PrintType
     */
    public function getPrintType()
    {
        return $this->PrintType;
    }

    /**
     * @param PrintType $PrintType
     */
    public function setPrintType($PrintType): self
    {
        $this->PrintType = $PrintType;

        return $this;
    }

    /**
     * @return Weight
     */
    public function getWeight()
    {
        return $this->Weight;
    }

    /**
     * @param Weight $Weight
     */
    public function setWeight($Weight): self
    {
        $this->Weight = $Weight;

        return $this;
    }

    /**
     * @return EnvelopeType
     */
    public function getEnvelopeType()
    {
        return $this->EnvelopeType;
    }

    /**
     * @param EnvelopeType $EnvelopeType
     */
    public function setEnvelopeType($EnvelopeType): self
    {
        $this->EnvelopeType = $EnvelopeType;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPostalDeliveryTime()
    {
        if ($this->PostalDeliveryTime === null) {
            return null;
        } else {
            try {
                return new \DateTime($this->PostalDeliveryTime);
            } catch (\Exception $e) {
                return false;
            }
        }
    }

    /**
     * @param \DateTime $PostalDeliveryTime
     */
    public function setPostalDeliveryTime(\DateTime $PostalDeliveryTime = null): self
    {
        if ($PostalDeliveryTime === null) {
            $this->PostalDeliveryTime = null;
        } else {
            $this->PostalDeliveryTime = $PostalDeliveryTime->format(\DateTime::ATOM);
        }

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getServiceDeliveryTime()
    {
        if ($this->ServiceDeliveryTime === null) {
            return null;
        } else {
            try {
                return new \DateTime($this->ServiceDeliveryTime);
            } catch (\Exception $e) {
                return false;
            }
        }
    }

    /**
     * @param \DateTime $ServiceDeliveryTime
     */
    public function setServiceDeliveryTime(\DateTime $ServiceDeliveryTime = null): self
    {
        if ($ServiceDeliveryTime === null) {
            $this->ServiceDeliveryTime = null;
        } else {
            $this->ServiceDeliveryTime = $ServiceDeliveryTime->format(\DateTime::ATOM);
        }

        return $this;
    }

    /**
     * @return Sheets
     */
    public function getSheets()
    {
        return $this->Sheets;
    }

    /**
     * @param Sheets $Sheets
     */
    public function setSheets($Sheets): self
    {
        $this->Sheets = $Sheets;

        return $this;
    }

    /**
     * @return PaymentForms
     */
    public function getPaymentForms()
    {
        return $this->PaymentForms;
    }

    /**
     * @param PaymentForms $PaymentForms
     */
    public function setPaymentForms($PaymentForms): self
    {
        $this->PaymentForms = $PaymentForms;

        return $this;
    }

    public function getCosts(): Costs
    {
        return $this->Costs;
    }

    public function setCosts(Costs $Costs): self
    {
        $this->Costs = $Costs;

        return $this;
    }

    public function getAdditonalPrintResults(): AdditonalPrintResults
    {
        return $this->AdditonalPrintResults;
    }

    public function setAdditonalPrintResults(AdditonalPrintResults $AdditonalPrintResults): self
    {
        $this->AdditonalPrintResults = $AdditonalPrintResults;

        return $this;
    }

    public function getDelivererInformation(): DelivererInformation
    {
        return $this->DelivererInformation;
    }

    public function setDelivererInformation(DelivererInformation $DelivererInformation): self
    {
        $this->DelivererInformation = $DelivererInformation;

        return $this;
    }

    public function getScannedData(): ScannedData
    {
        return $this->ScannedData;
    }

    public function setScannedData(ScannedData $ScannedData): self
    {
        $this->ScannedData = $ScannedData;

        return $this;
    }
}
