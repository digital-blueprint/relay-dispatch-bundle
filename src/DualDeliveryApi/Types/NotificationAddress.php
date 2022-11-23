<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse\InternetAddressType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse\WebserviceURL;

class NotificationAddress
{
    /**
     * @var WebserviceURL
     */
    protected $WebserviceURL = null;

    /**
     * @var InternetAddressType
     */
    protected $Email = null;

    /**
     * @var string
     */
    protected $Type = null;

    /**
     * @param WebserviceURL       $WebserviceURL
     * @param InternetAddressType $Email
     * @param string              $Type
     */
    public function __construct($WebserviceURL, $Email, $Type)
    {
        $this->WebserviceURL = $WebserviceURL;
        $this->Email = $Email;
        $this->Type = $Type;
    }

    public function getWebserviceURL(): WebserviceURL
    {
        return $this->WebserviceURL;
    }

    public function setWebserviceURL(WebserviceURL $WebserviceURL): self
    {
        $this->WebserviceURL = $WebserviceURL;

        return $this;
    }

    public function getEmail(): InternetAddressType
    {
        return $this->Email;
    }

    public function setEmail(InternetAddressType $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getType(): string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }
}
