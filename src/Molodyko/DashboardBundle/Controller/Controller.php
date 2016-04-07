<?php

namespace Molodyko\DashboardBundle\Controller;

use Molodyko\DashboardBundle\Admin\Map;
use Molodyko\DashboardBundle\Logic\Context;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as ParentController;

abstract class Controller extends ParentController
{
    /**
     * Get map by id
     *
     * @param $id
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
