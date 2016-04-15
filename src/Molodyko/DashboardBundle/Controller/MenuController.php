<?php

namespace Molodyko\DashboardBundle\Controller;

use Molodyko\DashboardBundle\DependencyInjection\Configuration;
use Molodyko\DashboardBundle\Logic\Context;

class MenuController extends Controller
{
    /**
     * Render menu
     *
     * @param Context $context
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function menuAction(Context $context)
    {
        // Get template path
        $template = $this->getMetaData()->getConfig()
            [Configuration::TWIG_NODE_NAME]
            [Configuration::TWIG_MENU_NODE_NAME];

        $mapping = $this->get('molodyko.di.metadata.service')->getMapping();
        return $this->render($template, [
            'context' => $context,
            'mapping' => $mapping
        ]);
    }
}
