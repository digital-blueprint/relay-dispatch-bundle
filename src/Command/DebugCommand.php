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
    protected static $defaultName = 'dbp:relay-dispatch:debug';

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
            ->setDescription('Debug command')
            ->addArgument('action', InputArgument::REQUIRED, 'action: generate-request-api-xml|generate-request-status-change')
            ->addArgument('identifier', InputArgument::OPTIONAL, 'identifier', '4d553985-d44f-404f-acf3-cd0eac7ae9c2');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $action = $input->getArgument('action');
        $identifier = $input->getArgument('identifier');

        switch ($action) {
            case 'generate-request-status-change':
                $output->writeln('Generate request status change...');
                $this->dispatchService->createRequestStatusChange($identifier, 1, 'Test');
                break;
            case 'generate-request-api-xml':
                $output->writeln('Generate request API XML...');
                $request = $this->dispatchService->getRequestById($identifier);
                $xmlString = $this->dispatchService->generateRequestAPIXML($request);

                echo $xmlString;
                break;
            default:
                $output->writeln('Action not found!');

                return 1;
        }

        return 0;
    }
}
