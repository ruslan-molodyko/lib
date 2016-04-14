<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 05.04.2016
 * Time: 0:48
 */

namespace Molodyko\DashboardBundle\Render;

use Molodyko\DashboardBundle\Builder\CollectionBuilder;
use Molodyko\DashboardBundle\Collection\FieldCollection;
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
     * @param FieldCollection $fieldContainer
     * @return string
     */
    public function render($context, $pagination, $fieldContainer)
    {
        return $this->renderView(
            'DashboardBundle:Collection:collection.html.twig',
            [
                'context' => $context,
                'pagination' => $pagination,
                'fieldContainer' => $fieldContainer,
            ]
        );
    }
}