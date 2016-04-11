<?php

namespace Molodyko\DashboardBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FormController extends Controller
{
    /**
     * @Route("/form/{name}/{id}", name="molodyko.dashboard.form")
     */
    public function indexAction($name, $id)
    {
        $map = $this->getMap($name);
        $entity = $this->get('molodyko.dashboard.data.entity')
            ->getEntityById($this->getEntityClassNameByMap($map), $id);

        $html = $this->get('molodyko.dashboard.render.form_render')
            ->render($this->getMap($id), $entity);

        $context = $this->getContext();
        $context->set('current_map_id', $name);
        $context->set('entity_id', $id);

        return $this->render(
            'DashboardBundle:Block:index.html.twig',
            ['content' => $html, 'context' => $context]
        );
    }
}
