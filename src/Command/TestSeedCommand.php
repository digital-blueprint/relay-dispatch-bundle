<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Command;

use Dbp\Relay\DispatchBundle\Entity\Request;
use Dbp\Relay\DispatchBundle\Entity\RequestFile;
use Dbp\Relay\DispatchBundle\Entity\RequestRecipient;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\File\File;

class TestSeedCommand extends Command
{
    protected static $defaultName = 'dbp:relay-dispatch:test-seed';

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
            ->setDescription('Test seed command')
            ->addArgument('action', InputArgument::REQUIRED, 'action: create')
            ->addArgument('person-id', InputArgument::OPTIONAL, 'person-id', '96759CB59373799F');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $action = $input->getArgument('action');
        $personId = $input->getArgument('person-id');

        switch ($action) {
            case 'create':
                $output->writeln('Generating request with a recipient and a file...');

                $request = new Request();
                $request->setName('Test-'.rand(1000, 9999));
                $request->setPersonIdentifier($personId);
                $request->setSenderGivenName('Hans');
                $request->setSenderFamilyName('Tester');
                $request->setSenderStreetAddress('Musterstrasse');
                $request->setSenderBuildingNumber((string) rand(10, 99));
                $request->setSenderPostalCode((string) rand(1000, 9999));
                $request->setSenderAddressLocality('Musterstadt');
                $request->setSenderAddressCountry('AT');
                $request = $this->dispatchService->createRequest($request);

                $requestRecipient = new RequestRecipient();
                $requestRecipient->setRequest($request);
                $requestRecipient->setDispatchRequestIdentifier($request->getIdentifier());
                $requestRecipient->setGivenName('Hans');
                $requestRecipient->setFamilyName('Tester');
                $requestRecipient->setBirthDate(new \DateTime('2000-01-01'));
                $requestRecipient->setStreetAddress('Musterstrasse');
                $requestRecipient->setBuildingNumber((string) rand(10, 99));
                $requestRecipient->setPostalCode((string) rand(1000, 9999));
                $requestRecipient->setAddressLocality('Musterstadt');
                $requestRecipient->setAddressCountry('AT');
                $this->dispatchService->createRequestRecipient($requestRecipient);

//                $requestFile = new RequestFile();
//                $requestFile->setRequest($request);
//                $requestFile->setName('example.pdf');
//                $file = file_get_contents(__DIR__ . '/../../tests/DualDeliveryApi/example.pdf');
//                $requestFile->setData($file);
//                $requestFile->setContentSize(strlen($file));
//                $requestFile->setFileFormat('application/pdf');
//                $this->dispatchService->createRequestFile($requestFile, $request->getIdentifier());
                $file = new File(__DIR__.'/../../tests/DualDeliveryApi/example.pdf');
                $this->dispatchService->createRequestFile($file, $request->getIdentifier());
                break;
            default:
                $output->writeln('Action not found!');

                return 1;
        }

        return 0;
    }
}
