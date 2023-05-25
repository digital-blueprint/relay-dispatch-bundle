<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryProvider\Vendo;

/**
 * All diese Profile werden sowohl für Zustellungen verwendet
 * sowie für natürliche und juristische Personen bzw. Organisationen.
 */
class ProcessingProfile
{
    /**
     * für die Duale Zustellung bei Hybriden Rückschein-Briefen.
     * D. h. zuerst wird versucht, ob eine behördliche elektronische Zustellung möglich ist.
     * Ist dies nicht möglich werden die Daten an die Druckstraße gesendet, gedruckt und postalisch versendet.
     *
     * Version: Standard=1.0, PreAddressing=1.1, Abroad=N/A
     */
    public const ZUSE_PRINT_HYBRID_DD = 'ZusePrintHybridDD';

    /**
     * Zustellung an KSB (Kommunikationssystem der Behörde).
     *
     * Version: Standard=1.0, PreAddressing=1.1, Abroad=N/A
     */
    public const ZUSE_KSB_DD = 'ZuseKsbDD';

    /**
     * Für die postalische Zustellung bei Hybriden Rückscheinbriefen.
     * Es wird keine elektronische Zustellung versucht, sondern die Daten sofort an die Druckstraße gesendet,
     * gedruckt und postalisch versendet.
     *
     * Version: Standard=1.0, PreAddressing=N/A, Abroad=1.1
     */
    public const PRINT_HYBRID_DD = 'PrintHybridDD';

    /**
     * Für die Daule Zustellung bei „normalen“ Schriftstücken.
     * D. h. zuerst wird versucht, ob eine elektronische Zustellung möglich ist.
     * Ist dies nicht möglich werden die Daten an die Druckstraße gesendet, gedruckt und postalisch versendet.
     *
     * Version: Standard=1.0, PreAddressing=1.1, Abroad=N/A
     */
    public const ZUSE_PRINT_DD = 'ZusePrintDD';

    /**
     * Für die Duale Zustellung bei „normalen“ Schriftstücken.
     * D. h. es wird versucht eine elektronische Zustellung durchzuführen.
     *
     * Version: Standard=1.0, PreAddressing=1.1, Abroad=N/A
     */
    public const ZUSE_DD = 'ZuseDD';

    /**
     * Die Daten werden an die Druckstraße gesendet, gedruckt und postalisch versendet.
     *
     * Version: Standard=1.0, PreAddressing=N/A, Abroad=N/A
     */
    public const PRINT_DD = 'PrintDD';

    // XXX: just to make clear that this is Vendo specific
    public const VERSION_STANDARD = '1.0';
    public const VERSION_PRE_ADDRESSING = '1.1';
    public const VERSION_ABROAD = '1.1';
}
