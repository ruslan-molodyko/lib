<?php

namespace Molodyko\DashboardBundle\Logic;

use Symfony\Component\DependencyInjection\ContainerInterface;

class Resolver
{
    /** @var ContainerInterface */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Get type by map id
     *
     * @param $id
     * @return object
     * @throws \Exception
     */
    public function getFormType($id)
    {
        $mappingList = $this->container->get('molodyko.di.metadata.service')->getMapping();
        if (!array_key_exists($id, $mappingList)) {
            throw new \Exception(sprintf('Mapping "%s" not found', $id));
        }
        $type = $this->container->get($mappingList[$id]['service_name']);
        return $type;
    }
}
