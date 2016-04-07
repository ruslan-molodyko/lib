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
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('dashboard');

        $rootNode
            ->children()
                ->scalarNode('service_mapping_prefix')
                    ->defaultValue('service_')
                ->end()
                ->arrayNode('mapping')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('class')
                                ->isRequired()
                            ->end()
                            ->booleanNode('enabled')
                                ->defaultTrue()
                            ->end()
                            ->arrayNode('entity')
                                ->children()
                                    ->scalarNode('class')
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
