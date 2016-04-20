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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PublishingHouseMap extends Map
{
    public function configureFormField(FormBuilderInterface $formBuilder)
    {
        $formBuilder->add('title')
            ->add('description', TextareaType::class)
            ->add('website')
            ->add('year')
            ->add('book', EntityType::class, [
                'class' => 'SystemBundle\Entity\Book',
                'multiple' => true,
                'by_reference' => false,
                'expanded' => true,
                'choice_label' => 'title',
            ])
            ->add('imageFile', FileType::class, ['required' => false])
        ;
    }

    public function configureCollectionField(CollectionBuilder $listBuilder)
    {
        $listBuilder->add('title', ['sortable' => true, 'linked' => true])
            ->add('description', ['handler' => function (FieldConvertValueEvent $event) {
                $event->setValue('there is ' . $event->getValue());
            }])
            ->add('year')
            ->add('website')
        ;
    }
}