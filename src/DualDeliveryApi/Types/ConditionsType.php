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

    /**
     * @return AudienceRestrictionConditionType
     */
    public function getAudienceRestrictionCondition()
    {
        return $this->AudienceRestrictionCondition;
    }

    /**
     * @param AudienceRestrictionConditionType $AudienceRestrictionCondition
     *
     * @return ConditionsType
     */
    public function setAudienceRestrictionCondition($AudienceRestrictionCondition)
    {
        $this->AudienceRestrictionCondition = $AudienceRestrictionCondition;

        return $this;
    }

    /**
     * @return ConditionAbstractType
     */
    public function getCondition()
    {
        return $this->Condition;
    }

    /**
     * @param ConditionAbstractType $Condition
     *
     * @return ConditionsType
     */
    public function setCondition($Condition)
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

    /**
     * @return ConditionsType
     */
    public function setNotBefore(\DateTime $NotBefore)
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

    /**
     * @return ConditionsType
     */
    public function setNotOnOrAfter(\DateTime $NotOnOrAfter)
    {
        $this->NotOnOrAfter = $NotOnOrAfter->format(\DateTime::ATOM);

        return $this;
    }
}
