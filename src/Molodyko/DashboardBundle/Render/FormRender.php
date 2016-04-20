<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 05.04.2016
 * Time: 0:48
 */

namespace Molodyko\DashboardBundle\Render;

use Molodyko\DashboardBundle\DependencyInjection\Configuration;
use Molodyko\DashboardBundle\Logic\Context;
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
     * @param Context $context
     * @return string
     */
    public function render(Form $form, $context)
    {
        // Get form template path
        $formTemplate = $this->getMetaData()->getConfig()
            [Configuration::TWIG_NODE_NAME]
            [Configuration::TWIG_FORM_NODE_NAME];

        $form = $form->createView();
        $html = $this->renderView($formTemplate, ['form' => $form, 'context' => $context]);

        return $html;
    }

}