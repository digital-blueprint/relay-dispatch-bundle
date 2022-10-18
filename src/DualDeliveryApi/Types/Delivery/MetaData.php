<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Delivery;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DocumentClass;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\PrintParameter;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\ReferencesType;

class MetaData
{
    /**
     * @var string
     */
    protected $Subject = null;

    /**
     * @var token255
     */
    protected $AppDeliveryID = null;

    /**
     * @var string
     */
    protected $GZ = null;

    /**
     * @var token255
     */
    protected $MZSDeliveryID = null;

    /**
     * @var token255
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
     * @param token255       $AppDeliveryID
     * @param string         $GZ
     * @param token255       $MZSDeliveryID
     * @param token255       $DeliveryQuality
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

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->Subject;
    }

    /**
     * @param string $Subject
     *
     * @return MetaData
     */
    public function setSubject($Subject)
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
     *
     * @return MetaData
     */
    public function setAppDeliveryID($AppDeliveryID)
    {
        $this->AppDeliveryID = $AppDeliveryID;

        return $this;
    }

    /**
     * @return string
     */
    public function getGZ()
    {
        return $this->GZ;
    }

    /**
     * @param string $GZ
     *
     * @return MetaData
     */
    public function setGZ($GZ)
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
     *
     * @return MetaData
     */
    public function setMZSDeliveryID($MZSDeliveryID)
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
     *
     * @return MetaData
     */
    public function setDeliveryQuality($DeliveryQuality)
    {
        $this->DeliveryQuality = $DeliveryQuality;

        return $this;
    }

    /**
     * @return bool
     */
    public function getDeliveryConfirmation()
    {
        return $this->DeliveryConfirmation;
    }

    /**
     * @param bool $DeliveryConfirmation
     *
     * @return MetaData
     */
    public function setDeliveryConfirmation($DeliveryConfirmation)
    {
        $this->DeliveryConfirmation = $DeliveryConfirmation;

        return $this;
    }

    /**
     * @return DocumentClass
     */
    public function getDocumentClass()
    {
        return $this->DocumentClass;
    }

    /**
     * @param DocumentClass $DocumentClass
     *
     * @return MetaData
     */
    public function setDocumentClass($DocumentClass)
    {
        $this->DocumentClass = $DocumentClass;

        return $this;
    }

    /**
     * @return ReferencesType
     */
    public function getReferences()
    {
        return $this->References;
    }

    /**
     * @param ReferencesType $References
     *
     * @return MetaData
     */
    public function setReferences($References)
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

    /**
     * @return MetaData
     */
    public function setStartNotificationBefore(\DateTime $StartNotificationBefore)
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

    /**
     * @return MetaData
     */
    public function setDeliverBefore(\DateTime $DeliverBefore)
    {
        $this->DeliverBefore = $DeliverBefore->format(\DateTime::ATOM);

        return $this;
    }

    /**
     * @return PrintParameter
     */
    public function getPrintParameter()
    {
        return $this->PrintParameter;
    }

    /**
     * @param PrintParameter $PrintParameter
     *
     * @return MetaData
     */
    public function setPrintParameter($PrintParameter)
    {
        $this->PrintParameter = $PrintParameter;

        return $this;
    }
}
