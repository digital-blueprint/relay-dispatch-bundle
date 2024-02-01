<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressing;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\AdditionalMetaData;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\ApplicationID;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\ProcessingProfile;

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
     * @var ?bool
     */
    protected $Asynchronous;

    /**
     * @var ?bool
     */
    protected $PreCreateSendings;

    public function __construct(string $AppDeliveryID, ApplicationID $ApplicationID = null, AdditionalMetaData $AdditionalMetaData = null, bool $TestCase = null, ProcessingProfile $ProcessingProfile = null, bool $Asynchronous = null, bool $PreCreateSendings = null)
    {
        $this->AppDeliveryID = $AppDeliveryID;
        $this->ApplicationID = $ApplicationID;
        $this->AdditionalMetaData = $AdditionalMetaData;
        $this->TestCase = $TestCase;
        $this->ProcessingProfile = $ProcessingProfile;
        $this->Asynchronous = $Asynchronous;
        $this->PreCreateSendings = $PreCreateSendings;
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

    public function getAsynchronous(): ?bool
    {
        return $this->Asynchronous;
    }

    public function setAsynchronous(bool $Asynchronous): void
    {
        $this->Asynchronous = $Asynchronous;
    }

    public function getPreCreateSendings(): ?bool
    {
        return $this->PreCreateSendings;
    }

    public function setPreCreateSendings(bool $PreCreateSendings): void
    {
        $this->PreCreateSendings = $PreCreateSendings;
    }
}
