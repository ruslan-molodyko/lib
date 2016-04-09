<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 05.04.2016
 * Time: 0:48
 */

namespace Molodyko\DashboardBundle\Render;

use Molodyko\DashboardBundle\Admin\Map;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class FormRender extends Render
{
    /**
     * @param Map $map
     * @param null $data
     * @return string
     */
    public function render(Map $map, $data = null)
    {
        $formBuilder = $this->getFormBuilder($data);
        $map->configureFormField($formBuilder);
        $this->finalizeFormBuilder($formBuilder);

        $form = $formBuilder->getForm()->createView();
        $html = $this->renderView('DashboardBundle:Form:form.html.twig', ['form' => $form]);

        return $html;
    }

    /**
     * @param FormBuilderInterface $formBuilder
     */
    protected function finalizeFormBuilder(FormBuilderInterface $formBuilder)
    {
        $formBuilder->add('submit', SubmitType::class);
    }

    /**
     * Create form builder
     *
     * @param $data
     * @return \Symfony\Component\Form\FormBuilderInterface
     */
    protected function getFormBuilder($data) {
        return $this->getContainer()
            ->get('form.factory')
            ->createBuilder(FormType::class, $data);
    }
}