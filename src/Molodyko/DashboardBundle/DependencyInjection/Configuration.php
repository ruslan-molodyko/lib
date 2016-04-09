<?php

namespace Molodyko\DashboardBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    // Common constants
    const ROOT_NAME = 'dashboard';
    const SERVICE_MAPPING_PREFIX_NODE_NAME = 'service_mapping_prefix';
    const SERVICE_MAPPING_PREFIX_DEF_VAL = 'service_';

    // List constants
    const LIST_NODE_NAME = 'list';
    const DEFAULT_COUNT_PAGE_ITEM_NODE_NAME = 'default_count_page_item';
    const DEFAULT_COUNT_PAGE_ITEM_DEF_VAL = 5;

    // Mapping constants
    const MAPPING_NODE_NAME = 'mapping';
    const MAPPING_CLASS_NAME_NODE_NAME = 'class';
    const MAPPING_CLASS_ENABLED_NODE_NAME = 'enabled';
    const MAPPING_ENTITY_NODE_NAME = 'entity';
    const MAPPING_ENTITY_CLASS_NODE_NAME = 'class';

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root(self::ROOT_NAME);

        $rootNode
            ->children()
                // Prefix which will be used to defining the map services
                ->scalarNode(self::SERVICE_MAPPING_PREFIX_NODE_NAME)
                    ->defaultValue(self::SERVICE_MAPPING_PREFIX_DEF_VAL)
                ->end()
                // Configure list page
                ->arrayNode(self::LIST_NODE_NAME)
                    ->children()
                        // Count of items on list page
                        ->scalarNode(self::DEFAULT_COUNT_PAGE_ITEM_NODE_NAME)
                            ->defaultValue(self::DEFAULT_COUNT_PAGE_ITEM_DEF_VAL)
                        ->end()
                    ->end()
                ->end()
                // Configure maps
                ->arrayNode(self::MAPPING_NODE_NAME)
                    // Name maps as their id
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            // Class to map
                            ->scalarNode(self::MAPPING_CLASS_NAME_NODE_NAME)
                                ->isRequired()
                            ->end()
                            // Is map enabled?
                            ->booleanNode(self::MAPPING_CLASS_ENABLED_NODE_NAME)
                                ->defaultTrue()
                            ->end()
                            // Configure map entity
                            ->arrayNode(self::MAPPING_ENTITY_NODE_NAME)
                                ->children()
                                    // Path to entity
                                    ->scalarNode(self::MAPPING_ENTITY_CLASS_NODE_NAME)
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
