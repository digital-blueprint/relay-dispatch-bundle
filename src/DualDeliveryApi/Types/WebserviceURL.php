<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class WebserviceURL
{
    /**
     * @var AnyURI
     */
    protected $_ = null;

    /**
     * @var AnyURI
     */
    protected $AlternativeEmail = null;

    /**
     * @param AnyURI $_
     * @param AnyURI $AlternativeEmail
     */
    public function __construct($_, $AlternativeEmail)
    {
        $this->_ = $_;
        $this->AlternativeEmail = $AlternativeEmail;
    }

    public function get_(): AnyURI
    {
        return $this->_;
    }

    public function set_(AnyURI $_): self
    {
        $this->_ = $_;

        return $this;
    }

    public function getAlternativeEmail(): AnyURI
    {
        return $this->AlternativeEmail;
    }

    public function setAlternativeEmail(AnyURI $AlternativeEmail): self
    {
        $this->AlternativeEmail = $AlternativeEmail;

        return $this;
    }
}
