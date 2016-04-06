<?php

namespace Molodyko\DashboardBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use AdminBundle\Admin\BookForm;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class DashboardExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        // Handle config
        $this->handleConfig($config, $container);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }

    /**
     * Handle bundle config
     *
     * @param $config
     * @param ContainerBuilder $container
     */
    protected function handleConfig($config, ContainerBuilder $container)
    {
        $serviceMappingPrefix = $config['service_mapping_prefix'];
        if (array_key_exists('mapping', $config)) {

            // Iterate all mapping and save it as service with prefix
            foreach ($config['mapping'] as $name => $item) {

                // Check if mapping is enable
                if ($item['enabled']) {
                    $definition = new Definition($item['class']);
                    $definition->addArgument(new Reference('service_container'));
                    $container->setDefinition($serviceMappingPrefix . $name, $definition);
                }
            }
        }

        /**
         * Add custom service for saving config
         */
        $definition = new Definition(Configurator::class);
        $definition->addArgument(['config' => $config]);
        $definition->addMethodCall('initConfig');
        $container->setDefinition('molodyko.di.config.service', $definition);
    }
}
