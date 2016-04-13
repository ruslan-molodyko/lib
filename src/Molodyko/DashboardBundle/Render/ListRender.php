<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 05.04.2016
 * Time: 0:48
 */

namespace Molodyko\DashboardBundle\Render;

use Molodyko\DashboardBundle\Builder\ListBuilder;
use Molodyko\DashboardBundle\Collection\FieldContainer;
use Molodyko\DashboardBundle\Logic\Context;

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
     * @param Context $context
     * @param $pagination
     * @param FieldContainer $fieldContainer
     * @return string
     */
    public function render($context, $pagination, $fieldContainer)
    {
        return $this->renderView(
            'DashboardBundle:List:list.html.twig',
            [
                'context' => $context,
                'pagination' => $pagination,
                'fieldContainer' => $fieldContainer,
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