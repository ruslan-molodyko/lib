<?php

namespace Molodyko\DashboardBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MenuController extends Controller
{
    /**
     * @Route("/list/{id}", name="molodyko.dashboard.list")
     */
    public function listAction($id)
    {
        $html = $this->get('molodyko.dashboard.render.list_render')->render($this->getMap($id));

        $context = $this->getContext();
        $context->set('current_map_id', $id);

        return $this->render('DashboardBundle:Block:index.html.twig', ['content' => $html, 'context' => $context]);
    }
}
