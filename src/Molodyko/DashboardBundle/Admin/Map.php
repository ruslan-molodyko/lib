<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 05.04.2016
 * Time: 0:48
 */

namespace Molodyko\DashboardBundle\Admin;

use Molodyko\DashboardBundle\Builder\ListBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormBuilderInterface;

abstract class Map
{
    /** @var  ContainerInterface */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public abstract function configureFormField(FormBuilderInterface $formBuilder);

    public abstract function configureListField(ListBuilder $listBuilder);
}