<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Service;

use Dbp\Relay\CoreBundle\HealthCheck\CheckInterface;
use Dbp\Relay\CoreBundle\HealthCheck\CheckOptions;
use Dbp\Relay\CoreBundle\HealthCheck\CheckResult;

class HealthCheck implements CheckInterface
{
    public function __construct(
        private readonly DualDeliveryService $dualDeliveryService,
        private readonly DispatchService $dispatchService)
    {
    }

    public function getName(): string
    {
        return 'dispatch';
    }

    private function checkDbConnection(): CheckResult
    {
        $result = new CheckResult('Check if we can connect to the DB');

        try {
            $this->dispatchService->checkConnection();
        } catch (\Throwable $e) {
            $result->set(CheckResult::STATUS_FAILURE, $e->getMessage(), ['exception' => $e]);

            return $result;
        }
        $result->set(CheckResult::STATUS_SUCCESS);

        return $result;
    }

    public function checkDualDeliveryConnection(): CheckResult
    {
        $result = new CheckResult('Check if the dual delivery service works');

        $result->set(CheckResult::STATUS_SUCCESS);
        try {
            $this->dualDeliveryService->checkConnection();
        } catch (\Throwable $e) {
            $result->set(CheckResult::STATUS_FAILURE, $e->getMessage(), ['exception' => $e]);
        }

        return $result;
    }

    public function check(CheckOptions $options): array
    {
        return [$this->checkDualDeliveryConnection(), $this->checkDbConnection()];
    }
}
