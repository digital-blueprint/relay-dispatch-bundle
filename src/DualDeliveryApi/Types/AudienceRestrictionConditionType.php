<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class AudienceRestrictionConditionType extends ConditionAbstractType
{
    /**
     * @var AnyURI
     */
    protected $Audience = null;

    /**
     * @param AnyURI $Audience
     */
    public function __construct($Audience)
    {
        $this->Audience = $Audience;
    }

    /**
     * @return AnyURI
     */
    public function getAudience()
    {
        return $this->Audience;
    }

    /**
     * @param AnyURI $Audience
     *
     * @return AudienceRestrictionConditionType
     */
    public function setAudience($Audience)
    {
        $this->Audience = $Audience;

        return $this;
    }
}