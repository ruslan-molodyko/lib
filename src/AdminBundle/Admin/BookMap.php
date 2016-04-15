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
use Molodyko\DashboardBundle\Event\FieldConvertValueEvent;
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

    public function configureCollectionField(CollectionBuilder $listBuilder)
    {
        $listBuilder->add('title', ['sortable' => true, 'linked' => true])
            ->add('description', ['handler' => function (FieldConvertValueEvent $event) {
                $event->setValue('there is ' . $event->getValue());
            }])
            ->add('year')
            ->add('isbn')
        ;
    }
}