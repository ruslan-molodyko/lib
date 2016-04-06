<?php

namespace Molodyko\DashboardBundle\DependencyInjection;

class Configurator
{

    /** @var  Array */
    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * Init passed config
     */
    public function initConfig()
    {
        $this->config[] = '12';
    }

    /**
     * @param array $config
     */
    public function setConfig(array $config = array())
    {
        $this->config = $config;
    }

    /**
     * @return Array
     */
    public function getConfig()
    {
        return $this->config;
    }
}
