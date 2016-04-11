<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 05.04.2016
 * Time: 0:48
 */

namespace Molodyko\DashboardBundle\Render;

use Symfony\Component\Form\Form;

/**
 * Form render
 *
 * @package Molodyko\DashboardBundle\Render
 */
class FormRender extends Render
{
    /**
     * Configure map and render the view
     *
     * @param Form $form
     * @return string
     */
    public function render(Form $form)
    {
        $form = $form->createView();
        $html = $this->renderView('DashboardBundle:Form:form.html.twig', ['form' => $form]);

        return $html;
    }

}