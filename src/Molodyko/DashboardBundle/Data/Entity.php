<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 08.04.2016
 * Time: 0:46
 */

namespace Molodyko\DashboardBundle\Data;

use Doctrine\ORM\EntityManager;
use Molodyko\DashboardBundle\Util\InjectEntityManagerTrait;

/**
 * Class Entity
 * For getting the entity data
 *
 * @package Molodyko\DashboardBundle\Data
 */
class Entity
{
    /** There is prefix of main table which used in query */
    const PREFIX_MAIN_TABLE = 'main';

    use InjectEntityManagerTrait;

    /**
     * Get data of entity by id
     *
     * @param string $entityClass Class name for query
     * @param mixed $id Id of entity
     * @return mixed
     * @throws \Exception
     */
    public function getEntityById($entityClass, $id)
    {
        /** @var \Doctrine\ORM\EntityRepository $repository **/
        $repository = $this->getEntityManager()
            ->getRepository($entityClass);

        if (empty($repository)) {
            throw new \Exception("Repository by class [{$entityClass}] not found");
        }

        return $repository
            ->findOneBy(['id' => $id]);
    }

    /**
     * Save entity
     *
     * @param $entity
     */
    public function save($entity)
    {
        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush();
    }

    /**
     * Remove entity
     *
     * @param $entity
     */
    public function remove($entity)
    {
        $em = $this->getEntityManager();
        $em->remove($entity);
        $em->flush();
    }
}