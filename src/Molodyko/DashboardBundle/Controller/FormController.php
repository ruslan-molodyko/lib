<?php

namespace Molodyko\DashboardBundle\Controller;

use Molodyko\DashboardBundle\Logic\Context;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FormController extends Controller
{
    /**
     * @Route("/form/{id}", name="molodyko.dashboard.form")
     */
    public function indexAction($id = 'book_mapping')
    {
        $resolver = $this->get('molodyko.dashboard.logic.resolver');
        $html = $this->get('molodyko.dashboard.render.render')->render($resolver->getFormType($id));

        $context = $this->get('molodyko.dashboard.logic.context');
        $context->set('current_map_id', $id);

        return $this->render('DashboardBundle:Block:index.html.twig', ['content' => $html, 'context' => $context]);
    }
}
