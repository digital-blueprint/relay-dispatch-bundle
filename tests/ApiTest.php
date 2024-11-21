<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Dbp\Relay\BasePersonBundle\TestUtils\TestPersonTrait;
use Dbp\Relay\CoreBundle\TestUtils\TestClient;
use Dbp\Relay\CoreBundle\TestUtils\UserAuthTrait;
use Dbp\Relay\DispatchBundle\Entity\DeliveryStatusChange;
use Dbp\Relay\DispatchBundle\Entity\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;

class ApiTest extends ApiTestCase
{
    use UserAuthTrait;
    use TestPersonTrait;

    private const TEST_FILE_NAME = 'test.pdf';
    private const TEST_FILE_PATH = __DIR__.'/'.self::TEST_FILE_NAME;
    private const TEST_DISPATCH_REQUEST_NAME = 'Subject 42';
    private const TEST_USER_IDENTIFIER = TestClient::TEST_USER_IDENTIFIER;
    private const TEST_ADMIN_IDENTIFIER = 'admin';

    private const TEST_PERSON_IDENTIFIER = 'test_person';

    private ?TestClient $testClient = null;

    private array $testUserAttributes = [
        'READ_METADATA_GROUPS' => ['1', '2', '3', '4'],
        'READ_CONTENT_GROUPS' => ['1', '2', '3'],
        'WRITE_GROUPS' => ['1', '2'],
        'WRITE_READ_ADDRESS_GROUPS' => ['1'],
    ];

    private array $testAdminAttributes = [
        'READ_METADATA_GROUPS' => ['1', '2', '3', '4'],
        'READ_CONTENT_GROUPS' => ['1', '2', '3', '4'],
        'WRITE_GROUPS' => ['1', '2', '3', '4'],
        'WRITE_READ_ADDRESS_GROUPS' => ['1', '2', '3', '4'],
    ];

    protected function setUp(): void
    {
        $this->testClient = new TestClient(ApiTestCase::createClient());
        $this->loginUser();
        // WORKAROUND: an empty given name will cause the pre-addressing request to be omitted, which would otherwise fail
        $this->withPerson($this->testClient->getContainer(), self::TEST_PERSON_IDENTIFIER,
            '',
            'Doe',
            localDataAttributes: [
                'streetAddress' => 'Graben 1',
                'addressLocality' => 'Vienna',
                'postalCode' => '1010',
                'addressCountry' => 'AT',
                'birthDate' => '1.1.1990',
            ]);
        $this->testClient->getClient()->disableReboot();

        TestEntityManager::setUpEntityManager($this->testClient->getContainer());
    }

    public function testGetGroupsUnauthenticated(): void
    {
        $this->testGetUnauthenticated('/dispatch/groups');
    }

    public function testGetGroupUnauthenticated(): void
    {
        $this->testGetUnauthenticated('/dispatch/groups/1');
    }

    public function testReadDispatchRequestContentGranted(): void
    {
        // ----------------------------------------------------------------
        // request with group ID where test use has read content permissions
        $this->loginAdmin();
        $dispatchRequest = $this->createDispatchRequest('1');
        $dispatchRequestIdentifier = $dispatchRequest['identifier'];

        $this->addRequestRecipient($dispatchRequestIdentifier);
        $this->addRequestFile($dispatchRequestIdentifier);

        $this->loginUser();
        $dispatchRequest = $this->getDispatchRequestById($dispatchRequestIdentifier);
        $this->assertCount(1, $dispatchRequest['files'] ?? []);
        $this->assertEquals(self::TEST_DISPATCH_REQUEST_NAME, $dispatchRequest['name']);
    }

    public function testReadDispatchRequestContentNotGranted(): void
    {
        // ----------------------------------------------------------------
        // request with group ID where test use has NO read content permissions
        $this->loginAdmin();
        $dispatchRequest = $this->createDispatchRequest('4');
        $dispatchRequestIdentifier = $dispatchRequest['identifier'];

        $this->addRequestRecipient($dispatchRequestIdentifier);
        $this->addRequestFile($dispatchRequestIdentifier);

        $this->loginUser();
        $dispatchRequest = $this->getDispatchRequestById($dispatchRequestIdentifier);
        $this->assertArrayNotHasKey('files', $dispatchRequest);
        $this->assertArrayNotHasKey('name', $dispatchRequest);
    }

