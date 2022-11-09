<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Vendo;

/**
 * Also see zusemsg-2.1.0, page 21 ("Zustell-Metainformation").
 */
class DeliveryQuality
{
    /**
     * einfache Zustellung ohne Zustellnachweis.
     */
    public const NON_RSA = 'nonRSa';

    /**
     * einfache Zustellung ohne Zustellnachweis – nicht an Postbevollmächtigte
     * (Abholung durch Dritte unter Verwendung von Vollmachten ist NICHT möglich).
     */
    public const NON_RSA_PLUS = 'nonRSa+';

    /**
     * Nachweisliche Zustellung zu eigenen Handen mit Zustellnachweis.
     */
    public const RSA = 'RSa';

    /**
     * Nachweisliche Zustellung zu eigenen Handen mit Zustellnachweis – nicht an Postbevollmächtigte
     * (Abholung durch Dritte unter Verwendung von Vollmachten ist NICHT möglich).
     */
    public const RSA_PLUS = 'RSa+';

    /**
     * für Hybridrückscheinbrief.
     */
    public const RSB = 'RSb';

    /**
     * Druck Einschreiben.
     */
    public const RS = 'RS';
}
