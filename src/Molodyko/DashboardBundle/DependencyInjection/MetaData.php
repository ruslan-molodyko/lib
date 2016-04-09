<?php

namespace Molodyko\DashboardBundle\DependencyInjection;

/**
 * Class MetaData for getting defined bundle configuration
 *
 * @package Molodyko\DashboardBundle\DependencyInjection
 */
class MetaData
{
    /** @var  Array */
    protected $config;

    /** @var  Array */
    protected $mappingConfig;

    /**
     * Init config
     *
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * Generate map config
     */
    public function prepare()
    {
        $this->mappingConfig = [];
        $serviceMappingPrefix = $this->config['service_mapping_prefix'];
        if (array_key_exists('mapping', $this->config)) {

            // Iterate all mapping and save it as service with prefix
            foreach ($this->config['mapping'] as $name => $item) {

                // Check if mapping is enable
                if ($item['enabled']) {
                    $item['service_name'] = $serviceMappingPrefix . $name;
                    $this->mappingConfig[$name] = $item;
                }
            }
        }
    }

    /**
     * Get full config
     *
     * @return Array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Get mapping config
     *
     * @return Array
     */
    public function getMapping()
    {
        return $this->mappingConfig;
    }
}
