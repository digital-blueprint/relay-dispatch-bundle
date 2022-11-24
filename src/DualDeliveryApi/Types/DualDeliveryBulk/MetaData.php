<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryBulk;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\AdditionalMetaData;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\ApplicationID;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\ProcessingProfile;

class MetaData
{
    /**
     * @var ?ApplicationID
     */
    protected $ApplicationID = null;

    /**
     * @var ?string
     */
    protected $GZ = null;

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
     * @var ?bool
     */
    protected $Asynchronous = null;

    public function __construct(?ApplicationID $ApplicationID, ?string $GZ, ?AdditionalMetaData $AdditionalMetaData, ?bool $TestCase, ?ProcessingProfile $ProcessingProfile, ?bool $Asynchronous)
    {
        $this->ApplicationID = $ApplicationID;
        $this->GZ = $GZ;
        $this->AdditionalMetaData = $AdditionalMetaData;
        $this->TestCase = $TestCase;
        $this->ProcessingProfile = $ProcessingProfile;
        $this->Asynchronous = $Asynchronous;
    }

    public function getApplicationID(): ?ApplicationID
    {
        return $this->ApplicationID;
    }

    public function setApplicationID(ApplicationID $ApplicationID): void
    {
        $this->ApplicationID = $ApplicationID;
    }

    public function getGZ(): ?string
    {
        return $this->GZ;
    }

    public function setGZ(string $GZ): void
    {
        $this->GZ = $GZ;
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
}
