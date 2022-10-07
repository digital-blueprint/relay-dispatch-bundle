<?php

require_once 'vendor/autoload.php';

$generator = new \Wsdl2PhpGenerator\Generator();
$generator->generate(
    new \Wsdl2PhpGenerator\Config(array(
        'inputFile' => './dispatch.wsdl',
        'outputDir' => './output'
    ))
);
