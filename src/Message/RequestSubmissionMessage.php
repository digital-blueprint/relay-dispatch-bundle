<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Message;

use Dbp\Relay\DispatchBundle\Entity\Request;

class RequestSubmissionMessage
{
    /**
     * @var Request
     */
    private $request;

    /**
     * RequestSubmissionMessage constructor.
     */
    public function __construct(
        Request $request
    ) {
        $this->request = $request;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }
}
