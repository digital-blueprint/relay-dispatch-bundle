<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Command;

use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
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
            ->addOption('limit', 'l', InputOption::VALUE_OPTIONAL, 'Limit the number of results', 10)
            ->addOption('submitted-only', 'so', InputOption::VALUE_NONE, 'List only recipients of submitted requests')
            ->addOption('status-requests', 'sr', InputOption::VALUE_NONE, 'Do a status request update before showing the list of recipients');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $limit = (int) $input->getOption('limit');
        $submittedOnly = (bool) $input->getOption('submitted-only');
        $doStatusRequests = (bool) $input->getOption('status-requests');

        if ($doStatusRequests) {
            $output->writeln('Do API StatusRequest requests on '.$this->dispatchService->getUrl().'...');
            $this->dispatchService->doStatusRequests();
        }

        $recipients = $this->dispatchService->getRequestRecipients($submittedOnly, $limit);

        foreach ($recipients as $recipient) {
            $io = new SymfonyStyle($input, $output);

            $request = $recipient->getDispatchRequest();
            $io->title('Request: '.$request->getName());

            $rows = [];

            if ($request->getDateSubmitted()) {
                $rows[] = ['Date Submitted', $request->getDateSubmitted()->format('Y-m-d H:i:s')];
            }

            $rows[] = ['AppDeliveryID', $recipient->getAppDeliveryID()];
            $birthDate = $recipient->getBirthDate();
            $rows[] = ['Recipient', $recipient->getFullName().' ('.($birthDate ? $birthDate->format('Y-m-d') : 'N/A').', '.$recipient->getPersonIdentifier().')'];
            $rows[] = ['Address', $recipient->getFullAddress()];
            $rows[] = ['RecipientIdentifier', $recipient->getIdentifier()];
            $rows[] = ['ElectronicallyDeliverable', $recipient->isElectronicallyDeliverable() ? 'yes' : 'no'];
            $rows[] = ['PostalDeliverable', $recipient->isPostalDeliverable() ? 'yes' : 'no'];

            $lastStatusChange = $this->dispatchService->getLastStatusChange($recipient);
            if ($lastStatusChange) {
                $rows[] = ['Last status change', $lastStatusChange->getDateCreated()->format('Y-m-d H:i:s').' (status: '.$lastStatusChange->getStatusType().')'];
                $rows[] = ['└ Description', $lastStatusChange->getDescription()];
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
