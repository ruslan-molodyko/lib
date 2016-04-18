<?php

namespace Molodyko\DashboardBundle\Controller;

use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use Molodyko\DashboardBundle\Admin\Map;
use Molodyko\DashboardBundle\Builder\CollectionBuilder;
use Molodyko\DashboardBundle\Event\FieldConvertValueEvent;
use Molodyko\DashboardBundle\DependencyInjection\Configuration;
use Molodyko\DashboardBundle\Event\FieldNameConvertValueEvent;
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
        // Configure map
        $this->configureMap($id);

        /** @var SlidingPagination $paginationData */
        $paginationData = $this->getPaginationData($id, $request);

        /** @var array $listCollection create list collection */
        $listCollection = $this->getListCollection($id, $paginationData);

        // Set items to pagination
        $paginationData->setItems($listCollection);

        // Create and set context
        $context = $this->get('molodyko.dashboard.logic.context');
        $context->set('current_map_id', $id);

        // Render html
        $html = $this->get('molodyko.dashboard.render.collection_render')
            ->render($context, $paginationData, $this->getCollectionBuilder()->getFieldLabels());

        // Render main page
        return $this->renderMain(['content' => $html, 'context' => $context]);
    }

    /**
     * Get collection builder
     *
     * @return CollectionBuilder
     */
    protected function getCollectionBuilder()
    {
        return $this->getContainer()->get('molodyko.dashboard.builder.collection_builder');
    }

    /**
     * Configure map
     *
     * @param $id
     */
    protected function configureMap($id)
    {
        /** @var Map $map */
        $map = $this->getMap($id);
        $this->getCollectionBuilder()->setMapId($id);

        // Configure collection fields
        $map->configureCollectionField($this->getCollectionBuilder());
    }

    /**
     * @param Request $request
     * @param $id
     * @return SlidingPagination
     */
    protected function getPaginationData($id, Request $request)
    {
        $page = $request->query->get('page', 1);

        $count = $this->getMetaData()
            ->getList()[Configuration::DEFAULT_COUNT_PAGE_ITEM_NODE_NAME];

        // Get query for knp paginator
        $query = $this->getContainer()
            ->get('molodyko.dashboard.data.query')
            ->getQuery(
                $this->getEntityClassNameByMap($this->getMap($id)),
                $this->getCollectionBuilder()->getFieldNames(),
                $page,
                $count
            );

        /** @var SlidingPagination $paginationData */
        $paginationData = $this->getContainer()
            ->get('molodyko.dashboard.util.pagination')
            ->getPagination($query, $page, $count);

        return $paginationData;
    }

    /**
     * Set value to field collection
     *
     * @param $id
     * @param SlidingPagination $paginationData
     * @return array
     */
    protected function getListCollection($id, SlidingPagination $paginationData)
    {
        // Set data to the fields collection
        $listCollection = [];
        foreach ($paginationData as $list) {
            $fieldCollection = clone $this->getCollectionBuilder()->getCollection();
            foreach ($list as $name => $value) {
                // Skip all not reserved fields
                if ($fieldCollection->has($name)) {

                    // Get field
                    $field = $fieldCollection->get($name);

                    // Create and dispatch event
                    $eventEntityRelevant = new FieldConvertValueEvent($id, $field->getName(), $value);
                    $eventFieldRelevant = new FieldNameConvertValueEvent($id, $field->getName(), $value);
                    $this->get('event_dispatcher')->dispatch($eventEntityRelevant->getEventName(), $eventEntityRelevant);
                    $this->get('event_dispatcher')->dispatch($eventFieldRelevant->getEventName(), $eventFieldRelevant);

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
        return $listCollection;
    }
}
