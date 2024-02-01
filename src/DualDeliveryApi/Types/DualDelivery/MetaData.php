<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class MetaData
{
    /**
     * @var string
     */
    protected $AppDeliveryID;

    /**
     * @var ?ApplicationID
     */
    protected $ApplicationID;

    /**
     * @var string
     */
    protected $DeliveryQuality;

    /**
     * @var ?string
     */
    protected $Subject;

    /**
     * Über dieses Element kann eine Geschäftszahl bzw. ein Geschäftskennzeichen
     * für Anzeige und Druck mitgegeben werden, welches eine leichtere Lesbarkeit auf
     * Ausdrucken bzw. Benachrichtigungen gewährleisten soll. Im Gegensatz zur
     * AppDeliveryID ist in diesem Fall die technische Eindeutigkeit über das duale
     * Zustellservice nicht zwingend erforderlich.
     *
     * @var ?string
     */
    protected $GZ;

    /**
     * @var ?Payments
     */
    protected $Payments;

    /**
     * @var ?AdditionalMetaData
     */
    protected $AdditionalMetaData;

    /**
     * @var ?bool
     */
    protected $TestCase;

    /**
     * @var ?ProcessingProfile
     */
    protected $ProcessingProfile;

    /**
     * @var ?string
     */
    protected $DocumentClass;

    /**
     * @var ?bool
     */
    protected $Asynchronous;

    /**
     * @var ?int
     */
    protected $BulkId;

    /**
     * @var ?string
     */
    protected $User;

    /**
     * @var ?string
     */
    protected $BillingToken;

    public function __construct(string $AppDeliveryID, ?ApplicationID $ApplicationID, string $DeliveryQuality, string $Subject = null, string $GZ = null, Payments $Payments = null, AdditionalMetaData $AdditionalMetaData = null, bool $TestCase = null, ProcessingProfile $ProcessingProfile = null, string $DocumentClass = null, bool $Asynchronous = null, int $BulkId = null, string $User = null, string $BillingToken = null)
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
