<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Service;

use Dbp\Relay\CoreBundle\HealthCheck\CheckInterface;
use Dbp\Relay\CoreBundle\HealthCheck\CheckOptions;
use Dbp\Relay\CoreBundle\HealthCheck\CheckResult;

class HealthCheck implements CheckInterface
{
    /**
     * @var DualDeliveryService
     */
    private $dd;

    public function __construct(DualDeliveryService $dd)
    {
        $this->dd = $dd;
    }

    public function getName(): string
    {
        return 'dispatch';
    }

    public function check(CheckOptions $options): array
    {
        $result = new CheckResult('Check if the dual delivery service works');

        $result->set(CheckResult::STATUS_SUCCESS);
        try {
            $this->dd->checkConnection();
        } catch (\Throwable $e) {
            $result->set(CheckResult::STATUS_FAILURE, $e->getMessage(), ['exception' => $e]);
        }

        return [$result];
    }
}
