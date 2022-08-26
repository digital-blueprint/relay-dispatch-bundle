<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Command;

use Dbp\Relay\DispatchBundle\Helpers\Tools;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command to convert a soap request to php code.
 * ./console dbp:relay-dispatch:soap-to-php /application/DualDeliveryRequest_2020-09-11_17-14-06-1131.xml > /application/DualDeliveryRequest.php.
 */
class SoapToPhpCommand extends Command
{
    protected static $defaultName = 'dbp:relay-dispatch:soap-to-php';

    /**
     * @return void
     */
    protected function configure()
    {
        $this
            ->setDescription('SOAP code to PHP code converter')
            ->addArgument('file_path', InputArgument::REQUIRED, 'file path');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Trying to convert SOAP code to PHP code...');
        $filePath = $input->getArgument('file_path');

        if (!file_exists($filePath)) {
            $output->writeln('File not found: '.$filePath);

            return 1;
        }

        $soapString = file_get_contents($filePath);
        $result = Tools::makeXmlCodeFromSoap($soapString);

        echo $result;

        return 0;
    }
}
