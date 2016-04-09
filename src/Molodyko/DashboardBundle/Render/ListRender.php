<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 05.04.2016
 * Time: 0:48
 */

namespace Molodyko\DashboardBundle\Render;

use Molodyko\DashboardBundle\Builder\ListBuilder;

/**
 * List render
 *
 * @package Molodyko\DashboardBundle\Render
 */
class ListRender extends Render
{
    /**
     * Render the view
     *
     * @param $pagination
     * @return string
     */
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
     * @return ListBuilder
     */
    protected function getListBuilder() {
        return $this->getContainer()->get('molodyko.dashboard.builder.list_builder');
    }
}