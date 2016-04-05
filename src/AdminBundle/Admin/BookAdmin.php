<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 04.04.2016
 * Time: 11:22
 */
namespace AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class BookAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title', 'text')
            ->add('description', 'text')
            ->add('isbn', 'text')
            ->add('year', 'date')
            ->add('image', 'file');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title')
            ->addIdentifier('description')
            ->addIdentifier('isbn')
            ->addIdentifier('year')
            ->addIdentifier('image');
    }
}