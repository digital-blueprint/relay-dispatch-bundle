<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class AssertionType
{
    /**
     * @var ConditionsType
     */
    protected $Conditions = null;

    /**
     * @var AdviceType
     */
    protected $Advice = null;

    /**
     * @var StatementAbstractType
     */
    protected $Statement = null;

    /**
     * @var SubjectStatementAbstractType
     */
    protected $SubjectStatement = null;

    /**
     * @var AuthenticationStatementType
     */
    protected $AuthenticationStatement = null;

    /**
     * @var AuthorizationDecisionStatementType
     */
    protected $AuthorizationDecisionStatement = null;

    /**
     * @var AttributeStatementType
     */
    protected $AttributeStatement = null;

    /**
     * @var SignatureType
     */
    protected $Signature = null;

    /**
     * @var int
     */
    protected $MajorVersion = null;

    /**
     * @var int
     */
    protected $MinorVersion = null;

    /**
     * @var stringType
     */
    protected $AssertionID = null;

    /**
     * @var string
     */
    protected $Issuer = null;

    /**
     * @var \DateTime
     */
    protected $IssueInstant = null;

    /**
     * @param ConditionsType                     $Conditions
     * @param AdviceType                         $Advice
     * @param StatementAbstractType              $Statement
     * @param SubjectStatementAbstractType       $SubjectStatement
     * @param AuthenticationStatementType        $AuthenticationStatement
     * @param AuthorizationDecisionStatementType $AuthorizationDecisionStatement
     * @param AttributeStatementType             $AttributeStatement
     * @param SignatureType                      $Signature
     * @param int                                $MajorVersion
     * @param int                                $MinorVersion
     * @param IDType                             $AssertionID
     * @param string                             $Issuer
     */
    public function __construct($Conditions, $Advice, $Statement, $SubjectStatement, $AuthenticationStatement, $AuthorizationDecisionStatement, $AttributeStatement, $Signature, $MajorVersion, $MinorVersion, $AssertionID, $Issuer, \DateTime $IssueInstant)
    {
        $this->Conditions = $Conditions;
        $this->Advice = $Advice;
        $this->Statement = $Statement;
        $this->SubjectStatement = $SubjectStatement;
        $this->AuthenticationStatement = $AuthenticationStatement;
        $this->AuthorizationDecisionStatement = $AuthorizationDecisionStatement;
        $this->AttributeStatement = $AttributeStatement;
        $this->Signature = $Signature;
        $this->MajorVersion = $MajorVersion;
        $this->MinorVersion = $MinorVersion;
        $this->AssertionID = $AssertionID;
        $this->Issuer = $Issuer;
        $this->IssueInstant = $IssueInstant->format(\DateTime::ATOM);
    }

    /**
     * @return ConditionsType
     */
    public function getConditions()
    {
        return $this->Conditions;
    }

    /**
     * @param ConditionsType $Conditions
     *
     * @return AssertionType
     */
    public function setConditions($Conditions)
    {
        $this->Conditions = $Conditions;

        return $this;
    }

    /**
     * @return AdviceType
     */
    public function getAdvice()
    {
        return $this->Advice;
    }

    /**
     * @param AdviceType $Advice
     *
     * @return AssertionType
     */
    public function setAdvice($Advice)
    {
        $this->Advice = $Advice;

        return $this;
    }

    /**
     * @return StatementAbstractType
     */
    public function getStatement()
    {
        return $this->Statement;
    }

    /**
     * @param StatementAbstractType $Statement
     *
     * @return AssertionType
     */
    public function setStatement($Statement)
    {
        $this->Statement = $Statement;

        return $this;
    }

    /**
     * @return SubjectStatementAbstractType
     */
    public function getSubjectStatement()
    {
        return $this->SubjectStatement;
    }

    /**
     * @param SubjectStatementAbstractType $SubjectStatement
     *
     * @return AssertionType
     */
    public function setSubjectStatement($SubjectStatement)
    {
        $this->SubjectStatement = $SubjectStatement;

        return $this;
    }

    /**
     * @return AuthenticationStatementType
     */
    public function getAuthenticationStatement()
    {
        return $this->AuthenticationStatement;
    }

    /**
     * @param AuthenticationStatementType $AuthenticationStatement
     *
     * @return AssertionType
     */
    public function setAuthenticationStatement($AuthenticationStatement)
    {
        $this->AuthenticationStatement = $AuthenticationStatement;

        return $this;
    }

    /**
     * @return AuthorizationDecisionStatementType
     */
    public function getAuthorizationDecisionStatement()
    {
        return $this->AuthorizationDecisionStatement;
    }

    /**
     * @param AuthorizationDecisionStatementType $AuthorizationDecisionStatement
     *
     * @return AssertionType
     */
    public function setAuthorizationDecisionStatement($AuthorizationDecisionStatement)
    {
        $this->AuthorizationDecisionStatement = $AuthorizationDecisionStatement;

        return $this;
    }

    /**
     * @return AttributeStatementType
     */
    public function getAttributeStatement()
    {
        return $this->AttributeStatement;
    }

    /**
     * @param AttributeStatementType $AttributeStatement
     *
     * @return AssertionType
     */
    public function setAttributeStatement($AttributeStatement)
    {
        $this->AttributeStatement = $AttributeStatement;

        return $this;
    }

    /**
     * @return SignatureType
     */
    public function getSignature()
    {
        return $this->Signature;
    }

    /**
     * @param SignatureType $Signature
     *
     * @return AssertionType
     */
    public function setSignature($Signature)
    {
        $this->Signature = $Signature;

        return $this;
    }

    /**
     * @return int
     */
    public function getMajorVersion()
    {
        return $this->MajorVersion;
    }

    /**
     * @param int $MajorVersion
     *
     * @return AssertionType
     */
    public function setMajorVersion($MajorVersion)
    {
        $this->MajorVersion = $MajorVersion;

        return $this;
    }

    /**
     * @return int
     */
    public function getMinorVersion()
    {
        return $this->MinorVersion;
    }

    /**
     * @param int $MinorVersion
     *
     * @return AssertionType
     */
    public function setMinorVersion($MinorVersion)
    {
        $this->MinorVersion = $MinorVersion;

        return $this;
    }

    /**
     * @return stringType
     */
    public function getAssertionID()
    {
        return $this->AssertionID;
    }

    /**
     * @param IDType $AssertionID
     *
     * @return AssertionType
     */
    public function setAssertionID($AssertionID)
    {
        $this->AssertionID = $AssertionID;

        return $this;
    }

    /**
     * @return string
     */
    public function getIssuer()
    {
        return $this->Issuer;
    }

    /**
     * @param string $Issuer
     *
     * @return AssertionType
     */
    public function setIssuer($Issuer)
    {
        $this->Issuer = $Issuer;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getIssueInstant()
    {
        if ($this->IssueInstant === null) {
            return null;
        } else {
            try {
                return new \DateTime($this->IssueInstant);
            } catch (\Exception $e) {
                return false;
            }
        }
    }

    /**
     * @return AssertionType
     */
    public function setIssueInstant(\DateTime $IssueInstant)
    {
        $this->IssueInstant = $IssueInstant->format(\DateTime::ATOM);

        return $this;
    }
}
