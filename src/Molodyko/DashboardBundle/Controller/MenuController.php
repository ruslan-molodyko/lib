<?php

namespace Molodyko\DashboardBundle\Controller;

use Molodyko\DashboardBundle\Logic\Context;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MenuController extends Controller
{
    public function menuAction(Context $context)
    {
        $mapping = $this->get('molodyko.di.metadata.service')->getMapping();
        return $this->render('DashboardBundle:Menu:menu.html.twig', [
            'context' => $context,
            'mapping' => $mapping
        ]);
    }
}
