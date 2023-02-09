<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Command;

use Dbp\Relay\BasePersonBundle\API\PersonProviderInterface;
use Dbp\Relay\DispatchBundle\Entity\Request;
use Dbp\Relay\DispatchBundle\Entity\RequestFile;
use Dbp\Relay\DispatchBundle\Entity\RequestRecipient;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\File\File;

class TestSeedCommand extends Command
{
    protected static $defaultName = 'dbp:relay-dispatch:test-seed';

    /**
     * @var DispatchService
     */
    private $dispatchService;

    /**
     * @var PersonProviderInterface
     */
    private $personProvider;

    public function __construct(DispatchService $dispatchService, PersonProviderInterface $personProvider)
    {
        parent::__construct();

        $this->dispatchService = $dispatchService;
        $this->personProvider = $personProvider;
    }

    /**
     * @return void
     */
    protected function configure()
    {
        $this
            ->setDescription('Test seed command')
            ->addArgument('action', InputArgument::REQUIRED, 'action: create')
            ->addArgument('person-id', InputArgument::REQUIRED, 'person-id')
            ->addOption('submit', 's', InputOption::VALUE_NONE, 'Directly submit request after creation');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $action = $input->getArgument('action');
        $personId = $input->getArgument('person-id');
        $person = $this->personProvider->getPerson($personId);
        $doSubmit = (bool) $input->getOption('submit');

        switch ($action) {
            case 'create':
                $name = 'Test '.$person->getGivenName().' '.$person->getFamilyName().' '.rand(1000, 9999);
                $output->writeln('Generating request "'.$name.'" with a recipient and a file...');

                $request = new Request();
                $request->setName($name);
                $request->setGroupId('11072');
                $request->setPersonIdentifier($personId);
                $request->setSenderFullName('Hans Tester');
                $request->setSenderOrganizationName('Test Organisation');
                $request->setSenderStreetAddress('Musterstrasse');
                $request->setSenderBuildingNumber((string) rand(10, 99));
                $request->setSenderPostalCode((string) rand(1000, 9999));
                $request->setSenderAddressLocality('Musterstadt');
                $request->setSenderAddressCountry('AT');
                $request = $this->dispatchService->createRequest($request);

                $requestRecipient = new RequestRecipient();
                $requestRecipient->setRequest($request);
                $requestRecipient->setDispatchRequestIdentifier($request->getIdentifier());
//                $requestRecipient->setPersonIdentifier($personId);
                $requestRecipient->setGivenName($person->getGivenName());
                $requestRecipient->setFamilyName($person->getFamilyName());
                $requestRecipient->setBirthDate(new \DateTime($person->getBirthDate()));
//                $requestRecipient->setStreetAddress('Musterstrasse');
//                $requestRecipient->setBuildingNumber((string) rand(10, 99));
//                $requestRecipient->setPostalCode((string) rand(1000, 9999));
//                $requestRecipient->setAddressLocality('Musterstadt');
                $requestRecipient->setStreetAddress('');
                $requestRecipient->setBuildingNumber('');
                $requestRecipient->setPostalCode('');
                $requestRecipient->setAddressLocality('');
                $requestRecipient->setAddressCountry('AT');
                $requestRecipient = $this->dispatchService->handleRequestRecipientStorage($requestRecipient);
                $output->writeln('isElectronicallyDeliverable: '.($requestRecipient->isElectronicallyDeliverable() ? 'yes' : 'no'));
                $output->writeln('isPostalDeliverable: '.($requestRecipient->isPostalDeliverable() ? 'yes' : 'no'));

                $request->setRequestRecipients(new ArrayCollection([$requestRecipient]));

//                $requestFile = new RequestFile();
//                $requestFile->setRequest($request);
//                $requestFile->setName('example.pdf');
//                $file = file_get_contents(__DIR__ . '/../../tests/DualDeliveryApi/example.pdf');
//                $requestFile->setData($file);
//                $requestFile->setContentSize(strlen($file));
//                $requestFile->setFileFormat('application/pdf');
//                $this->dispatchService->createRequestFile($requestFile, $request->getIdentifier());
                $file = new File(__DIR__.'/../../tests/DualDeliveryApi/example.pdf');
                $file = $this->dispatchService->createRequestFile($file, $request->getIdentifier());
                $request->setRequestFiles(new ArrayCollection([$file]));

                if ($doSubmit) {
                    $output->writeln('Submitting request...');

                    // Check and submit request
                    $this->dispatchService->checkRequestReadyForSubmit($request);
                    $this->dispatchService->submitRequest($request);

                    $output->writeln('Request submitted!');
                    $output->writeln('AppDeliveryID: '.$requestRecipient->getAppDeliveryID());
                }
                break;
            default:
                $output->writeln('Action not found!');

                return 1;
        }

        return 0;
    }
}
