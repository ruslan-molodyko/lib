<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 05.04.2016
 * Time: 0:48
 */

namespace Molodyko\DashboardBundle\Admin;

use Molodyko\DashboardBundle\Builder\ListBuilder;
use Molodyko\DashboardBundle\Util\InjectContainerTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormBuilderInterface;

abstract class Map
{
    protected $mapConfig;

    public function setMapConfig($mapConfig)
    {
        $this->mapConfig = $mapConfig;
    }

    public function getMapConfig()
    {
        return $this->mapConfig;
    }

    public abstract function configureFormField(FormBuilderInterface $formBuilder);

    public abstract function configureListField(ListBuilder $listBuilder);
}