    public function testFoo(): void
    {
        $this->loginAdmin();
        $dispatchRequest = $this->createDispatchRequest('1');
        $dispatchRequestIdentifier = $dispatchRequest['identifier'];

        $this->loginUser();
        $dispatchRequestRecipient = $this->addRequestRecipient(
            $dispatchRequestIdentifier, self::TEST_PERSON_IDENTIFIER);
        $this->assertEquals('', $dispatchRequestRecipient['givenName']);
        $this->assertEquals('Doe', $dispatchRequestRecipient['familyName']);
        $this->assertEquals('Graben 1', $dispatchRequestRecipient['streetAddress']);
        $this->assertEquals('Vienna', $dispatchRequestRecipient['addressLocality']);
        $this->assertEquals('1010', $dispatchRequestRecipient['postalCode']);
        $this->assertEquals('AT', $dispatchRequestRecipient['addressCountry']);

        $dispatchRequest = $this->getDispatchRequestById($dispatchRequestIdentifier);
        $this->assertCount(1, $dispatchRequest['recipients']);
    }

    public function testReadRecipientAddressGranted(): void
    {
        // personal address of recipients is returned if
        // - it was entered manually by a user (i.e. person identifier is not set) OR
        // - the current user has write and read personal address permissions for the group

        // ----------------------------------------------------------------
        // request with group ID where test user has read address permissions
        $this->loginAdmin();
        $dispatchRequest = $this->createDispatchRequest('1');
        $dispatchRequestIdentifier = $dispatchRequest['identifier'];

        $this->loginUser();
        $dispatchRequestRecipient = $this->addRequestRecipient(
            $dispatchRequestIdentifier, self::TEST_PERSON_IDENTIFIER);
        $this->assertEquals('', $dispatchRequestRecipient['givenName']);
        $this->assertEquals('Doe', $dispatchRequestRecipient['familyName']);
        $this->assertEquals('Graben 1', $dispatchRequestRecipient['streetAddress']);
        $this->assertEquals('Vienna', $dispatchRequestRecipient['addressLocality']);
        $this->assertEquals('1010', $dispatchRequestRecipient['postalCode']);
        $this->assertEquals('AT', $dispatchRequestRecipient['addressCountry']);

        // same for GET:
        $dispatchRequestRecipient = $this->getDispatchRequestRecipientById($dispatchRequestRecipient['identifier']);
        $this->assertEquals('', $dispatchRequestRecipient['givenName']);
        $this->assertEquals('Doe', $dispatchRequestRecipient['familyName']);
        $this->assertEquals('Graben 1', $dispatchRequestRecipient['streetAddress']);
        $this->assertEquals('Vienna', $dispatchRequestRecipient['addressLocality']);
        $this->assertEquals('1010', $dispatchRequestRecipient['postalCode']);
        $this->assertEquals('AT', $dispatchRequestRecipient['addressCountry']);

        // same for GET request:
        $dispatchRequest = $this->getDispatchRequestById($dispatchRequestIdentifier);
        $this->assertCount(1, $dispatchRequest['recipients']);
        $dispatchRequestRecipient = $dispatchRequest['recipients'][0];
        $this->assertEquals('', $dispatchRequestRecipient['givenName']);
        $this->assertEquals('Doe', $dispatchRequestRecipient['familyName']);
        $this->assertEquals('Graben 1', $dispatchRequestRecipient['streetAddress']);
        $this->assertEquals('Vienna', $dispatchRequestRecipient['addressLocality']);
        $this->assertEquals('1010', $dispatchRequestRecipient['postalCode']);
        $this->assertEquals('AT', $dispatchRequestRecipient['addressCountry']);

        // ----------------------------------------------------------------
        // recipient with person identifier not set -> read address allowed
        $this->loginAdmin();
        $dispatchRequest = $this->createDispatchRequest('2');
        $dispatchRequestIdentifier = $dispatchRequest['identifier'];

        $this->loginUser();
        $dispatchRequestRecipient = $this->addRequestRecipient(
            $dispatchRequestIdentifier);
        $this->assertEquals('', $dispatchRequestRecipient['givenName']);
        $this->assertEquals('Mustermann', $dispatchRequestRecipient['familyName']);
        $this->assertEquals('Hauptplatz', $dispatchRequestRecipient['streetAddress']);
        $this->assertEquals('1', $dispatchRequestRecipient['buildingNumber']);
        $this->assertEquals('Graz', $dispatchRequestRecipient['addressLocality']);
        $this->assertEquals('8010', $dispatchRequestRecipient['postalCode']);
        $this->assertEquals('AT', $dispatchRequestRecipient['addressCountry']);

        // same for GET:
        $dispatchRequestRecipient = $this->getDispatchRequestRecipientById($dispatchRequestRecipient['identifier']);
        $this->assertEquals('', $dispatchRequestRecipient['givenName']);
        $this->assertEquals('Mustermann', $dispatchRequestRecipient['familyName']);
        $this->assertEquals('Hauptplatz', $dispatchRequestRecipient['streetAddress']);
        $this->assertEquals('1', $dispatchRequestRecipient['buildingNumber']);
        $this->assertEquals('Graz', $dispatchRequestRecipient['addressLocality']);
        $this->assertEquals('8010', $dispatchRequestRecipient['postalCode']);
        $this->assertEquals('AT', $dispatchRequestRecipient['addressCountry']);

        // same for GET request:
        $dispatchRequest = $this->getDispatchRequestById($dispatchRequestIdentifier);
        $this->assertCount(1, $dispatchRequest['recipients']);
        $dispatchRequestRecipient = $dispatchRequest['recipients'][0];
        $this->assertEquals('', $dispatchRequestRecipient['givenName']);
        $this->assertEquals('Mustermann', $dispatchRequestRecipient['familyName']);
        $this->assertEquals('Hauptplatz', $dispatchRequestRecipient['streetAddress']);
        $this->assertEquals('1', $dispatchRequestRecipient['buildingNumber']);
        $this->assertEquals('Graz', $dispatchRequestRecipient['addressLocality']);
        $this->assertEquals('8010', $dispatchRequestRecipient['postalCode']);
        $this->assertEquals('AT', $dispatchRequestRecipient['addressCountry']);
    }

