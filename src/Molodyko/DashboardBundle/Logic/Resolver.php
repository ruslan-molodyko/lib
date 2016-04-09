<?php

namespace Molodyko\DashboardBundle\Logic;

use Molodyko\DashboardBundle\Admin\Map;
use Molodyko\DashboardBundle\Util\InjectContainerTrait;

/**
 * Resolve dynamic services
 *
 * @package Molodyko\DashboardBundle\Logic
 */
class Resolver
{
    use InjectContainerTrait;

    /**
     * Get map by id
     *
     * @param string $id Id of map which configured in config
     * @return Map
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
