<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 05.04.2016
 * Time: 0:43
 */

namespace AdminBundle\Logic\Form;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormBuilder;

class AdminForm
{
    public function configureFormField(FormBuilder $formBuilder)
    {
        $formBuilder->add('title');
    }
}