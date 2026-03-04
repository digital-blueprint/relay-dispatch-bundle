<?php

declare(strict_types=1);

use Dbp\Relay\DispatchBundle\Entity\RequestRecipient;
use PHPUnit\Framework\TestCase;

class RequestRecipientTest extends TestCase
{
    public function testGetBirthDateString(): void
    {
        $recipient = new RequestRecipient();
        $this->assertNull($recipient->getBirthDateString());

        $recipient->setBirthDate(new DateTimeImmutable('1980-01-01T00:00:00Z'));
        $this->assertSame('1980-01-01', $recipient->getBirthDateString());

        $recipient->setBirthDate(new DateTimeImmutable('1980-01-01T01:00:00+02:00'));
        $this->assertSame('1979-12-31', $recipient->getBirthDateString());
    }
}
