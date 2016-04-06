<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 05.04.2016
 * Time: 0:43
 */

namespace AdminBundle\Admin;

use Molodyko\DashboardBundle\Admin\DashboardAbstract;
use Symfony\Component\Form\FormBuilder;

class BookForm extends DashboardAbstract
{
    public function configureFormField(FormBuilder $formBuilder)
    {
        $formBuilder->add('title');
    }
}