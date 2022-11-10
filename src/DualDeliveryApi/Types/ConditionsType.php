<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ConditionsType
{
    /**
     * @var AudienceRestrictionConditionType
     */
    protected $AudienceRestrictionCondition = null;

    /**
     * @var ConditionAbstractType
     */
    protected $Condition = null;

    /**
     * @var \DateTime
     */
    protected $NotBefore = null;

    /**
     * @var \DateTime
     */
    protected $NotOnOrAfter = null;

    /**
     * @param AudienceRestrictionConditionType $AudienceRestrictionCondition
     * @param ConditionAbstractType            $Condition
     */
    public function __construct($AudienceRestrictionCondition, $Condition, \DateTime $NotBefore, \DateTime $NotOnOrAfter)
    {
        $this->AudienceRestrictionCondition = $AudienceRestrictionCondition;
        $this->Condition = $Condition;
        $this->NotBefore = $NotBefore->format(\DateTime::ATOM);
        $this->NotOnOrAfter = $NotOnOrAfter->format(\DateTime::ATOM);
    }

    public function getAudienceRestrictionCondition(): AudienceRestrictionConditionType
    {
        return $this->AudienceRestrictionCondition;
    }

    public function setAudienceRestrictionCondition(AudienceRestrictionConditionType $AudienceRestrictionCondition): self
    {
        $this->AudienceRestrictionCondition = $AudienceRestrictionCondition;

        return $this;
    }

    public function getCondition(): ConditionAbstractType
    {
        return $this->Condition;
    }

    public function setCondition(ConditionAbstractType $Condition): self
    {
        $this->Condition = $Condition;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getNotBefore()
    {
        if ($this->NotBefore === null) {
            return null;
        } else {
            try {
                return new \DateTime($this->NotBefore);
            } catch (\Exception $e) {
                return false;
            }
        }
    }

    public function setNotBefore(\DateTime $NotBefore): self
    {
        $this->NotBefore = $NotBefore->format(\DateTime::ATOM);

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getNotOnOrAfter()
    {
        if ($this->NotOnOrAfter === null) {
            return null;
        } else {
            try {
                return new \DateTime($this->NotOnOrAfter);
            } catch (\Exception $e) {
                return false;
            }
        }
    }

    public function setNotOnOrAfter(\DateTime $NotOnOrAfter): self
    {
        $this->NotOnOrAfter = $NotOnOrAfter->format(\DateTime::ATOM);

        return $this;
    }
}
