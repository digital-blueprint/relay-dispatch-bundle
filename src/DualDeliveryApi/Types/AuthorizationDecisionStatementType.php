<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class AuthorizationDecisionStatementType extends SubjectStatementAbstractType
{
    /**
     * @var ActionType
     */
    protected $Action = null;

    /**
     * @var EvidenceType
     */
    protected $Evidence = null;

    /**
     * @var AnyURI
     */
    protected $Resource = null;

    /**
     * @var DecisionType
     */
    protected $Decision = null;

    /**
     * @param SubjectType  $Subject
     * @param ActionType   $Action
     * @param EvidenceType $Evidence
     * @param AnyURI       $Resource
     * @param DecisionType $Decision
     */
    public function __construct($Subject, $Action, $Evidence, $Resource, $Decision)
    {
        parent::__construct($Subject);
        $this->Action = $Action;
        $this->Evidence = $Evidence;
        $this->Resource = $Resource;
        $this->Decision = $Decision;
    }

    /**
     * @return ActionType
     */
    public function getAction()
    {
        return $this->Action;
    }

    /**
     * @param ActionType $Action
     *
     * @return AuthorizationDecisionStatementType
     */
    public function setAction($Action)
    {
        $this->Action = $Action;

        return $this;
    }

    /**
     * @return EvidenceType
     */
    public function getEvidence()
    {
        return $this->Evidence;
    }

    /**
     * @param EvidenceType $Evidence
     *
     * @return AuthorizationDecisionStatementType
     */
    public function setEvidence($Evidence)
    {
        $this->Evidence = $Evidence;

        return $this;
    }

    /**
     * @return AnyURI
     */
    public function getResource()
    {
        return $this->Resource;
    }

    /**
     * @param AnyURI $Resource
     *
     * @return AuthorizationDecisionStatementType
     */
    public function setResource($Resource)
    {
        $this->Resource = $Resource;

        return $this;
    }

    /**
     * @return DecisionType
     */
    public function getDecision()
    {
        return $this->Decision;
    }

    /**
     * @param DecisionType $Decision
     *
     * @return AuthorizationDecisionStatementType
     */
    public function setDecision($Decision)
    {
        $this->Decision = $Decision;

        return $this;
    }
}
