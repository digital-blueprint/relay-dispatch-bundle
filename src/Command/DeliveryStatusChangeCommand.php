<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Command;

use Dbp\Relay\DispatchBundle\DualDeliveryProvider\Vendo\Vendo;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\File\File;

class DeliveryStatusChangeCommand extends Command
{
    /**
     * @var DispatchService
     */
    private $dispatchService;

    public function __construct(DispatchService $dispatchService)
    {
        parent::__construct();

        $this->dispatchService = $dispatchService;
    }

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName('dbp:relay-dispatch:delivery-status-change');
        $this
            ->setDescription('DeliveryStatusChange command')
            ->addArgument('action', InputArgument::REQUIRED, 'action: create')
            ->addArgument('identifier', InputArgument::REQUIRED, 'Identifier of the request recipient or status change')
            ->addOption('status-type', null, InputOption::VALUE_OPTIONAL, 'The status type to set')
            ->addOption('description', null, InputOption::VALUE_OPTIONAL, 'The description to set')
            ->addOption('with-file', null, InputOption::VALUE_NONE, 'Wether to attach a file to the status change');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $action = $input->getArgument('action');
        $identifier = $input->getArgument('identifier');
        $withFile = (bool) $input->getOption('with-file');
        $statusType = (int) ($input->getOption('status-type') ?? Vendo::getStatusForCode('P6'));
        $description = $input->getOption('description') ?? 'Test status change';

        switch ($action) {
            case 'create':
                $fileData = null;

                if ($withFile) {
                    $file = new File(__DIR__.'/../../tests/DualDeliveryApi/example.pdf');
                    $fileData = $file->getContent();
                }

                $output->writeln('Generating DeliveryStatusChange for request recipient "'.$identifier.'"...');
                $deliveryStatusChange = $this->dispatchService->createDeliveryStatusChange($identifier, $statusType, $description, $fileData);

                // Set delivery end date if status is final.
                if ($deliveryStatusChange->isFinalDualDeliveryStatus()) {
                    $recipient = $deliveryStatusChange->getDispatchRequestRecipient();
                    $recipient->setDeliveryEndDate(new \DateTimeImmutable('now', new \DateTimeZone('UTC')));
                    $this->dispatchService->updateRequestRecipient($recipient);
                }

                $output->writeln('Identifier: '.$deliveryStatusChange->getIdentifier());
                break;
            default:
                $output->writeln('Action not found!');

                return 1;
        }

        return 0;
    }
}
