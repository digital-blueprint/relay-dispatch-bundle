<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Serializer;

use Dbp\Relay\CoreBundle\Authorization\AbstractAuthorizationService;
use Dbp\Relay\CoreBundle\Authorization\AuthorizationConfigDefinition;
use Dbp\Relay\DispatchBundle\Entity\RequestRecipient;

class EntityNormalizer extends AbstractAuthorizationService
{
    public function __construct()
    {
        parent::__construct();

        $condition = 'isNullOrEmpty(entity.getPersonIdentifier())';

        $this->configure([], [], [
            'DispatchRequestRecipient' => [
               AuthorizationConfigDefinition::ENTITY_CLASS_NAME_CONFIG_NODE => RequestRecipient::class,
               AuthorizationConfigDefinition::ENTITY_READ_ACCESS_CONFIG_NODE => [
                   'addressCountry' => $condition,
                   'postalCode' => $condition,
                   'addressLocality' => $condition,
                   'streetAddress' => $condition,
                   'buildingNumber' => $condition,
                   'birthDate' => $condition,
                   ],
                ],
            ]);
    }
}
