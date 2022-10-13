<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class SubjectType
{
    /**
     * @var NameIdentifierType
     */
    protected $NameIdentifier = null;

    /**
     * @var SubjectConfirmationType
     */
    protected $SubjectConfirmation = null;

    /**
     * @param NameIdentifierType      $NameIdentifier
     * @param SubjectConfirmationType $SubjectConfirmation
     */
    public function __construct($NameIdentifier, $SubjectConfirmation)
    {
        $this->NameIdentifier = $NameIdentifier;
        $this->SubjectConfirmation = $SubjectConfirmation;
    }

    /**
     * @return NameIdentifierType
     */
    public function getNameIdentifier()
    {
        return $this->NameIdentifier;
    }

    /**
     * @param NameIdentifierType $NameIdentifier
     *
     * @return SubjectType
     */
    public function setNameIdentifier($NameIdentifier)
    {
        $this->NameIdentifier = $NameIdentifier;

        return $this;
    }

    /**
     * @return SubjectConfirmationType
     */
    public function getSubjectConfirmation()
    {
        return $this->SubjectConfirmation;
    }

    /**
     * @param SubjectConfirmationType $SubjectConfirmation
     *
     * @return SubjectType
     */
    public function setSubjectConfirmation($SubjectConfirmation)
    {
        $this->SubjectConfirmation = $SubjectConfirmation;

        return $this;
    }
}
