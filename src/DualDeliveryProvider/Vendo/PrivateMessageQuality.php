<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryProvider\Vendo;

/**
 * Also see zusemsg-2.1.0, page 22 ("Zustell-Metainformation").
 */
class PrivateMessageQuality
{
    /**
     * Information mailing / direct mail.
     */
    public const INFORMATION = 'Information';

    /**
     * Nicht-nachweisliche Zusendung.
     */
    public const REGISTERED_MAIL = 'RegisteredMail';

    /**
     * Nicht-nachweisliche Zusendung– nicht an Postbevollmächtigte
     * (Abholung durch Dritte unter Verwendung von Vollmachten ist NICHT möglich).
     */
    public const REGISTERED_MAIL_PLUS = 'RegisteredMail+';

    /**
     * Nachweisliche Zusendung.
     */
    public const CONFIRM_RECEIPT = 'ConfirmReceipt';

    /**
     * Nachweisliche Zusendung– nicht an Postbevollmächtigte
     * (Abholung durch Dritte unter Verwendung von Vollmachten ist NICHT möglich).
     */
    public const CONFIRM_RECEIPT_PLUS = 'ConfirmReceipt+';
}
