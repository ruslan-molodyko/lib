<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 05.04.2016
 * Time: 0:48
 */

namespace Molodyko\DashboardBundle\Render;

use Molodyko\DashboardBundle\Admin\Map;
use Molodyko\DashboardBundle\Util\InjectContainerTrait;

abstract class Render
{
    use InjectContainerTrait;

    /**
     * Render form
     *
     * @param $view
     * @param $data
     * @return string
     * @throws \Exception
     * @throws \Twig_Error
     */
    protected function renderView($view, $data)
    {
        return $this->getContainer()->get('templating')->render($view, $data);
    }

    abstract public function render(Map $map, $data);
}