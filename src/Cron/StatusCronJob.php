<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Cron;

use Dbp\Relay\CoreBundle\Cron\CronJobInterface;
use Dbp\Relay\CoreBundle\Cron\CronOptions;
use Dbp\Relay\DispatchBundle\Service\DispatchService;

class StatusCronJob implements CronJobInterface
{
    /**
     * @var DispatchService
     */
    private $dispatchService;

    public function __construct(DispatchService $dispatchService)
    {
        $this->dispatchService = $dispatchService;
    }

    public function getName(): string
    {
        return 'Dispatch status polling';
    }

    public function getInterval(): string
    {
        // Every 3h
        return '0 0,3,6,9,12,15,18,21 * * *';
//        return '* * * * *';
    }

    public function run(CronOptions $options): void
    {
        $this->dispatchService->doStatusRequests();
    }
}
