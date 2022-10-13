<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class AuthenticationStatementType extends SubjectStatementAbstractType
{
    /**
     * @var SubjectLocalityType
     */
    protected $SubjectLocality = null;

    /**
     * @var AuthorityBindingType
     */
    protected $AuthorityBinding = null;

    /**
     * @var AnyURI
     */
    protected $AuthenticationMethod = null;

    /**
     * @var \DateTime
     */
    protected $AuthenticationInstant = null;

    /**
     * @param SubjectType          $Subject
     * @param SubjectLocalityType  $SubjectLocality
     * @param AuthorityBindingType $AuthorityBinding
     * @param AnyURI               $AuthenticationMethod
     */
    public function __construct($Subject, $SubjectLocality, $AuthorityBinding, $AuthenticationMethod, \DateTime $AuthenticationInstant)
    {
        parent::__construct($Subject);
        $this->SubjectLocality = $SubjectLocality;
        $this->AuthorityBinding = $AuthorityBinding;
        $this->AuthenticationMethod = $AuthenticationMethod;
        $this->AuthenticationInstant = $AuthenticationInstant->format(\DateTime::ATOM);
    }

    /**
     * @return SubjectLocalityType
     */
    public function getSubjectLocality()
    {
        return $this->SubjectLocality;
    }

    /**
     * @param SubjectLocalityType $SubjectLocality
     *
     * @return AuthenticationStatementType
     */
    public function setSubjectLocality($SubjectLocality)
    {
        $this->SubjectLocality = $SubjectLocality;

        return $this;
    }

    /**
     * @return AuthorityBindingType
     */
    public function getAuthorityBinding()
    {
        return $this->AuthorityBinding;
    }

    /**
     * @param AuthorityBindingType $AuthorityBinding
     *
     * @return AuthenticationStatementType
     */
    public function setAuthorityBinding($AuthorityBinding)
    {
        $this->AuthorityBinding = $AuthorityBinding;

        return $this;
    }

    /**
     * @return AnyURI
     */
    public function getAuthenticationMethod()
    {
        return $this->AuthenticationMethod;
    }

    /**
     * @param AnyURI $AuthenticationMethod
     *
     * @return AuthenticationStatementType
     */
    public function setAuthenticationMethod($AuthenticationMethod)
    {
        $this->AuthenticationMethod = $AuthenticationMethod;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getAuthenticationInstant()
    {
        if ($this->AuthenticationInstant === null) {
            return null;
        } else {
            try {
                return new \DateTime($this->AuthenticationInstant);
            } catch (\Exception $e) {
                return false;
            }
        }
    }

    /**
     * @return AuthenticationStatementType
     */
    public function setAuthenticationInstant(\DateTime $AuthenticationInstant)
    {
        $this->AuthenticationInstant = $AuthenticationInstant->format(\DateTime::ATOM);

        return $this;
    }
}
