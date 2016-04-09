<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 05.04.2016
 * Time: 0:48
 */

namespace Molodyko\DashboardBundle\Render;

use Molodyko\DashboardBundle\Builder\ListBuilder;

class ListRender extends Render
{
    public function render($pagination)
    {
        return $this->renderView(
            'DashboardBundle:List:list.html.twig',
            [
                'pagination' => $pagination
            ]
        );
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