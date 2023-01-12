<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DependencyInjection;

use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public const GROUP_READER_METADATA = 'GROUP_READER_METADATA';
    public const GROUP_READER_CONTENT = 'GROUP_READER_CONTENT';
    public const GROUP_WRITER = 'GROUP_WRITER';
    public const USER = 'USER';
    public const GROUPS = 'GROUPS';

    public const GROUP_NODE = 'group';
    public const GROUP_DATA_ADDRESS_ATTRIBUTES_NODE = 'address_attributes';
    public const GROUP_DATA_IRI_TEMPLATE = 'iri_template';
    public const GROUP_STREET_ATTRIBUTE = 'street';
    public const GROUP_LOCALITY_ATTRIBUTE = 'locality';
    public const GROUP_POSTAL_CODE_ATTRIBUTE = 'postal_code';
    public const GROUP_COUNTRY_ATTRIBUTE = 'country';

    private function getGroupNode(): NodeDefinition
    {
        $treeBuilder = new TreeBuilder(self::GROUP_NODE);

        $node = $treeBuilder->getRootNode()
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode(self::GROUP_DATA_IRI_TEMPLATE)
                    ->defaultValue('/base/organizations/%s')
                ->end()
                ->arrayNode(self::GROUP_DATA_ADDRESS_ATTRIBUTES_NODE)
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode(self::GROUP_STREET_ATTRIBUTE)
                            ->defaultValue('streetAddress')
                        ->end()
                        ->scalarNode(self::GROUP_LOCALITY_ATTRIBUTE)
                            ->defaultValue('addressLocality')
                        ->end()
                        ->scalarNode(self::GROUP_POSTAL_CODE_ATTRIBUTE)
                            ->defaultValue('postalCode')
                        ->end()
                        ->scalarNode(self::GROUP_COUNTRY_ATTRIBUTE)
                            ->defaultValue('addressCountry')
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $node;
    }

    private function getAuthNode(): NodeDefinition
    {
        return AuthorizationService::getAuthorizationConfigNodeDefinition([
            self::GROUP_READER_CONTENT => 'false',
            self::GROUP_READER_METADATA => 'false',
            self::GROUP_WRITER => 'false',
            self::USER => 'false',
        ], [
            self::GROUPS => '[]',
        ]);
    }

    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('dbp_relay_dispatch');

        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('database_url')
                    ->isRequired()
                    ->info('The database DSN')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('service_url')
                    ->isRequired()
                    ->info('The base URL for the SOAP service of the dual delivery service provider')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('sender_profile')
                    ->info('The sender profile identifier, as specified/required by your service provider')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('sender_profile_version')
                    ->info('The sender profile version, as specified/required by your service provider')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('cert')
                    ->info('The client certificate in PEM format')
                ->end()
                ->scalarNode('cert_password')
                    ->info('The password of the client certificate')
                ->end()
            ->end()
            ->append($this->getGroupNode())
            ->append($this->getAuthNode())
            ->end();

        return $treeBuilder;
    }
}