    public function testReadRecipientAddressNotGranted(): void
    {
        // ----------------------------------------------------------------
        // request with group ID where test user has no read address permissions
        $this->loginAdmin();
        $dispatchRequest = $this->createDispatchRequest('2');
        $dispatchRequestIdentifier = $dispatchRequest['identifier'];

        $this->loginUser();
        $dispatchRequestRecipient = $this->addRequestRecipient(
            $dispatchRequestIdentifier, self::TEST_PERSON_IDENTIFIER);
        $this->assertEquals('', $dispatchRequestRecipient['givenName']);
        $this->assertEquals('Doe', $dispatchRequestRecipient['familyName']);
        $this->assertArrayNotHasKey('streetAddress', $dispatchRequestRecipient);
        $this->assertArrayNotHasKey('addressLocality', $dispatchRequestRecipient);
        $this->assertArrayNotHasKey('postalCode', $dispatchRequestRecipient);
        $this->assertArrayNotHasKey('addressCountry', $dispatchRequestRecipient);
        $this->assertArrayNotHasKey('buildingNumber', $dispatchRequestRecipient);

        // same for GET:
        $dispatchRequestRecipient = $this->getDispatchRequestRecipientById($dispatchRequestRecipient['identifier']);
        $this->assertEquals('', $dispatchRequestRecipient['givenName']);
        $this->assertEquals('Doe', $dispatchRequestRecipient['familyName']);
        $this->assertArrayNotHasKey('streetAddress', $dispatchRequestRecipient);
        $this->assertArrayNotHasKey('addressLocality', $dispatchRequestRecipient);
        $this->assertArrayNotHasKey('postalCode', $dispatchRequestRecipient);
        $this->assertArrayNotHasKey('addressCountry', $dispatchRequestRecipient);
        $this->assertArrayNotHasKey('buildingNumber', $dispatchRequestRecipient);
    }

    public function testReadRecipientBirthdateGranted(): void
    {
        // birthdate of recipients is returned if
        // - it was entered manually by a user (i.e. person identifier is NOT set)
        //   AND the current user at least has read content permissions for the group

        // ----------------------------------------------------------------
        // request with group ID where test user has read content permissions and
        // request recipient with person identifier NOT set
        $this->loginAdmin();
        $dispatchRequest = $this->createDispatchRequest('3');
        $dispatchRequestIdentifier = $dispatchRequest['identifier'];

        $dispatchRequestRecipient = $this->addRequestRecipient(
            $dispatchRequestIdentifier);

        $this->loginUser();
        $dispatchRequestRecipient = $this->getDispatchRequestRecipientById($dispatchRequestRecipient['identifier']);
        $this->assertEquals('', $dispatchRequestRecipient['givenName']);
        $this->assertEquals('Mustermann', $dispatchRequestRecipient['familyName']);
        $this->assertEquals('1980-01-01T00:00:00+00:00', $dispatchRequestRecipient['birthDate']);
    }

