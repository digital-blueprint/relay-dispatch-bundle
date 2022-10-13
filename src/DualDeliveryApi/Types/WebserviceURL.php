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

    /**
     * @return AnyURI
     */
    public function get_()
    {
        return $this->_;
    }

    /**
     * @param AnyURI $_
     *
     * @return WebserviceURL
     */
    public function set_($_)
    {
        $this->_ = $_;

        return $this;
    }

    /**
     * @return AnyURI
     */
    public function getAlternativeEmail()
    {
        return $this->AlternativeEmail;
    }

    /**
     * @param AnyURI $AlternativeEmail
     *
     * @return WebserviceURL
     */
    public function setAlternativeEmail($AlternativeEmail)
    {
        $this->AlternativeEmail = $AlternativeEmail;

        return $this;
    }
}
