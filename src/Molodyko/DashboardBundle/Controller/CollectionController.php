<?php

namespace Molodyko\DashboardBundle\Controller;

use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use Molodyko\DashboardBundle\Admin\Map;
use Molodyko\DashboardBundle\Builder\CollectionBuilder;
use Molodyko\DashboardBundle\Event\FieldConvertValueEvent;
use Molodyko\DashboardBundle\DependencyInjection\Configuration;
use Molodyko\DashboardBundle\DependencyInjection\MetaData;
use Molodyko\DashboardBundle\Logic\Context;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Get request and render collection page
 *
 * @package Molodyko\DashboardBundle\Controller
 */
class CollectionController extends Controller
{
    /**
     * @Route("/collection/{id}", name="molodyko.dashboard.collection")
     */
    public function listAction(Request $request, $id)
    {
        $page = $request->query->get('page', 1);

        $metaData = $this->getContainer()->get('molodyko.di.metadata.service');
        $count = $metaData->getList()[Configuration::DEFAULT_COUNT_PAGE_ITEM_NODE_NAME];

        /** @var Map $map */
        $map = $this->getMap($id);

        /** @var CollectionBuilder $collectionBuilder */
        $collectionBuilder = $this->getContainer()->get('molodyko.dashboard.builder.collection_builder');
        $collectionBuilder->setMapId($id);

        // Configure collection fields
        $map->configureCollectionField($collectionBuilder);

        // Get query for knp paginator
        $query = $this->getContainer()
            ->get('molodyko.dashboard.data.query')
            ->getQuery(
                $this->getEntityClassNameByMap($map),
                $collectionBuilder->getFieldNames(),
                $page,
                $count
            );

        /** @var SlidingPagination $renderData */
        $renderData = $this->getContainer()
            ->get('molodyko.dashboard.util.pagination')
            ->getPagination($query, $page, $count);

        // Set data to the fields collection
        $listCollection = [];
        foreach ($renderData as $list) {
            $fieldCollection = clone $collectionBuilder->getCollection();
            foreach ($list as $name => $value) {
                // Skip all not reserved fields
                if ($fieldCollection->has($name)) {

                    // Get field
                    $field = $fieldCollection->get($name);

                    // Create and dispatch event
                    $event = new FieldConvertValueEvent($id, $field->getName(), $value);
                    $this->get('event_dispatcher')->dispatch($event->getEventName(), $event);

                    // Set converted value
                    $field->setValue($value);

                    if ($field->getLink()->isLinked() && !$field->getLink()->isCustomRoute()) {
                        $field->getLink()->setRoute(['molodyko.dashboard.form', ['name' => $id, 'id' => $list['id']]]);
                    }
                }
            }
            // Set id of field container
            $fieldCollection->setId($list['id']);
            $listCollection[$fieldCollection->getId()] = $fieldCollection;
        }

        // Set items to pagination
        $renderData->setItems($listCollection);

        // Create and set context
        $context = $this->get('molodyko.dashboard.logic.context');
        $context->set('current_map_id', $id);

        // Render html
        $html = $this->get('molodyko.dashboard.render.list_render')
            ->render($context, $renderData, $collectionBuilder->getCollection());

        // Render main page
        return $this->render(
            'DashboardBundle:Block:index.html.twig',
            ['content' => $html, 'context' => $context]
        );
    }
}
