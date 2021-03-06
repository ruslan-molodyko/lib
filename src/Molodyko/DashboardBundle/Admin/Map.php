<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 05.04.2016
 * Time: 0:48
 */

namespace Molodyko\DashboardBundle\Admin;

use Molodyko\DashboardBundle\Builder\CollectionBuilder;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class for extending custom maps
 * Map there is class which configures entity for output list, form and so on.
 *
 * @package Molodyko\DashboardBundle\Admin
 */
abstract class Map
{
    /** @var  Array */
    protected $mapConfig;

    /**
     * Set config for particular map
     *
     * @param $mapConfig
     */
    public function setMapConfig($mapConfig)
    {
        $this->mapConfig = $mapConfig;
    }

    /**
     * @return Array
     */
    public function getMapConfig()
    {
        return $this->mapConfig;
    }

    /**
     * Configure form
     *
     * @param FormBuilderInterface $formBuilder
     * @return mixed
     */
    public abstract function configureFormField(FormBuilderInterface $formBuilder);

    /**
     * Configure collection
     *
     * @param CollectionBuilder $collectionBuilder
     * @return mixed
     */
    public abstract function configureCollectionField(CollectionBuilder $collectionBuilder);
}