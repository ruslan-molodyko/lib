<?php

namespace Molodyko\DashboardBundle\Controller;

use Molodyko\DashboardBundle\Admin\Map;
use Molodyko\DashboardBundle\DependencyInjection\Configuration;
use Molodyko\DashboardBundle\Logic\Context;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as ParentController;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class for extending controller
 *
 * @package Molodyko\DashboardBundle\Controller
 */
abstract class Controller extends ParentController
{
    /** Name which uses in templates for accessing to the layout path */
    const LAYOUT_PATH_TWIG_VAR_NAME = '__dashboard_layout_path';

    /**
     * Get container
     *
     * @return ContainerInterface
     */
    protected function getContainer()
    {
        return $this->container;
    }

    /**
     * Get map by id
     *
     * @param String $id Configured id(name) or alias in config
     * @return Map
     * @throws \Exception
     */
    protected function getMap($id)
    {
        $resolver = $this->get('molodyko.dashboard.logic.resolver');
        return $resolver->getMap($id);
    }

    /**
     * Get metadata
     *
     * @return \Molodyko\DashboardBundle\DependencyInjection\MetaData
     */
    protected function getMetaData()
    {
        return  $this->getContainer()->get('molodyko.di.metadata.service');
    }

    /**
     * Get class name of map entity
     *
     * @param Map $map
     * @return mixed
     */
    protected function getEntityClassNameByMap(Map $map)
    {
        return $map->getMapConfig()
            [Configuration::MAPPING_ENTITY_NODE_NAME]
            [Configuration::MAPPING_ENTITY_CLASS_NODE_NAME];
    }

    /**
     * Get context
     *
     * @return Context
     */
    protected function getContext()
    {
        return $this->get('molodyko.dashboard.logic.context');
    }

    /**
     * Render main block
     *
     * @param string $data
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderMain($data)
    {
        // Get path to layout template
        $layout = $this->getMetaData()->getConfig()
            [Configuration::TWIG_NODE_NAME]
            [Configuration::TWIG_LAYOUT_NODE_NAME];

        // Render main page
        return $this->render(
            'DashboardBundle:Block:index.html.twig',
            array_merge($data, [self::LAYOUT_PATH_TWIG_VAR_NAME => $layout])
        );
    }
}
