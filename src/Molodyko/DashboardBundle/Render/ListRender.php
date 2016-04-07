<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 05.04.2016
 * Time: 0:48
 */

namespace Molodyko\DashboardBundle\Render;

use Molodyko\DashboardBundle\Admin\Map;
use Molodyko\DashboardBundle\Builder\ListBuilder;

class ListRender extends Render
{
    public function render(Map $map, $data)
    {
        $listBuilder = $this->getListBuilder($data);
        $map->configureListField($listBuilder);

        $html = $this->renderView('DashboardBundle:Form:list.html.twig', null);

        return $html;
    }

    /**
     * Create form builder
     *
     * @param $data
     * @return ListBuilder
     */
    protected function getListBuilder($data) {
        return $this->getContainer()->get('molodyko.dashboard.builder.list_builder');
    }
}