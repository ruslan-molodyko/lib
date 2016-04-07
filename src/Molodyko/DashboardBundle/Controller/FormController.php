<?php

namespace Molodyko\DashboardBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FormController extends Controller
{
    /**
     * @Route("/form/{id}", name="molodyko.dashboard.form")
     */
    public function indexAction($id)
    {
        $html = $this->get('molodyko.dashboard.render.form_render')->render($this->getMap($id));

        $context = $this->getContext();
        $context->set('current_map_id', $id);

        return $this->render('DashboardBundle:Block:index.html.twig', ['content' => $html, 'context' => $context]);
    }
}
