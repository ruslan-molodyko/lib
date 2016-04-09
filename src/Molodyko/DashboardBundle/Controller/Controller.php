<?php

namespace Molodyko\DashboardBundle\Controller;

use Molodyko\DashboardBundle\Admin\Map;
use Molodyko\DashboardBundle\Logic\Context;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as ParentController;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class for extending controller
 *
 * @package Molodyko\DashboardBundle\Controller
 */
abstract class Controller extends ParentController
{
    /**
     * Get container
     *
     * @return ContainerInterface
     */
    protected function getContainer()
    {
        return $this->container;
    }

    /**
     * Get map by id
     *
     * @param String $id Configured id(name) or alias in config
     * @return Map
     * @throws \Exception
     */
    protected function getMap($id)
    {
        $resolver = $this->get('molodyko.dashboard.logic.resolver');
        return $resolver->getMap($id);
    }

    /**
     * Get context
     *
     * @return Context
     */
    protected function getContext()
    {
        return $this->get('molodyko.dashboard.logic.context');
    }
}
