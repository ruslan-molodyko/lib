<?php

namespace Molodyko\DashboardBundle\Controller;

use Molodyko\DashboardBundle\Admin\Map;
use Molodyko\DashboardBundle\Builder\ListBuilder;
use Molodyko\DashboardBundle\DependencyInjection\Configuration;
use Molodyko\DashboardBundle\DependencyInjection\MetaData;
use Molodyko\DashboardBundle\Logic\Context;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Get request and render list page
 *
 * @package Molodyko\DashboardBundle\Controller
 */
class ListController extends Controller
{
    /**
     * @Route("/list/{id}", name="molodyko.dashboard.list")
     */
    public function listAction(Request $request, $id)
    {
        list($page, $count) = $this->getQueryOptions($request);

        /** @var Map $map */
        $map = $this->getMap($id);
        /** @var ListBuilder $listBuilder */
        $listBuilder = $this->getListBuilder($map);

        $this->buildMapConfiguration($map, $listBuilder);

        $renderData = $this->getRenderData(
            $this->getEntityClassName($map),
            $listBuilder->getFieldNames(),
            $page,
            $count
        );

        $html = $this->renderList($renderData, $listBuilder->getFieldLabels());
        $context = $this->createContext($id);

        return $this->render(
            'DashboardBundle:Block:index.html.twig',
            ['content' => $html, 'context' => $context]
        );
    }

    /**
     * Create context with set params
     *
     * @param $id
     * @return Context
     * @throws \Exception
     */
    protected function createContext($id)
    {
        $context = $this->get('molodyko.dashboard.logic.context');
        $context->set('current_map_id', $id);

        return $context;
    }

    /**
     * Render list and get html
     *
     * @param $data
     * @param $labels
     * @return string
     */
    protected function renderList($data, $labels)
    {
        $html = $this->get('molodyko.dashboard.render.list_render')->render($data, $labels);
        return $html;
    }

    /**
     * Get knp pagination for rendering
     *
     * @param $entityClassName
     * @param $enabledFields
     * @param $page
     * @param $count
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     */
    protected function getRenderData($entityClassName, $enabledFields, $page, $count)
    {
        $query = $this->getContainer()
            ->get('molodyko.dashboard.data.query')
            ->getQuery($entityClassName, $enabledFields, $page, $count);

        $pagination = $this->getContainer()
            ->get('molodyko.dashboard.util.pagination')
            ->getPagination($query, $page, $count);

        return $pagination;
    }

    /**
     * Get class name of map entity
     *
     * @param Map $map
     * @return mixed
     */
    protected function getEntityClassName(Map $map)
    {
        return $map->getMapConfig()
            [Configuration::MAPPING_ENTITY_NODE_NAME]
            [Configuration::MAPPING_ENTITY_CLASS_NODE_NAME];
    }

    /**
     * Build map configuration
     *
     * @param Map $map
     * @param ListBuilder $listBuilder
     */
    protected function buildMapConfiguration(Map $map, ListBuilder $listBuilder)
    {
        $map->configureListField($listBuilder);
    }

    /**
     * Get list builder
     *
     * @param Map $map
     * @return ListBuilder
     */
    protected function getListBuilder(Map $map)
    {
        return $this->getContainer()->get('molodyko.dashboard.builder.list_builder');
    }

    /**
     * Get page start and count items on page
     *
     * @param Request $request
     * @return array
     */
    protected function getQueryOptions(Request $request)
    {
        return [
            $request->query->get('page', 1),
            $this->getCountItemsOnPage()
        ];
    }

    /**
     * Count item on page
     *
     * @return int
     */
    protected function getCountItemsOnPage()
    {
        $metaData = $this->getContainer()->get('molodyko.di.metadata.service');
        return $metaData->getList()[Configuration::DEFAULT_COUNT_PAGE_ITEM_NODE_NAME];
    }
}
