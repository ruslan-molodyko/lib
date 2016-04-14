<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 05.04.2016
 * Time: 0:43
 */

namespace AdminBundle\Admin;

use Molodyko\DashboardBundle\Admin\Map;
use Molodyko\DashboardBundle\Builder\CollectionBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class UserMap extends Map
{
    public function configureFormField(FormBuilderInterface $formBuilder)
    {
        $formBuilder->add('email');
    }

    public function configureCollectionField(CollectionBuilder $listBuilder)
    {
        $listBuilder
            ->add('email');
    }
}