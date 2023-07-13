<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryProvider\Vendo;

class Vendo
{
    private const STATUS_APPLICATION_ID_NOT_FOUND = 20;

    /**
     * Addressierbarkeit wird geprüft.
     */
    private const STATUS_P1 = 21;

    /**
     * Datenanreicherung des Geschäftsfalles.
     */
    private const STATUS_P2 = 22;

    /**
     * Geschäftsfall wird zugestellt.
     */
    private const STATUS_P3 = 23;

    /**
     * Geschäftsfall teilweise zugestellt.
     *
     * Der Geschäftsfall wurde von der Applikation an den Zustellservice übertragen.
     * Keine Bestätigung vom Zustelldienst erhalten, ein erneuter Versuch erfolgt.
     */
    private const STATUS_P4 = 24;

    /**
     * Geschäftsfall erfolgreich übermittelt.
     *
     * Der Geschäftsfall wurde von der Applikation an den Zustellservice übertragen.
     */
    private const STATUS_P5 = 25;

    /**
     * Alle Nachweise erhalten von allen Kanälen.
     */
    private const STATUS_P6 = 26;

    /**
     * Geschäftfall wird verarbeitet.
     */
    private const STATUS_P7 = 27;

    /**
     * Empfänger konnte nicht ermittelt werden.
     *
     * negative Antwort vom zentralen Adressverzeichnis (Zustellkopf),
     * mit den übergebenen Informationen konnte keine eindeutige Person identifiziert werden
     */
    private const STATUS_P8 = 28;

    /**
     * Zustellung konnte nicht erfolgreich verarbeitet/zugestellt werden.
     *
     * Mögliche Gründe: fehlende Adressierungsmerkmale, keine Fristgerechte Antwort von Druckstrasse erhalten.
     */
    private const STATUS_P9 = 29;

    /**
     * Geschäftfall erfolgreich zugestellt.
     *
     * Geschäftsfall ist beim Empfängerpostfach am Zustelldienst hinterlegt bzw. von der Druckstrasse produziert worden.
     */
    private const STATUS_P10 = 30;

    /**
     * Nachweise befindet sich im Zulauf.
     */
    private const STATUS_P11 = 31;

    /**
     * Fehler aufgetreten, bitte kontaktieren Sie den Support.
     */
    private const STATUS_P12 = 32;

    public static function getStatusTypeDescription(int $status): string
    {
        // The P* codes are textual explanation for status code from DeliveryQuality_ProcessingProfile_Statuswerte_v1.1.0.xlsx
        $descriptions = [
            self::STATUS_APPLICATION_ID_NOT_FOUND => 'ApplicationID wurde nicht gefunden',
            self::STATUS_P1 => 'P1: Addressierbarkeit wird geprüft',
            self::STATUS_P2 => 'P2: Datenanreicherung des Geschäftsfalles',
            self::STATUS_P3 => 'P3: Geschäftsfall wird zugestellt',
            self::STATUS_P4 => "P4: Geschäftsfall teilweise zugestellt\nDer Geschäftsfall wurde von der Applikation an den Zustellservice übertragen. Keine Bestätigung vom Zustelldienst erhalten, ein erneuter Versuch erfolgt.",
            self::STATUS_P5 => "P5: Geschäftsfall erfolgreich übermittelt\nDer Geschäftsfall wurde von der Applikation an den Zustellservice übertragen.",
            self::STATUS_P6 => 'P6: Alle Nachweise erhalten von allen Kanälen',
            self::STATUS_P7 => 'P7: Geschäftfall wird verarbeitet',
            self::STATUS_P8 => "P8: Empfänger konnte nicht ermittelt werden\nnegative Antwort vom zentralen Adressverzeichnis (Zustellkopf), mit den übergebenen Informationen konnte keine eindeutige Person identifiziert werden",
            self::STATUS_P9 => "P9: Zustellung konnte nicht erfolgreich verarbeitet/zugestellt werden\nMögliche Gründe: fehlende Adressierungsmerkmale, keine Fristgerechte Antwort von Druckstrasse erhalten.",
            self::STATUS_P10 => "P10: Geschäftfall erfolgreich zugestellt\nGeschäftsfall ist beim Empfängerpostfach am Zustelldienst hinterlegt bzw. von der Druckstrasse produziert worden.",
            self::STATUS_P11 => 'P11: Nachweise befindet sich im Zulauf',
            self::STATUS_P12 => 'P12: Fehler aufgetreten, bitte kontaktieren Sie den Support',
        ];

        return $descriptions[$status] ?? '';
    }

    public static function isFailureStatus(int $status): bool
    {
        return in_array($status, [
            self::STATUS_APPLICATION_ID_NOT_FOUND,
            self::STATUS_P8,
            self::STATUS_P9,
            self::STATUS_P12,
        ], true);
    }

    public static function isSuccessStatus(int $status): bool
    {
        return in_array($status, [
            self::STATUS_P6,
            self::STATUS_P10,
        ], true);
    }

    public static function isPendingStatus(int $status): bool
    {
        return in_array($status, [
            self::STATUS_P1,
            self::STATUS_P2,
            self::STATUS_P3,
            self::STATUS_P4,
            self::STATUS_P5,
            self::STATUS_P7,
            self::STATUS_P11,
        ], true);
    }

    public static function isFinalStatus(int $status): bool
    {
        return in_array($status, [
            self::STATUS_APPLICATION_ID_NOT_FOUND,
            self::STATUS_P5,
            self::STATUS_P6,
            self::STATUS_P9,
            self::STATUS_P10,
            self::STATUS_P12,
        ], true);
    }

    public static function getStatusForCode(string $code): int
    {
        $statusType = 0;

        switch ($code) {
            case '17':
                $statusType = self::STATUS_APPLICATION_ID_NOT_FOUND;
                break;
            case 'P1':
                $statusType = self::STATUS_P1;
                break;
            case 'P2':
                $statusType = self::STATUS_P2;
                break;
            case 'P3':
                $statusType = self::STATUS_P3;
                break;
            case 'P4':
                $statusType = self::STATUS_P4;
                break;
            case 'P5':
                $statusType = self::STATUS_P5;
                break;
            case 'P6':
                $statusType = self::STATUS_P6;
                break;
            case 'P7':
                $statusType = self::STATUS_P7;
                break;
            case 'P8':
                $statusType = self::STATUS_P8;
                break;
            case 'P9':
                $statusType = self::STATUS_P9;
                break;
            case 'P10':
                $statusType = self::STATUS_P10;
                break;
            case 'P11':
                $statusType = self::STATUS_P11;
                break;
            case 'P12':
                $statusType = self::STATUS_P12;
                break;
        }

        return $statusType;
    }

    /**
     * Whether the GZ (MetaData::GZ) is valid. null means there is no GZ.
     */
    public static function isValidGZForSubmission(?string $gz): bool
    {
        // New information from Vendo 2023-01-16: A GZ is mandatory for postal delivery, max 25 chars
        if ($gz === null || trim($gz) === '') {
            return false;
        }
        if (mb_strlen($gz) > 25) {
            return false;
        }

        return true;
    }
}
