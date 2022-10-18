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
}
