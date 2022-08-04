<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Command;

use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StatusTestCommand extends Command
{
    protected static $defaultName = 'dbp:relay-dispatch:status-test';

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
        $this->setDescription('Status test command');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Creating status change...');
        $this->dispatchService->createRequestStatusChange('4d553985-d44f-404f-acf3-cd0eac7ae9c2', 1, 'Test');

        return 0;
    }
}
