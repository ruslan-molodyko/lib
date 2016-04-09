<?php

namespace Molodyko\DashboardBundle\Logic;

use Molodyko\DashboardBundle\Admin\Map;
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
        $mappingList = $this->getContainer()->get('molodyko.di.metadata.service')->getMapping();
        if (!array_key_exists($id, $mappingList)) {
            throw new \Exception(sprintf('Mapping "%s" not found', $id));
        }
        /** @var Map $map */
        $map = $this->getContainer()->get($mappingList[$id]['service_name']);
        $map->setMapConfig($mappingList[$id]);
        return $map;
    }
}
