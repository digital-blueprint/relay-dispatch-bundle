<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

$generator = new \Wsdl2PhpGenerator\Generator();
$generator->generate(
    new \Wsdl2PhpGenerator\Config([
        'inputFile' => './dispatch.wsdl',
        'outputDir' => './output',
    ])
);
