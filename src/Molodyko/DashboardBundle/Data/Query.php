<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 08.04.2016
 * Time: 0:46
 */

namespace Molodyko\DashboardBundle\Data;

use Doctrine\ORM\EntityManager;

class Query
{
    const PREFIX_MAIN_TABLE = 'main';

    /** @var EntityManager */
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->em;
    }

    public function getQuery($entityClass, $page, $count, $select = null)
    {
        $query = $this->getEntityManager()->createQueryBuilder()
            ->select($this->getSelectExpression($select))
            ->from($entityClass, self::PREFIX_MAIN_TABLE)
            ->setFirstResult($page)
            ->setMaxResults($count)
        ;

        return $query->getQuery();
    }

    protected function getSelectExpression($select)
    {
        if ($select) {

            $result = [];
            foreach ($select as $name) {
                $result[] = self::PREFIX_MAIN_TABLE . '.' .$name;
            }

            return $result;

        } else {
            return self::PREFIX_MAIN_TABLE;
        }
    }
}