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

    /**
     * @return bool
     */
    public function getPreCreateSendings()
    {
        return $this->PreCreateSendings;
    }

    /**
     * @param bool $PreCreateSendings
     *
     * @return MetaData
     */
    public function setPreCreateSendings($PreCreateSendings)
    {
        $this->PreCreateSendings = $PreCreateSendings;

        return $this;
    }
}
