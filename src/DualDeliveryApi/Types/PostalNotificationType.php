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
     *
     * @return PostalNotificationType
     */
    public function setPages($Pages)
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
     *
     * @return PostalNotificationType
     */
    public function setPrinttime(\DateTime $Printtime = null)
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
     *
     * @return PostalNotificationType
     */
    public function setPrintType($PrintType)
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
     *
     * @return PostalNotificationType
     */
    public function setWeight($Weight)
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
     *
     * @return PostalNotificationType
     */
    public function setEnvelopeType($EnvelopeType)
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
     *
     * @return PostalNotificationType
     */
    public function setPostalDeliveryTime(\DateTime $PostalDeliveryTime = null)
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
     *
     * @return PostalNotificationType
     */
    public function setServiceDeliveryTime(\DateTime $ServiceDeliveryTime = null)
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
     *
     * @return PostalNotificationType
     */
    public function setSheets($Sheets)
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
     *
     * @return PostalNotificationType
     */
    public function setPaymentForms($PaymentForms)
    {
        $this->PaymentForms = $PaymentForms;

        return $this;
    }

    /**
     * @return Costs
     */
    public function getCosts()
    {
        return $this->Costs;
    }

    /**
     * @param Costs $Costs
     *
     * @return PostalNotificationType
     */
    public function setCosts($Costs)
    {
        $this->Costs = $Costs;

        return $this;
    }

    /**
     * @return AdditonalPrintResults
     */
    public function getAdditonalPrintResults()
    {
        return $this->AdditonalPrintResults;
    }

    /**
     * @param AdditonalPrintResults $AdditonalPrintResults
     *
     * @return PostalNotificationType
     */
    public function setAdditonalPrintResults($AdditonalPrintResults)
    {
        $this->AdditonalPrintResults = $AdditonalPrintResults;

        return $this;
    }

    /**
     * @return DelivererInformation
     */
    public function getDelivererInformation()
    {
        return $this->DelivererInformation;
    }

    /**
     * @param DelivererInformation $DelivererInformation
     *
     * @return PostalNotificationType
     */
    public function setDelivererInformation($DelivererInformation)
    {
        $this->DelivererInformation = $DelivererInformation;

        return $this;
    }

    /**
     * @return ScannedData
     */
    public function getScannedData()
    {
        return $this->ScannedData;
    }

    /**
     * @param ScannedData $ScannedData
     *
     * @return PostalNotificationType
     */
    public function setScannedData($ScannedData)
    {
        $this->ScannedData = $ScannedData;

        return $this;
    }
}
