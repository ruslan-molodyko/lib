<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 05.04.2016
 * Time: 0:48
 */

namespace Molodyko\DashboardBundle\Render;

use Molodyko\DashboardBundle\Admin\DashboardAbstract;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormBuilder;

class Render
{
    /** @var  ContainerInterface */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    protected function getContainer()
    {
        return $this->container;
    }

    public function render(DashboardAbstract $map, $data = null)
    {
        $formBuilder = $this->getFormBuilder($data);
        $map->configureFormField($formBuilder);
        $this->finalizeFormBuilder($formBuilder);

        $form = $formBuilder->getForm()->createView();
        $html = $this->renderView('DashboardBundle:Form:form.html.twig', ['form' => $form]);

        return $html;
    }

    protected function finalizeFormBuilder(FormBuilder $formBuilder)
    {
        $formBuilder->add('submit', 'submit');
    }

    /**
     * Create form builder
     *
     * @param $data
     * @return \Symfony\Component\Form\FormBuilderInterface
     */
    protected function getFormBuilder($data) {
        return $this->getContainer()->get('form.factory')->createBuilder($data);
    }

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
}