<?php

namespace Molodyko\DashboardBundle\Logic;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Store parameters
 *
 * Class Context
 * @package Molodyko\DashboardBundle\Logic
 */
class Context
{
    /**
     * @var array
     */
    protected $container = [];

    /** @var  ContainerInterface */
    protected $di;

    public function __construct(ContainerInterface $container)
    {
        $this->di = $container;
    }

    /**
     * Get value
     *
     * @param $key
     * @return mixed
     * @throws \Exception
     */
    public function get($key)
    {
        if ($this->has($key)) {
            return $this->container[$key];
        }
        throw new \Exception(sprintf('Key "%s" not found', $key));
    }

    /**
     * Has value
     *
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return array_key_exists($key, $this->container) ? true : false;
    }

    /**
     * Set value
     *
     * @param $key
     * @param $value
     * @throws \Exception
     */
    public function set($key, $value)
    {
        if (!is_string($key)) {
            throw new \Exception('The key have to be a string');
        }
        if (is_object($value)) {
            throw new \Exception('Can not to dump object type');
        }

        $this->container[$key] = $value;
    }
}
