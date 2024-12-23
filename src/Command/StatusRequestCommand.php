<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Command;

use Dbp\Relay\DispatchBundle\Helpers\Tools;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Dbp\Relay\DispatchBundle\Service\DualDeliveryService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class StatusRequestCommand extends Command
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
        $this->setName('dbp:relay:dispatch:status-request');
        $this->setAliases(['dbp:relay-dispatch:status-request']);
        $this
            ->setDescription('Does a status request for an AppDeliveryID')
            ->addArgument('app-delivery-id', InputArgument::REQUIRED, 'AppDeliveryID')
            ->addOption('output-response-xml', null, InputOption::VALUE_NONE, 'Output the response XML');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $appDeliveryId = $input->getArgument('app-delivery-id');
        $isOutputResponseXml = (bool) $input->getOption('output-response-xml');

        $output->writeln('Doing API StatusRequest request for AppDeliveryID "'.$appDeliveryId.'" on '.$this->dispatchService->getUrl().'...');

        $io = new SymfonyStyle($input, $output);
        $io->title('StatusRequest');

        if ($isOutputResponseXml) {
            $output->writeln('Response XML:');
        }

        $response = $this->dispatchService->doDualDeliveryStatusRequestSoapRequestForAppDeliveryId($appDeliveryId, $isOutputResponseXml, $responseXml);
        $statusCode = $response->getStatus()->getCode();

        if ($isOutputResponseXml) {
            $output->writeln('');
        }

        $rows = [];
        $rows[] = ['AppDeliveryID', $response->getAppDeliveryID()];
        $rows[] = ['DualDeliveryID', $response->getDualDeliveryID()];
        $rows[] = ['Status Code', $statusCode];
        $rows[] = ['Status Text', $response->getStatus()->getText()];

        if ($statusCode === 'P6') {
            $file = DualDeliveryService::getPdfFromDeliveryNotification($response);

            if ($file !== null) {
                $rows[] = ['DeliveryNotificationFile', Tools::humanFileSize(strlen($file))];
            }

            $sendingServiceMessageID = DualDeliveryService::getSendingServiceMessageIDFromDeliveryNotification($response);

            if ($sendingServiceMessageID !== null) {
                $rows[] = ['SendingServiceMessageID', $sendingServiceMessageID];
            }
        }

        $io->table([], $rows);

        return 0;
    }
}
