<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Command;

use Dbp\Relay\BasePersonBundle\API\PersonProviderInterface;
use Dbp\Relay\CoreBundle\Rest\Options;
use Dbp\Relay\DispatchBundle\Entity\Request;
// use Dbp\Relay\DispatchBundle\Entity\RequestFile;
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
        $this->setName('dbp:relay-dispatch:test-seed');
        $this
            ->setDescription('Test seed command')
            ->addArgument('action', InputArgument::REQUIRED, 'action: create')
            ->addOption('submit', 's', InputOption::VALUE_NONE, 'Submit request after creation')
            ->addOption('direct', 'd', InputOption::VALUE_NONE, 'When submitting don\'t use the queue, but submit directly')
            ->addOption('output-request-xml', null, InputOption::VALUE_NONE, 'Output the request XML (only works when sending directly)')
            ->addOption('output-json', null, InputOption::VALUE_NONE, 'Set output to json')
            ->addOption('group-id', null, InputOption::VALUE_OPTIONAL, 'Organization group id')
            ->addOption('request-subject', null, InputOption::VALUE_OPTIONAL, 'Request subject')
            ->addOption('recipient-given-name', null, InputOption::VALUE_OPTIONAL, 'Recipient given name')
            ->addOption('recipient-family-name', null, InputOption::VALUE_OPTIONAL, 'Recipient family name')
            ->addOption('recipient-birth-date', null, InputOption::VALUE_OPTIONAL, 'Recipient birth date')
            ->addOption('recipient-street-address', null, InputOption::VALUE_OPTIONAL, 'Recipient street address')
            ->addOption('recipient-building-number', null, InputOption::VALUE_OPTIONAL, 'Recipient building number')
            ->addOption('recipient-postal-code', null, InputOption::VALUE_OPTIONAL, 'Recipient postal code')
            ->addOption('recipient-address-locality', null, InputOption::VALUE_OPTIONAL, 'Recipient address locality')
            ->addOption('recipient-address-country', null, InputOption::VALUE_OPTIONAL, 'Recipient address country', 'AT')
            ->addOption('recipient-person-id', null, InputOption::VALUE_OPTIONAL, 'Recipient person identifier')
            ->addOption('request-person-id', null, InputOption::VALUE_REQUIRED, 'Request person identifier')
            ->addOption('request-reference-number', null, InputOption::VALUE_OPTIONAL, 'Request reference number', date('YmdHis'));
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $action = $input->getArgument('action');
        $doSubmit = (bool) $input->getOption('submit');
        $isDirect = (bool) $input->getOption('direct');
        $isOutputRequestXml = (bool) $input->getOption('output-request-xml');
        $jsonOutput = (bool) $input->getOption('output-json');
        $groupId = $input->getOption('group-id') ? $input->getOption('group-id') : '11072';
        $recipientGivenName = $input->getOption('recipient-given-name') ?? '';
        $recipientFamilyName = $input->getOption('recipient-family-name') ?? '';
        $recipientBirthDate = $input->getOption('recipient-birth-date');
        $recipientStreetAddress = $input->getOption('recipient-street-address') ?? '';
        $recipientBuildingNumber = $input->getOption('recipient-building-number') ?? '';
        $recipientPostalCode = $input->getOption('recipient-postal-code') ?? '';
        $recipientAddressLocality = $input->getOption('recipient-address-locality') ?? '';
        $recipientAddressCountry = $input->getOption('recipient-address-country');

        $recipientPersonId = $input->getOption('recipient-person-id');
        if ($recipientPersonId) {
            $options = [];
            Options::requestLocalDataAttributes($options, ['birthDate']);
            $person = $this->personProvider->getPerson($recipientPersonId, $options);
            $recipientGivenName = $person->getGivenName();
            $recipientFamilyName = $person->getFamilyName();
            $recipientBirthDate = $person->getLocalDataValue('birthDate');
        }

        $requestPersonId = $input->getOption('request-person-id');
        $requestReferenceNumber = $input->getOption('request-reference-number');

        switch ($action) {
            case 'create':
                $name = $input->getOption('request-subject') ? $input->getOption('request-subject') : 'Test '.$recipientGivenName.' '.$recipientFamilyName.' '.rand(1000, 9999);
                if (!$jsonOutput) {
                    $output->writeln('Generating request "'.$name.'" with a recipient and a file...');
                }

                $request = new Request();
                $request->setName($name);
                $request->setGroupId($groupId);
                $request->setPersonIdentifier($requestPersonId);
                $request->setSenderFullName('Hans Tester');
                $request->setSenderOrganizationName('Test Organisation');
                $request->setSenderStreetAddress('Musterstrasse');
                $request->setSenderBuildingNumber((string) rand(10, 99));
                $request->setSenderPostalCode((string) rand(1000, 9999));
                $request->setSenderAddressLocality('Musterstadt');
                $request->setSenderAddressCountry('AT');
                $request->setReferenceNumber($requestReferenceNumber);
                $request = $this->dispatchService->createRequest($request);

                $requestRecipient = new RequestRecipient();
                $requestRecipient->setRequest($request);
                $requestRecipient->setDispatchRequestIdentifier($request->getIdentifier());

                // You can't use the person identifier to fetch the rest of the person data without the permission of the person
                // {"message":"access to local data attribute 'streetAddress' denied","errorId":"","errorDetails":[]}
                //                $requestRecipient->setPersonIdentifier($recipientPersonId);

                $requestRecipient->setGivenName($recipientGivenName);
                $requestRecipient->setFamilyName($recipientFamilyName);

                if ($recipientBirthDate) {
                    $requestRecipient->setBirthDate(new \DateTime($recipientBirthDate));
                }

                $requestRecipient->setStreetAddress($recipientStreetAddress);
                $requestRecipient->setBuildingNumber($recipientBuildingNumber);
                $requestRecipient->setPostalCode($recipientPostalCode);
                $requestRecipient->setAddressLocality($recipientAddressLocality);
                $requestRecipient->setAddressCountry($recipientAddressCountry);

                $requestRecipient = $this->dispatchService->handleRequestRecipientStorage($requestRecipient);
                if ($jsonOutput) {
                    $data2json = [
                        'requestRecipient' => $requestRecipient->getIdentifier(),
                        'isElectronicallyDeliverable' => $requestRecipient->isElectronicallyDeliverable() ? 'yes' : 'no',
                        'isPostalDeliverable' => $requestRecipient->isPostalDeliverable() ? 'yes' : 'no',
                    ];
                } else {
                    $output->writeln('requestRecipient: '.$requestRecipient->getIdentifier());
                    $output->writeln('isElectronicallyDeliverable: '.($requestRecipient->isElectronicallyDeliverable() ? 'yes' : 'no'));
                    $output->writeln('isPostalDeliverable: '.($requestRecipient->isPostalDeliverable() ? 'yes' : 'no'));
                }

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
                    if (!$jsonOutput) {
                        $output->writeln('Submitting request...');
                    }

                    // Check and submit request
                    $this->dispatchService->checkRequestReadyForSubmit($request);

                    if ($isOutputRequestXml && !$jsonOutput) {
                        $output->writeln('');
                        $output->writeln('Request XML:');
                    }

                    $this->dispatchService->submitRequest($request, $isDirect, $isOutputRequestXml);

                    if ($isOutputRequestXml && !$jsonOutput) {
                        $output->writeln('');
                    }

                    if ($jsonOutput) {
                        $outputMessages = array_merge($data2json, [
                            'RequestSubmitted' => true,
                            'AppDeliveryID' => $requestRecipient->getAppDeliveryID(),
                        ]);
                        $jsonData = json_encode($outputMessages, JSON_PRETTY_PRINT);
                        $output->writeln($jsonData);
                    } else {
                        $output->writeln('Request submitted!');
                        $output->writeln('AppDeliveryID: '.$requestRecipient->getAppDeliveryID());
                    }
                }
                break;
            default:
                if ($jsonOutput) {
                    $data2json = [
                        'ActionNotFound!' => true,
                    ];
                    $jsonData = json_encode($data2json, JSON_PRETTY_PRINT);
                    $output->writeln($jsonData);
                } else {
                    $output->writeln('Action not found!');
                }

                return 1;
        }

        return 0;
    }
}
