<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 05.04.2016
 * Time: 0:48
 */

namespace AdminBundle\Logic\Renderable;

use AdminBundle\Logic\Form\AdminForm;
use Symfony\Component\DependencyInjection\ContainerInterface;

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

    public function render(AdminForm $adminForm)
    {
        $formBuilder = $this->getFormBuilder();
        $adminForm->configureFormField($formBuilder);

        $form = $formBuilder->getForm()->createView();
        $html = $this->renderView('AdminBundle:Logic/Form:form.html.twig', ['form' => $form]);

        dump($html);
    }

    protected function getFormBuilder() {
        return $this->getContainer()->get('form.factory')->createBuilder();
    }

    protected function renderView($view, $data)
    {
        return $this->getContainer()->get('templating')->renderResponse($view, $data);
    }
}