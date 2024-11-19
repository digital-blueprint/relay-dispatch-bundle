<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Authorization;

use Dbp\Relay\CoreBundle\HealthCheck\CheckInterface;
use Dbp\Relay\CoreBundle\HealthCheck\CheckOptions;
use Dbp\Relay\CoreBundle\HealthCheck\CheckResult;

class HealthCheck implements CheckInterface
{
    public function __construct(private readonly AuthorizationService $authorizationService)
    {
    }

    public function getName(): string
    {
        return 'dispatch-authorization';
    }

    public function check(CheckOptions $options): array
    {
        $result = new CheckResult('Validate Dispatch access control policies');
        $result->set(CheckResult::STATUS_SUCCESS);
        try {
            $this->authorizationService->validateConfiguration();
        } catch (\Throwable $e) {
            $result->set(CheckResult::STATUS_FAILURE, $e->getMessage(), ['exception' => $e]);
        }

        return [$result];
    }
}
