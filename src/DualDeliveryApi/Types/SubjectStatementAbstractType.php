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

    /**
     * @return SubjectType
     */
    public function getSubject()
    {
        return $this->Subject;
    }

    /**
     * @param SubjectType $Subject
     *
     * @return SubjectStatementAbstractType
     */
    public function setSubject($Subject)
    {
        $this->Subject = $Subject;

        return $this;
    }
}
