<?php

namespace Molodyko\DashboardBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;

class FormController extends Controller
{
    /**
     * @Route("/form/{name}/{id}", name="molodyko.dashboard.form")
     */
    public function indexAction(Request $request, $name, $id = null)
    {
        $map = $this->getMap($name);
        $entityService = $this->get('molodyko.dashboard.data.entity');
        $entity = $entityService->getEntityById($this->getEntityClassNameByMap($map), $id);

        $formBuilder = $this->getFormBuilder($this->getEntityClassNameByMap($map), $entity);
        $map->configureFormField($formBuilder);
        $this->finalizeFormBuilder($formBuilder);
        $form = $formBuilder->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entity = $form->getData();
            $entityService->save($entity);
            return $this->redirectToRoute(
                'molodyko.dashboard.form',
                ['id' => $entity->getId(), 'name' => $name]
            );
        }

        $html = $this->get('molodyko.dashboard.render.form_render')
            ->render($form);

        $context = $this->getContext();
        $context->set('current_map_id', $name);
        $context->set('entity_id', $id);

        return $this->renderMain(['content' => $html, 'context' => $context]);
    }

    /**
     * Add submit button
     *
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
    protected function getFormBuilder($entityClass, $data) {
        return $this->getContainer()
            ->get('form.factory')
            ->createBuilder(FormType::class, $data, ['data_class' => $entityClass]);
    }
}
