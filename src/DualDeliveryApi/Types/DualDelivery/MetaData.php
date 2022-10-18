<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\AdditionalMetaData;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\ApplicationID;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Payments;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\ProcessingProfile;

class MetaData
{
    /**
     * @var string
     */
    protected $AppDeliveryID = null;

    /**
     * @var ApplicationID
     */
    protected $ApplicationID = null;

    /**
     * @var string
     */
    protected $DeliveryQuality = null;

    /**
     * @var string
     */
    protected $Subject = null;

    /**
     * @var string
     */
    protected $GZ = null;

    /**
     * @var Payments
     */
    protected $Payments = null;

    /**
     * @var AdditionalMetaData
     */
    protected $AdditionalMetaData = null;

    /**
     * @var bool
     */
    protected $TestCase = null;

    /**
     * @var ProcessingProfile
     */
    protected $ProcessingProfile = null;

    /**
     * @var string
     */
    protected $DocumentClass = null;

    /**
     * @var bool
     */
    protected $Asynchronous = null;

    /**
     * @var int
     */
    protected $BulkId = null;

    /**
     * @var string
     */
    protected $User = null;

    /**
     * @var string
     */
    protected $BillingToken = null;

    /**
     * @param string             $AppDeliveryID
     * @param ApplicationID      $ApplicationID
     * @param string             $DeliveryQuality
     * @param string             $Subject
     * @param string             $GZ
     * @param Payments           $Payments
     * @param AdditionalMetaData $AdditionalMetaData
     * @param bool               $TestCase
     * @param ProcessingProfile  $ProcessingProfile
     * @param string             $DocumentClass
     * @param bool               $Asynchronous
     * @param int                $BulkId
     * @param string             $User
     * @param string             $BillingToken
     */
    public function __construct($AppDeliveryID, $ApplicationID = null, $DeliveryQuality = null, $Subject = null, $GZ = null, $Payments = null, $AdditionalMetaData = null, $TestCase = null, $ProcessingProfile = null, $DocumentClass = null, $Asynchronous = null, $BulkId = null, $User = null, $BillingToken = null)
    {
        $this->AppDeliveryID = $AppDeliveryID;
        $this->ApplicationID = $ApplicationID;
        $this->DeliveryQuality = $DeliveryQuality;
        $this->Subject = $Subject;
        $this->GZ = $GZ;
        $this->Payments = $Payments;
        $this->AdditionalMetaData = $AdditionalMetaData;
        $this->TestCase = $TestCase;
        $this->ProcessingProfile = $ProcessingProfile;
        $this->DocumentClass = $DocumentClass;
        $this->Asynchronous = $Asynchronous;
        $this->BulkId = $BulkId;
        $this->User = $User;
        $this->BillingToken = $BillingToken;
    }

    /**
     * @return string
     */
    public function getAppDeliveryID()
    {
        return $this->AppDeliveryID;
    }

    /**
     * @param string $AppDeliveryID
     *
     * @return MetaData
     */
    public function setAppDeliveryID($AppDeliveryID)
    {
        $this->AppDeliveryID = $AppDeliveryID;

        return $this;
    }

    /**
     * @return ApplicationID
     */
    public function getApplicationID()
    {
        return $this->ApplicationID;
    }

    /**
     * @param ApplicationID $ApplicationID
     *
     * @return MetaData
     */
    public function setApplicationID($ApplicationID)
    {
        $this->ApplicationID = $ApplicationID;

        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryQuality()
    {
        return $this->DeliveryQuality;
    }

    /**
     * @param string $DeliveryQuality
     *
     * @return MetaData
     */
    public function setDeliveryQuality($DeliveryQuality)
    {
        $this->DeliveryQuality = $DeliveryQuality;

        return $this;
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
     * @return Payments
     */
    public function getPayments()
    {
        return $this->Payments;
    }

    /**
     * @param Payments $Payments
     *
     * @return MetaData
     */
    public function setPayments($Payments)
    {
        $this->Payments = $Payments;

        return $this;
    }

    /**
     * @return AdditionalMetaData
     */
    public function getAdditionalMetaData()
    {
        return $this->AdditionalMetaData;
    }

    /**
     * @param AdditionalMetaData $AdditionalMetaData
     *
     * @return MetaData
     */
    public function setAdditionalMetaData($AdditionalMetaData)
    {
        $this->AdditionalMetaData = $AdditionalMetaData;

        return $this;
    }

    /**
     * @return bool
     */
    public function getTestCase()
    {
        return $this->TestCase;
    }

    /**
     * @param bool $TestCase
     *
     * @return MetaData
     */
    public function setTestCase($TestCase)
    {
        $this->TestCase = $TestCase;

        return $this;
    }

    /**
     * @return ProcessingProfile
     */
    public function getProcessingProfile()
    {
        return $this->ProcessingProfile;
    }

    /**
     * @param ProcessingProfile $ProcessingProfile
     *
     * @return MetaData
     */
    public function setProcessingProfile($ProcessingProfile)
    {
        $this->ProcessingProfile = $ProcessingProfile;

        return $this;
    }

    /**
     * @return string
     */
    public function getDocumentClass()
    {
        return $this->DocumentClass;
    }

    /**
     * @param string $DocumentClass
     *
     * @return MetaData
     */
    public function setDocumentClass($DocumentClass)
    {
        $this->DocumentClass = $DocumentClass;

        return $this;
    }

    /**
     * @return bool
     */
    public function getAsynchronous()
    {
        return $this->Asynchronous;
    }

    /**
     * @param bool $Asynchronous
     *
     * @return MetaData
     */
    public function setAsynchronous($Asynchronous)
    {
        $this->Asynchronous = $Asynchronous;

        return $this;
    }

    /**
     * @return int
     */
    public function getBulkId()
    {
        return $this->BulkId;
    }

    /**
     * @param int $BulkId
     *
     * @return MetaData
     */
    public function setBulkId($BulkId)
    {
        $this->BulkId = $BulkId;

        return $this;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->User;
    }

    /**
     * @param string $User
     *
     * @return MetaData
     */
    public function setUser($User)
    {
        $this->User = $User;

        return $this;
    }

    /**
     * @return string
     */
    public function getBillingToken()
    {
        return $this->BillingToken;
    }

    /**
     * @param string $BillingToken
     *
     * @return MetaData
     */
    public function setBillingToken($BillingToken)
    {
        $this->BillingToken = $BillingToken;

        return $this;
    }
}
