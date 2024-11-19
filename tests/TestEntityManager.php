<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Tests;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Component\DependencyInjection\ContainerInterface;

class TestEntityManager
{
    private EntityManager $entityManager;

    public function __construct(ContainerInterface $container)
    {
        $this->entityManager = self::setUpEntityManager($container);
    }

    public static function setUpEntityManager(ContainerInterface $container): EntityManager
    {
        try {
            $entityManager = $container->get('doctrine')->getManager('dbp_relay_dispatch_bundle');
            assert($entityManager instanceof EntityManager);

            // enable foreign key and 'ON DELETE CASCADE' support
            $sqlStatement = $entityManager->getConnection()->prepare('PRAGMA foreign_keys = ON');
            $sqlStatement->executeQuery();

            $metaData = $entityManager->getMetadataFactory()->getAllMetadata();
            $schemaTool = new SchemaTool($entityManager);
            $schemaTool->updateSchema($metaData);
        } catch (\Exception $exception) {
            throw new \RuntimeException($exception->getMessage());
        }

        return $entityManager;
    }

    public function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }
}
