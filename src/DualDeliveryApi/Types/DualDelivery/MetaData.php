<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class MetaData
{
    /**
     * @var string
     */
    protected $AppDeliveryID = null;

    /**
     * @var ?ApplicationID
     */
    protected $ApplicationID = null;

    /**
     * @var string
     */
    protected $DeliveryQuality = null;

    /**
     * @var ?string
     */
    protected $Subject = null;

    /**
     * @var ?string
     */
    protected $GZ = null;

    /**
     * @var ?Payments
     */
    protected $Payments = null;

    /**
     * @var ?AdditionalMetaData
     */
    protected $AdditionalMetaData = null;

    /**
     * @var ?bool
     */
    protected $TestCase = null;

    /**
     * @var ?ProcessingProfile
     */
    protected $ProcessingProfile = null;

    /**
     * @var ?string
     */
    protected $DocumentClass = null;

    /**
     * @var ?bool
     */
    protected $Asynchronous = null;

    /**
     * @var ?int
     */
    protected $BulkId = null;

    /**
     * @var ?string
     */
    protected $User = null;

    /**
     * @var ?string
     */
    protected $BillingToken = null;

    public function __construct(string $AppDeliveryID, ?ApplicationID $ApplicationID, string $DeliveryQuality, ?string $Subject = null, ?string $GZ = null, ?Payments $Payments = null, ?AdditionalMetaData $AdditionalMetaData = null, ?bool $TestCase = null, ?ProcessingProfile $ProcessingProfile = null, ?string $DocumentClass = null, ?bool $Asynchronous = null, ?int $BulkId = null, ?string $User = null, ?string $BillingToken = null)
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

    public function setAppDeliveryID(string $AppDeliveryID): void
    {
        $this->AppDeliveryID = $AppDeliveryID;
    }

    public function getApplicationID(): ?ApplicationID
    {
        return $this->ApplicationID;
    }

    public function setApplicationID(ApplicationID $ApplicationID): void
    {
        $this->ApplicationID = $ApplicationID;
    }

    public function getDeliveryQuality(): string
    {
        return $this->DeliveryQuality;
    }

    public function setDeliveryQuality(string $DeliveryQuality): void
    {
        $this->DeliveryQuality = $DeliveryQuality;
    }

    public function getSubject(): ?string
    {
        return $this->Subject;
    }

    public function setSubject(string $Subject): void
    {
        $this->Subject = $Subject;
    }

    public function getGZ(): ?string
    {
        return $this->GZ;
    }

    public function setGZ(string $GZ): void
    {
        $this->GZ = $GZ;
    }

    public function getPayments(): ?Payments
    {
        return $this->Payments;
    }

    public function setPayments(Payments $Payments): void
    {
        $this->Payments = $Payments;
    }

    public function getAdditionalMetaData(): ?AdditionalMetaData
    {
        return $this->AdditionalMetaData;
    }

    public function setAdditionalMetaData(AdditionalMetaData $AdditionalMetaData): void
    {
        $this->AdditionalMetaData = $AdditionalMetaData;
    }

    public function getTestCase(): ?bool
    {
        return $this->TestCase;
    }

    public function setTestCase(bool $TestCase): void
    {
        $this->TestCase = $TestCase;
    }

    public function getProcessingProfile(): ?ProcessingProfile
    {
        return $this->ProcessingProfile;
    }

    public function setProcessingProfile(ProcessingProfile $ProcessingProfile): void
    {
        $this->ProcessingProfile = $ProcessingProfile;
    }

    public function getDocumentClass(): ?string
    {
        return $this->DocumentClass;
    }

    public function setDocumentClass(string $DocumentClass): void
    {
        $this->DocumentClass = $DocumentClass;
    }

    public function getAsynchronous(): ?bool
    {
        return $this->Asynchronous;
    }

    public function setAsynchronous(bool $Asynchronous): void
    {
        $this->Asynchronous = $Asynchronous;
    }

    public function getBulkId(): ?int
    {
        return $this->BulkId;
    }

    public function setBulkId(int $BulkId): void
    {
        $this->BulkId = $BulkId;
    }

    public function getUser(): ?string
    {
        return $this->User;
    }

    public function setUser(string $User): void
    {
        $this->User = $User;
    }

    public function getBillingToken(): ?string
    {
        return $this->BillingToken;
    }

    public function setBillingToken(string $BillingToken): void
    {
        $this->BillingToken = $BillingToken;
    }
}
