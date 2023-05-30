<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi;

/**
 * The spec doesn't specify everything required for connecting to the SOAP service without custom
 * provider specific information. This interface provides these provider specific information.
 */
interface ApiProviderInterface
{
    /**
     * Returns the domains that are used by this provider, gets used to match the configured provider to
     * this instance.
     *
     * @return string[]
     */
    public function getDomains(): array;

    /**
     * Returns a URL path to the respective SOAP service, relative to the host, given
     * the SOAP operation name. Returns null in case the operation isn't implemented
     * or is unknown.
     */
    public function getPathForOperation(string $operation): ?string;

    /**
     * Can return extra options which get passed to stream_context_create(), like
     * special SSL options which are required for this particular provider.
     *
     * @see stream_context_create()
     */
    public function getStreamContextOptions(): array;
}
