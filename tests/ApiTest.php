<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
// use ApiPlatform\Symfony\Bundle\Test\Client;
use Dbp\Relay\CoreBundle\TestUtils\UserAuthTrait;
// use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class ApiTest extends ApiTestCase
{
    use UserAuthTrait;

    /**
     * @throws TransportExceptionInterface
     */
    public function testGetGroupsUnauthenticated()
    {
        $this->testRequestUnauthenticated('/dispatch/groups');
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testGetGroupUnauthenticated()
    {
        $this->testRequestUnauthenticated('/dispatch/groups/1');
    }

    //    public function testGetGroupAuthenticated()
    //    {
    //        $this->testRequestAuthenticated('/dispatch/groups/1');
    //    }
    //
    //    public function testGetGroupsAuthenticated()
    //    {
    //        $this->testRequestAuthenticated('/dispatch/groups');
    //    }

    /**
     * @throws TransportExceptionInterface
     */
    private function testRequestUnauthenticated(string $url)
    {
        $client = self::createClient();

        $response = $client->request('GET', $url);

        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    //    private function testRequestAuthenticated(string $url)
    //    {
    //        $client = $this->withUser('user', [], '42');
    //        $this->setUpAccessControl($client);
    //
    //        $response = $client->request('GET', $url, ['headers' => [
    //            'Authorization' => 'Bearer 42',
    //        ]]);
    //        dump($response->getContent());
    //
    //        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    //    }
    //
    //    private function setUpAccessControl(Client $client)
    //    {
    //        $container = $client->getContainer();
    //        /** @var AuthorizationService $authorizationService */
    //        $authorizationService = $container->get(AuthorizationService::class);
    //        $authorizationService->setConfig([
    //            'authorization' => [
    //                'policies' => [
    //                    'ROLE_GROUP_READER_METADATA' => 'true',
    //                    'ROLE_GROUP_READER_CONTENT' => 'false',
    //                    'ROLE_GROUP_WRITER' => 'false',
    //                    'ROLE_GROUP_WRITER_READ_ADDRESS' => 'false',
    //                    'ROLE_USER' => 'true',
    //                ],
    //                'attributes' => [
    //                    'GROUPS' => '["1", "2", "3"]',
    //                ],
    //            ],
    //        ]);
    //    }
}
