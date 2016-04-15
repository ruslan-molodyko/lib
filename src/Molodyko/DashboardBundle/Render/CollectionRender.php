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
use Molodyko\DashboardBundle\Collection\Label;
use Molodyko\DashboardBundle\DependencyInjection\Configuration;
use Molodyko\DashboardBundle\Logic\Context;

/**
 * List render
 *
 * @package Molodyko\DashboardBundle\Render
 */
class CollectionRender extends Render
{
    /**
     * Render the view
     *
     * @param Context $context
     * @param $pagination
     * @param Label[] $labels
     * @return string
     */
    public function render($context, $pagination, $labels)
    {
        // Get collection template path
        $collection = $this->getMetaData()->getConfig()
            [Configuration::TWIG_NODE_NAME]
            [Configuration::TWIG_COLLECTION_NODE_NAME];

        return $this->renderView(
            $collection,
            [
                'context' => $context,
                'pagination' => $pagination,
                'labels' => $labels,
            ]
        );
    }
}