<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Command;

use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DebugCommand extends Command
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
        $this->setName('dbp:relay-dispatch:debug');
        $this
            ->setDescription('Debug command')
            ->addArgument('action', InputArgument::REQUIRED, 'action: generate-request-status-change|do-api-dualdelivery-request|do-api-status-requests')
            ->addArgument('identifier', InputArgument::OPTIONAL, 'identifier', '4d553985-d44f-404f-acf3-cd0eac7ae9c2');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $action = $input->getArgument('action');
        $identifier = $input->getArgument('identifier');

        switch ($action) {
            case 'generate-request-status-change':
                $output->writeln('Generate request status change...');
                $this->dispatchService->createDeliveryStatusChange($identifier, 1, 'Test');
                break;
            case 'do-api-dualdelivery-request':
                $output->writeln('Do API request...');
                $request = $this->dispatchService->getRequestById($identifier);
                $response = $this->dispatchService->doDualDeliveryRequestSoapRequest($request);
                var_dump($response);
                break;
            case 'do-api-status-requests':
                $output->writeln('Do API StatusRequest requests on '.$this->dispatchService->getUrl().'...');
                $this->dispatchService->doStatusRequests();

                break;
            default:
                $output->writeln('Action not found!');

                return 1;
        }

        return 0;
    }
}
