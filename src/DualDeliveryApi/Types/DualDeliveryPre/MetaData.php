<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPre;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\AdditionalMetaData;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\ApplicationID;
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
     * @var bool
     */
    protected $PreCreateSendings = null;

    /**
     * @param string             $AppDeliveryID
     * @param ApplicationID      $ApplicationID
     * @param AdditionalMetaData $AdditionalMetaData
     * @param bool               $TestCase
     * @param ProcessingProfile  $ProcessingProfile
     * @param bool               $Asynchronous
     * @param bool               $PreCreateSendings
     */
    public function __construct($AppDeliveryID, $ApplicationID = null, $AdditionalMetaData = null, $TestCase = null, $ProcessingProfile = null, $Asynchronous = null, $PreCreateSendings = null)
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

    public function getPreCreateSendings(): bool
    {
        return $this->PreCreateSendings;
    }

    public function setPreCreateSendings(bool $PreCreateSendings): self
    {
        $this->PreCreateSendings = $PreCreateSendings;

        return $this;
    }
}
