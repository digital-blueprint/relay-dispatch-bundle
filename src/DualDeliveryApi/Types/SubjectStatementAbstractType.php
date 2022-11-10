<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

abstract class SubjectStatementAbstractType extends StatementAbstractType
{
    /**
     * @var SubjectType
     */
    protected $Subject = null;

    /**
     * @param SubjectType $Subject
     */
    public function __construct($Subject)
    {
        $this->Subject = $Subject;
    }

    public function getSubject(): SubjectType
    {
        return $this->Subject;
    }

    public function setSubject(SubjectType $Subject): self
    {
        $this->Subject = $Subject;

        return $this;
    }
}
