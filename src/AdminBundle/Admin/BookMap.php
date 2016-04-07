<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 05.04.2016
 * Time: 0:43
 */

namespace AdminBundle\Admin;

use Molodyko\DashboardBundle\Admin\Map;
use Molodyko\DashboardBundle\Builder\ListBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class BookMap extends Map
{
    public function configureFormField(FormBuilderInterface $formBuilder)
    {
        $formBuilder->add('title')
            ->add('description')
            ->add('isbn')
            ->add('year')
        ;
    }

    public function configureListField(ListBuilder $listBuilder)
    {
        $listBuilder->add('title')
            ->add('description')
            ->add('isbn')
        ;
    }
}