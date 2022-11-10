<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryBulk;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\AdditionalMetaData;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\ApplicationID;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\ProcessingProfile;

class MetaData
{
    /**
     * @var ApplicationID
     */
    protected $ApplicationID = null;

    /**
     * @var string
     */
    protected $GZ = null;

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
     * @var bool
     */
    protected $Asynchronous = null;

    /**
     * @param ApplicationID      $ApplicationID
     * @param string             $GZ
     * @param AdditionalMetaData $AdditionalMetaData
     * @param bool               $TestCase
     * @param ProcessingProfile  $ProcessingProfile
     * @param bool               $Asynchronous
     */
    public function __construct($ApplicationID, $GZ, $AdditionalMetaData, $TestCase, $ProcessingProfile, $Asynchronous)
    {
        $this->ApplicationID = $ApplicationID;
        $this->GZ = $GZ;
        $this->AdditionalMetaData = $AdditionalMetaData;
        $this->TestCase = $TestCase;
        $this->ProcessingProfile = $ProcessingProfile;
        $this->Asynchronous = $Asynchronous;
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

    public function getGZ(): string
    {
        return $this->GZ;
    }

    public function setGZ(string $GZ): self
    {
        $this->GZ = $GZ;

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

    public function getAsynchronous(): bool
    {
        return $this->Asynchronous;
    }

    public function setAsynchronous(bool $Asynchronous): self
    {
        $this->Asynchronous = $Asynchronous;

        return $this;
    }
}
