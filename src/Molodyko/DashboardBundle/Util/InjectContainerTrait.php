<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 08.04.2016
 * Time: 0:21
 */

namespace Molodyko\DashboardBundle\Util;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Inject container into the constructor
 *
 * @package Molodyko\DashboardBundle\Util
 */
trait InjectContainerTrait
{
    /** @var ContainerInterface */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }
}