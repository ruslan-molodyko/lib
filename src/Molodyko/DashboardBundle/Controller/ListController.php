<?php

namespace Molodyko\DashboardBundle\Controller;

use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use Molodyko\DashboardBundle\Admin\Map;
use Molodyko\DashboardBundle\Builder\ListBuilder;
use Molodyko\DashboardBundle\DependencyInjection\Configuration;
use Molodyko\DashboardBundle\DependencyInjection\MetaData;
use Molodyko\DashboardBundle\Field\ListField\ListCollection;
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
        $page = $request->query->get('page', 1);

        $metaData = $this->getContainer()->get('molodyko.di.metadata.service');
        $count = $metaData->getList()[Configuration::DEFAULT_COUNT_PAGE_ITEM_NODE_NAME];

        /** @var Map $map */
        $map = $this->getMap($id);

        /** @var ListBuilder $listBuilder */
        $listBuilder = $this->getContainer()->get('molodyko.dashboard.builder.list_builder');
        $map->configureListField($listBuilder);

        $query = $this->getContainer()
            ->get('molodyko.dashboard.data.query')
            ->getQuery(
                $this->getEntityClassNameByMap($map),
                $listBuilder->getFieldNames(),
                $page,
                $count
            );

        /** @var SlidingPagination $renderData */
        $renderData = $this->getContainer()
            ->get('molodyko.dashboard.util.pagination')
            ->getPagination($query, $page, $count);

        $listCollection = new ListCollection($id);
        foreach ($renderData as $list) {
            $fieldContainer = clone $listBuilder->getContainer();
            foreach ($list as $name => $field) {
                if ($name != 'id') {
                    $fieldContainer->get($name)->setValue($field);
                }
            }
            $fieldContainer->setId($list['id']);
            $listCollection->add($fieldContainer);
        }

        //dump($renderData);die;
        //dump($listCollection->all());die;

        $renderData->setItems($listCollection->all());

        $context = $this->get('molodyko.dashboard.logic.context');
        $context->set('current_map_id', $id);

        $html = $this->get('molodyko.dashboard.render.list_render')
            ->render($context, $renderData, $listBuilder->getContainer());

        return $this->render(
            'DashboardBundle:Block:index.html.twig',
            ['content' => $html, 'context' => $context]
        );
    }
}
