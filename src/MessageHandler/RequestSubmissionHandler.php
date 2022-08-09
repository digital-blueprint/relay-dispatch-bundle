<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\MessageHandler;

use Dbp\Relay\DispatchBundle\Message\RequestSubmissionMessage;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class RequestSubmissionHandler implements MessageHandlerInterface
{
    private $api;

    public function __construct(DispatchService $api)
    {
        $this->api = $api;
    }

    public function __invoke(RequestSubmissionMessage $message)
    {
        $this->api->handleRequestSubmissionMessage($message);
    }
}
