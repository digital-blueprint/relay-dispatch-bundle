<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\MessageHandler;

use Dbp\Relay\DispatchBundle\Message\RequestSubmissionMessage;
use Dbp\Relay\DispatchBundle\Service\DispatchService;

class RequestSubmissionHandler
{
    public function __construct(private readonly DispatchService $dispatchService)
    {
    }

    public function __invoke(RequestSubmissionMessage $message)
    {
        $this->dispatchService->handleRequestSubmissionMessage($message);
    }
}
