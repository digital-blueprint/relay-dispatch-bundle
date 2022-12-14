<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Command;

use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ListRecipientsCommand extends Command
{
    protected static $defaultName = 'dbp:relay-dispatch:recipient-list';

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
        $this
            ->setDescription('Outputs a list of recipients')
            ->addOption('limit', 'l', InputArgument::OPTIONAL, 'Limit the number of results', 10);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $limit = (int) $input->getOption('limit');
        $recipients = $this->dispatchService->getRequestRecipients($limit);

        foreach ($recipients as $recipient) {
            $io = new SymfonyStyle($input, $output);

            $request = $recipient->getDispatchRequest();
            $io->title('Request: '.$request->getName());

            $rows = [
                ['Recipient', $recipient->getFullName()],
            ];

            $lastStatusChange = $this->dispatchService->getLastStatusChange($recipient);
            if ($lastStatusChange) {
                $rows[] = ['Last status change', $lastStatusChange->getDateCreated()->format('Y-m-d H:i:s').' (status: '.$lastStatusChange->getStatusType().')'];
                $rows[] = ['  Description', $lastStatusChange->getDescription()];
            }

            $endDate = $recipient->getDeliveryEndDate();
            if ($endDate) {
                $rows[] = ['endDate', $endDate->format('Y-m-d H:i:s')];
            }

            $io->table([], $rows);
        }

        return 0;
    }
}