    public function testReadRecipientBirthdateNotGranted(): void
    {
        // ----------------------------------------------------------------
        // request with group ID where test user has no read content permissions -> don't show birthdate
        $this->loginAdmin();
        $dispatchRequest = $this->createDispatchRequest('4');
        $dispatchRequestIdentifier = $dispatchRequest['identifier'];

        $dispatchRequestRecipient = $this->addRequestRecipient(
            $dispatchRequestIdentifier);

        $this->loginUser();
        $dispatchRequestRecipient = $this->getDispatchRequestRecipientById($dispatchRequestRecipient['identifier']);
        $this->assertEquals('', $dispatchRequestRecipient['givenName']);
        $this->assertEquals('Mustermann', $dispatchRequestRecipient['familyName']);
        $this->assertArrayNotHasKey('birthDate', $dispatchRequestRecipient);

        // ----------------------------------------------------------------
        // request recipient with person identifier set-> don't show birthdate
        $this->loginAdmin();
        $dispatchRequest = $this->createDispatchRequest('1');
        $dispatchRequestIdentifier = $dispatchRequest['identifier'];

        $dispatchRequestRecipient = $this->addRequestRecipient(
            $dispatchRequestIdentifier, self::TEST_PERSON_IDENTIFIER);

        $this->loginUser();
        $dispatchRequestRecipient = $this->getDispatchRequestRecipientById($dispatchRequestRecipient['identifier']);
        $this->assertEquals('', $dispatchRequestRecipient['givenName']);
        $this->assertEquals('Doe', $dispatchRequestRecipient['familyName']);
        $this->assertArrayNotHasKey('birthDate', $dispatchRequestRecipient);
    }

    public function testSubmitRequestStatus(): void
    {
        $this->loginAdmin();
        $dispatchRequest = $this->createDispatchRequest();
        $dispatchRequestIdentifier = $dispatchRequest['identifier'];
        $this->addRequestRecipient($dispatchRequestIdentifier);
        $this->addRequestFile($dispatchRequestIdentifier);

        $dispatchRequest = $this->getDispatchRequestById($dispatchRequestIdentifier);
        $this->assertCount(1, $dispatchRequest['recipients']);
        $this->assertArrayHasKey('lastStatusChange', $dispatchRequest['recipients'][0]);
        $this->assertEmpty($dispatchRequest['recipients'][0]['lastStatusChange']);

        $dispatchRequest = $this->submitRequestById($dispatchRequestIdentifier);
        $this->assertCount(1, $dispatchRequest['recipients']);
        $this->assertArrayHasKey('lastStatusChange', $dispatchRequest['recipients'][0]);
        $this->assertEquals(DeliveryStatusChange::STATUS_SUBMITTED, $dispatchRequest['recipients'][0]['lastStatusChange']['statusType']);
        $this->assertEquals('pending', $dispatchRequest['recipients'][0]['lastStatusChange']['dispatchStatus']);

        // same for GET item request:
        $dispatchRequest = $this->getDispatchRequestById($dispatchRequestIdentifier);
        $this->assertCount(1, $dispatchRequest['recipients']);
        $this->assertArrayHasKey('lastStatusChange', $dispatchRequest['recipients'][0]);
        $this->assertEquals(DeliveryStatusChange::STATUS_SUBMITTED, $dispatchRequest['recipients'][0]['lastStatusChange']['statusType']);
        $this->assertEquals('pending', $dispatchRequest['recipients'][0]['lastStatusChange']['dispatchStatus']);

        // same for GET collection request:
        $dispatchRequests = $this->getDispatchRequests();
        $this->assertCount(1, $dispatchRequests);
        $dispatchRequest = $dispatchRequests[0];
        $this->assertCount(1, $dispatchRequest['recipients']);
        $this->assertArrayHasKey('lastStatusChange', $dispatchRequest['recipients'][0]);
        $this->assertEquals(DeliveryStatusChange::STATUS_SUBMITTED, $dispatchRequest['recipients'][0]['lastStatusChange']['statusType']);
        $this->assertEquals('pending', $dispatchRequest['recipients'][0]['lastStatusChange']['dispatchStatus']);
    }

