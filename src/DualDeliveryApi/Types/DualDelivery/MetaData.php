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

    public function getAppDeliveryID(): string
    {
        return $this->AppDeliveryID;
    }

    public function setAppDeliveryID(string $AppDeliveryID): self
    {
        $this->AppDeliveryID = $AppDeliveryID;

        return $this;
    }

    public function getApplicationID(): ApplicationID
    {
        return $this->ApplicationID;
    }

    public function setApplicationID(ApplicationID $ApplicationID): self
    {
        $this->ApplicationID = $ApplicationID;

        return $this;
    }

    public function getDeliveryQuality(): string
    {
        return $this->DeliveryQuality;
    }

    public function setDeliveryQuality(string $DeliveryQuality): self
    {
        $this->DeliveryQuality = $DeliveryQuality;

        return $this;
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

    public function getGZ(): string
    {
        return $this->GZ;
    }

    public function setGZ(string $GZ): self
    {
        $this->GZ = $GZ;

        return $this;
    }

    public function getPayments(): Payments
    {
        return $this->Payments;
    }

    public function setPayments(Payments $Payments): self
    {
        $this->Payments = $Payments;

        return $this;
    }

    public function getAdditionalMetaData(): AdditionalMetaData
    {
        return $this->AdditionalMetaData;
    }

    public function setAdditionalMetaData(AdditionalMetaData $AdditionalMetaData): self
    {
        $this->AdditionalMetaData = $AdditionalMetaData;

        return $this;
    }

    public function getTestCase(): bool
    {
        return $this->TestCase;
    }

    public function setTestCase(bool $TestCase): self
    {
        $this->TestCase = $TestCase;

        return $this;
    }

    public function getProcessingProfile(): ProcessingProfile
    {
        return $this->ProcessingProfile;
    }

    public function setProcessingProfile(ProcessingProfile $ProcessingProfile): self
    {
        $this->ProcessingProfile = $ProcessingProfile;

        return $this;
    }

    public function getDocumentClass(): string
    {
        return $this->DocumentClass;
    }

    public function setDocumentClass(string $DocumentClass): self
    {
        $this->DocumentClass = $DocumentClass;

        return $this;
    }

    public function getAsynchronous(): bool
    {
        return $this->Asynchronous;
    }

    public function setAsynchronous(bool $Asynchronous): self
    {
        $this->Asynchronous = $Asynchronous;

        return $this;
    }

    public function getBulkId(): int
    {
        return $this->BulkId;
    }

    public function setBulkId(int $BulkId): self
    {
        $this->BulkId = $BulkId;

        return $this;
    }

    public function getUser(): string
    {
        return $this->User;
    }

    public function setUser(string $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getBillingToken(): string
    {
        return $this->BillingToken;
    }

    public function setBillingToken(string $BillingToken): self
    {
        $this->BillingToken = $BillingToken;

        return $this;
    }
}
