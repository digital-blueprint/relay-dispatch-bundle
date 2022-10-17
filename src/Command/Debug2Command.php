<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Command;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\DualDeliveryService;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\ApplicationID;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\StatusRequestType;
use Dbp\Relay\DispatchBundle\Helpers\Tools;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Debug2Command extends Command
{
    protected static $defaultName = 'dbp:relay-dispatch:debug2';
    private $config;

    public function __construct()
    {
        parent::__construct();

        $this->config = [];
    }

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setDescription('Debug command');
    }

    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $config = $this->config;

        $baseUrl = $config['base_url'];
        $cert = $config['cert'];
        $certPassword = $config['cert_password'];

        $certFileName = Tools::getTempFileName('.pem');
        file_put_contents($certFileName, $cert);

        $service = new DualDeliveryService($baseUrl, [$certFileName, $certPassword]);
        $request = new StatusRequestType(new ApplicationID('foo', '1.0'), 'bla');

        $response = $service->dualStatusRequestOperation($request);
        var_dump($response);

        return 0;
    }
}