    private function testGetUnauthenticated(string $url): void
    {
        $response = $this->testClient->get($url, token: null);

        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    private function addRequestFile(string $requestIdentifier): array
    {
        $file = new UploadedFile(self::TEST_FILE_PATH, self::TEST_FILE_NAME);
        $response = $this->testClient->request('POST', '/dispatch/request-files', [
            'headers' => [
                'Content-Type' => 'multipart/form-data',
            ],
            'extra' => [
                'files' => [
                    'file' => $file,
                ],
                'parameters' => [
                    'dispatchRequestIdentifier' => $requestIdentifier,
                ],
            ],
        ]);
        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $requestFile = json_decode($response->getContent(false), true);
        $this->assertNotEmpty($requestFile['identifier']);

        return $requestFile;
    }

    private function addRequestRecipient(string $dispatchRequestIdentifier, ?string $personIdentifier = null): array
    {
        if ($personIdentifier !== null) {
            $recipient = [
                'personIdentifier' => $personIdentifier,
            ];
        } else {
            // WORKAROUND: an empty name will cause the pre-addressing request to be omitted, which would otherwise fail
            $recipient = [
                'givenName' => '',
                'familyName' => 'Mustermann',
                'addressCountry' => 'AT',
                'postalCode' => '8010',
                'addressLocality' => 'Graz',
                'streetAddress' => 'Hauptplatz',
                'buildingNumber' => '1',
                'birthDate' => '1.1.1980',
            ];
        }
        $recipient['dispatchRequestIdentifier'] = $dispatchRequestIdentifier;

        $response = $this->testClient->postJson('/dispatch/request-recipients', $recipient);
        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $requestRecipient = json_decode($response->getContent(false), true);
        $this->assertNotEmpty($requestRecipient['identifier']);
        $this->assertEquals($dispatchRequestIdentifier, $requestRecipient['dispatchRequestIdentifier']);

        return $requestRecipient;
    }

    private function createDispatchRequest(string $groupIdentifier = '1'): mixed
    {
        $dispatchRequest = [
            'name' => self::TEST_DISPATCH_REQUEST_NAME,
            'senderFullName' => 'Jane Doe',
            'senderOrganizationName' => 'Github.com',
            'senderAddressCountry' => 'AT',
            'senderPostalCode' => '8010',
            'senderAddressLocality' => 'Graz',
            'senderStreetAddress' => 'Hauptplatz',
            'senderBuildingNumber' => '1',
            'groupId' => $groupIdentifier,
            'referenceNumber' => 'GZ-2023/01-13',
        ];

        $response = $this->testClient->postJson('/dispatch/requests', $dispatchRequest);
        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $dispatchRequest = json_decode($response->getContent(false), true);
        $this->assertNotEmpty($dispatchRequest['identifier']);

        return $dispatchRequest;
    }

    private function getDispatchRequestById(string $identifier): array
    {
        $response = $this->testClient->get('/dispatch/requests/'.$identifier);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $dispatchRequest = json_decode($response->getContent(false), true);
        $this->assertNotEmpty($dispatchRequest['identifier']);
        $this->assertEquals($identifier, $dispatchRequest['identifier']);

        return $dispatchRequest;
    }

    private function getDispatchRequests(string $groupIdentifier = '1'): array
    {
        $response = $this->testClient->get('/dispatch/requests?groupId='.$groupIdentifier);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $dispatchRequestResponse = json_decode($response->getContent(false), true);

        return $dispatchRequestResponse['hydra:member'];
    }

    private function getDispatchRequestRecipientById(string $identifier): array
    {
        $response = $this->testClient->get('/dispatch/request-recipients/'.$identifier);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $dispatchRequestRecipient = json_decode($response->getContent(false), true);
        $this->assertNotEmpty($dispatchRequestRecipient['identifier']);
        $this->assertEquals($identifier, $dispatchRequestRecipient['identifier']);

        return $dispatchRequestRecipient;
    }

    private function submitRequestById(string $identifier): array
    {
        $response = $this->testClient->postJson("/dispatch/requests/$identifier/submit", []);
        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $dispatchRequest = json_decode($response->getContent(false), true);
        $this->assertEquals($identifier, $dispatchRequest['identifier']);

        return $dispatchRequest;
    }

    private function loginUser(): void
    {
        $this->testClient->setUpUser(self::TEST_USER_IDENTIFIER, $this->testUserAttributes);
        $this->withCurrentPerson($this->testClient->getContainer(), self::TEST_USER_IDENTIFIER);
    }

    private function loginAdmin(): void
    {
        $this->testClient->setUpUser(self::TEST_ADMIN_IDENTIFIER, $this->testAdminAttributes);
        $this->withCurrentPerson($this->testClient->getContainer(), self::TEST_ADMIN_IDENTIFIER);
    }
}
