<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 08.04.2016
 * Time: 0:21
 */

namespace Molodyko\DashboardBundle\Util;

use Doctrine\ORM\EntityManager;

/**
 * Inject entity manager into the constructor
 *
 * @package Molodyko\DashboardBundle\Util
 */
trait InjectEntityManagerTrait
{
    /** @var EntityManager */
    protected $em;

    /**
     * Init entity manager
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @return EntityManager
     */
    protected function getEntityManager()
    {
        return $this->em;
    }
}