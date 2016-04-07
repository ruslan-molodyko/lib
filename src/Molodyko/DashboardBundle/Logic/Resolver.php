<?php

namespace Molodyko\DashboardBundle\Logic;

use Molodyko\DashboardBundle\Util\InjectContainerTrait;

class Resolver
{
    use InjectContainerTrait;

    /**
     * Get type by map id
     *
     * @param $id
     * @return object
     * @throws \Exception
     */
    public function getMap($id)
    {
        $mappingList = $this->container->get('molodyko.di.metadata.service')->getMapping();
        if (!array_key_exists($id, $mappingList)) {
            throw new \Exception(sprintf('Mapping "%s" not found', $id));
        }
        $map = $this->container->get($mappingList[$id]['service_name']);
        return $map;
    }
}
