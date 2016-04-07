<?php

namespace Molodyko\DashboardBundle\Controller;

use Molodyko\DashboardBundle\Builder\ListBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ListController extends Controller
{
    /**
     * @Route("/list/{id}", name="molodyko.dashboard.list")
     */
    public function listAction($id)
    {
        $page = 1;
        $count = 10;

        $map = $this->getMap($id);
        $listBuilder = $this->getContainer()->get('molodyko.dashboard.builder.list_builder');

        /** @var ListBuilder $map */
        $map->configureListField($listBuilder);

        $query = $this->getContainer()
            ->get('molodyko.dashboard.data.query')
            ->getQuery($map->getMapConfig()['entity']['class'], $page, $count, $listBuilder->getFieldNames());

        $pagination = $this->getContainer()
            ->get('molodyko.dashboard.util.pagination')
            ->getPagination($query, $page, $count);

        $html = $this->get('molodyko.dashboard.render.list_render')->render($pagination);

        $context = $this->getContext();
        $context->set('current_map_id', $id);

        return $this->render('DashboardBundle:Block:index.html.twig', ['content' => $html, 'context' => $context]);
    }
}
