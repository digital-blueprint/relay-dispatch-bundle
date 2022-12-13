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
            ->addArgument('identifier', InputArgument::OPTIONAL, 'identifier', '4d553985-d44f-404f-acf3-cd0eac7ae9c2')
            ->addArgument('identifier2', InputArgument::OPTIONAL, 'identifier', '4d553985-d44f-404f-acf3-cd0eac7ae9c2');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $action = $input->getArgument('action');
        $identifier = $input->getArgument('identifier');
        $identifier2 = $input->getArgument('identifier2');

        switch ($action) {
            case 'generate-request-status-change':
                $output->writeln('Generate request status change...');
                $this->dispatchService->createDeliveryStatusChange($identifier, 1, 'Test');
                break;
            case 'generate-request-api-xml':
                $output->writeln('Generate request API XML...');
                $request = $this->dispatchService->getRequestById($identifier);
                $xmlString = $this->dispatchService->generateRequestAPIXML($request);

                echo $xmlString;
                break;
            case 'do-api-dualdelivery-request':
                $output->writeln('Do API request...');
                $request = $this->dispatchService->getRequestById($identifier);

                $response = $this->dispatchService->doDualDeliveryRequestSoapRequest($request);

//                $xmlString = $this->dispatchService->generateRequestAPIXML($request);
//                $response = $this->dispatchService->doDualDeliveryRequestAPIRequest($xmlString);

                var_dump($response);

//                if ($response) {
//                    var_dump($response->getHeaders());
//                    var_dump($response->getStatusCode());
//                    echo $response->getBody()->getContents();
//                }
                break;
            case 'do-api-pre-addressing-request':
                $output->writeln('Do API PreAddressing request on '.$this->dispatchService->getUrl().'...');
                $requestRecipient = $this->dispatchService->getRequestRecipientById($identifier);
                $xmlString = $this->dispatchService->generatePreAddressingAPIXML($requestRecipient);

                echo $xmlString;

                $response = $this->dispatchService->doPreAddressingAPIRequest($xmlString);

                var_dump($response);

                if ($response) {
                    var_dump($response->getHeaders());
                    var_dump($response->getStatusCode());
                    echo $response->getBody()->getContents();
                }
                break;
            case 'do-api-status-request':
                $output->writeln('Do API StatusRequest request on '.$this->dispatchService->getUrl().'...');
                $xmlString = $this->dispatchService->generateStatusRequestAPIXML($identifier, $identifier2);

                echo $xmlString;

                $response = $this->dispatchService->doStatusRequestAPIRequest($xmlString);

                var_dump($response);

                if ($response) {
                    var_dump($response->getHeaders());
                    var_dump($response->getStatusCode());
                    echo $response->getBody()->getContents();
                }
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
