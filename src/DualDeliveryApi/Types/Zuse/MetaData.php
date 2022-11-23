<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

class MetaData
{
    /**
     * @var string
     */
    protected $Subject = null;

    /**
     * @var string
     */
    protected $AppDeliveryID = null;

    /**
     * @var string
     */
    protected $GZ = null;

    /**
     * @var string
     */
    protected $MZSDeliveryID = null;

    /**
     * @var string
     */
    protected $DeliveryQuality = null;

    /**
     * @var bool
     */
    protected $DeliveryConfirmation = null;

    /**
     * @var DocumentClass
     */
    protected $DocumentClass = null;

    /**
     * @var ReferencesType
     */
    protected $References = null;

    /**
     * @var \DateTime
     */
    protected $StartNotificationBefore = null;

    /**
     * @var \DateTime
     */
    protected $DeliverBefore = null;

    /**
     * @var PrintParameter
     */
    protected $PrintParameter = null;

    /**
     * @param string         $Subject
     * @param string         $AppDeliveryID
     * @param string         $GZ
     * @param string         $MZSDeliveryID
     * @param string         $DeliveryQuality
     * @param bool           $DeliveryConfirmation
     * @param DocumentClass  $DocumentClass
     * @param ReferencesType $References
     * @param PrintParameter $PrintParameter
     */
    public function __construct($Subject, $AppDeliveryID, $GZ, $MZSDeliveryID, $DeliveryQuality, $DeliveryConfirmation, $DocumentClass, $References, \DateTime $StartNotificationBefore, \DateTime $DeliverBefore, $PrintParameter)
    {
        $this->Subject = $Subject;
        $this->AppDeliveryID = $AppDeliveryID;
        $this->GZ = $GZ;
        $this->MZSDeliveryID = $MZSDeliveryID;
        $this->DeliveryQuality = $DeliveryQuality;
        $this->DeliveryConfirmation = $DeliveryConfirmation;
        $this->DocumentClass = $DocumentClass;
        $this->References = $References;
        $this->StartNotificationBefore = $StartNotificationBefore->format(\DateTime::ATOM);
        $this->DeliverBefore = $DeliverBefore->format(\DateTime::ATOM);
        $this->PrintParameter = $PrintParameter;
    }

    public function getSubject(): string
    {
        return $this->Subject;
    }

    public function setSubject(string $Subject): self
    {
        $this->Subject = $Subject;

        return $this;
    }

    /**
     * @return token255
     */
    public function getAppDeliveryID()
    {
        return $this->AppDeliveryID;
    }

    /**
     * @param token255 $AppDeliveryID
     */
    public function setAppDeliveryID($AppDeliveryID): self
    {
        $this->AppDeliveryID = $AppDeliveryID;

        return $this;
    }

    public function getGZ(): string
    {
        return $this->GZ;
    }

    public function setGZ(string $GZ): self
    {
        $this->GZ = $GZ;

        return $this;
    }

    /**
     * @return token255
     */
    public function getMZSDeliveryID()
    {
        return $this->MZSDeliveryID;
    }

    /**
     * @param token255 $MZSDeliveryID
     */
    public function setMZSDeliveryID($MZSDeliveryID): self
    {
        $this->MZSDeliveryID = $MZSDeliveryID;

        return $this;
    }

    /**
     * @return token255
     */
    public function getDeliveryQuality()
    {
        return $this->DeliveryQuality;
    }

    /**
     * @param token255 $DeliveryQuality
     */
    public function setDeliveryQuality($DeliveryQuality): self
    {
        $this->DeliveryQuality = $DeliveryQuality;

        return $this;
    }

    public function getDeliveryConfirmation(): bool
    {
        return $this->DeliveryConfirmation;
    }

    public function setDeliveryConfirmation(bool $DeliveryConfirmation): self
    {
        $this->DeliveryConfirmation = $DeliveryConfirmation;

        return $this;
    }

    public function getDocumentClass(): DocumentClass
    {
        return $this->DocumentClass;
    }

    public function setDocumentClass(DocumentClass $DocumentClass): self
    {
        $this->DocumentClass = $DocumentClass;

        return $this;
    }

    public function getReferences(): ReferencesType
    {
        return $this->References;
    }

    public function setReferences(ReferencesType $References): self
    {
        $this->References = $References;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStartNotificationBefore()
    {
        if ($this->StartNotificationBefore === null) {
            return null;
        } else {
            try {
                return new \DateTime($this->StartNotificationBefore);
            } catch (\Exception $e) {
                return false;
            }
        }
    }

    public function setStartNotificationBefore(\DateTime $StartNotificationBefore): self
    {
        $this->StartNotificationBefore = $StartNotificationBefore->format(\DateTime::ATOM);

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDeliverBefore()
    {
        if ($this->DeliverBefore === null) {
            return null;
        } else {
            try {
                return new \DateTime($this->DeliverBefore);
            } catch (\Exception $e) {
                return false;
            }
        }
    }

    public function setDeliverBefore(\DateTime $DeliverBefore): self
    {
        $this->DeliverBefore = $DeliverBefore->format(\DateTime::ATOM);

        return $this;
    }

    public function getPrintParameter(): PrintParameter
    {
        return $this->PrintParameter;
    }

    public function setPrintParameter(PrintParameter $PrintParameter): self
    {
        $this->PrintParameter = $PrintParameter;

        return $this;
    }
}
