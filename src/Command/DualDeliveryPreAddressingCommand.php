<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Command;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\ErrorsType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\ParametersType;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class DualDeliveryPreAddressingCommand extends Command
{
    public function __construct(private readonly DispatchService $dispatchService)
    {
        parent::__construct();
    }

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName('dbp:relay:dispatch:dd:pre-addressing');
        $this
            ->setDescription('Does a pre-addressing request for a person')
            ->addArgument('given-name', InputArgument::REQUIRED, 'Given name of the person')
            ->addArgument('family-name', InputArgument::REQUIRED, 'Family name of the person')
            ->addArgument('birth-date', InputArgument::REQUIRED, 'Birth date of the person (YYYY-MM-DD)');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $givenName = $input->getArgument('given-name');
        $familyName = $input->getArgument('family-name');
        $birthDate = $input->getArgument('birth-date');

        $io = new SymfonyStyle($input, $output);

        $parsedBirthDate = \DateTimeImmutable::createFromFormat('!Y-m-d', $birthDate);
        if ($parsedBirthDate === false || $parsedBirthDate->format('Y-m-d') !== $birthDate) {
            $io->error('Invalid birth date "'.$birthDate.'", expected format is YYYY-MM-DD');

            return Command::FAILURE;
        }

        $io->title('PreAddressing');

        $io->section('Input');
        $io->table([], [
            ['Service URL', $this->dispatchService->getUrl()],
            ['GivenName', $givenName],
            ['FamilyName', $familyName],
            ['DateOfBirth', $birthDate],
        ]);

        $response = $this->dispatchService->doPreAddressingSoapRequest($givenName, $familyName, $birthDate);

        $status = $response->getStatus();
        $timestamp = $status->getTimestamp();

        $io->section('Response');
        $io->table([], [
            ['Version', $response->getVersion()],
            ['AppDeliveryID', $response->getAppDeliveryID()],
            ['DualDeliveryID', $response->getDualDeliveryID()],
            ['Status Code', $status->getCode()],
            ['Status Text', $status->getText()],
            ['Status Timestamp', $timestamp?->format(\DateTimeInterface::ATOM)],
        ]);

        // Errors can be present even if the request itself was successful
        $errors = $response->getErrors()?->getError() ?? [];
        if ($errors !== []) {
            $io->section('Response Errors');
            $rows = [];
            foreach ($errors as $error) {
                $rows[] = [$error->getCode(), $error->getSeverity(), $error->getInfo()];
            }
            $io->table(['Code', 'Severity', 'Info'], $rows);
        }

        $io->section('Addressing Results');
        $addressingResults = $response->getAddressingResults()?->getAddressingResult() ?? [];

        if ($addressingResults === []) {
            $io->warning('No addressing results, the person cannot be delivered to electronically!');

            return Command::SUCCESS;
        }

        foreach ($addressingResults as $addressingResult) {
            $io->table([], [
                ['RecipientID', $addressingResult->getRecipientID()],
                ['DualDeliveryID', $addressingResult->getDualDeliveryID()],
            ]);

            $channelResults = $addressingResult->getDeliveryChannelAddressingResult();
            if ($channelResults === []) {
                $io->writeln('No delivery channel addressing results');
                $io->newLine();
                continue;
            }

            $rows = [];
            foreach ($channelResults as $channelResult) {
                $channelStatus = $channelResult->getStatus();
                $rows[] = [
                    $channelResult->getName(),
                    $channelStatus->getCode(),
                    $channelStatus->getText(),
                    self::formatParameters($channelResult->getParameters()) ?? '',
                    self::formatErrors($channelResult->getErrors()) ?? '',
                ];
            }

            $io->table(['Channel', 'Status Code', 'Status Text', 'Parameters', 'Errors'], $rows);
        }

        return Command::SUCCESS;
    }

    /**
     * Returns all errors as a multi-line string, or null if there are none.
     */
    private static function formatErrors(?ErrorsType $errors): ?string
    {
        $lines = [];
        foreach ($errors?->getError() ?? [] as $error) {
            $line = $error->getCode().': '.$error->getInfo();
            $severity = $error->getSeverity();
            if ($severity !== null) {
                $line .= ' ('.$severity.')';
            }
            $lines[] = $line;
        }

        return $lines === [] ? null : implode("\n", $lines);
    }

    /**
     * Returns all parameters as a multi-line string, or null if there are none.
     */
    private static function formatParameters(?ParametersType $parameters): ?string
    {
        $lines = [];
        foreach ($parameters?->getParameter() ?? [] as $parameter) {
            $line = $parameter->getProperty().' = '.$parameter->getValue();
            $type = $parameter->getType();
            if ($type !== null) {
                $line .= ' ('.$type.')';
            }
            $lines[] = $line;
        }

        return $lines === [] ? null : implode("\n", $lines);
    }
}
