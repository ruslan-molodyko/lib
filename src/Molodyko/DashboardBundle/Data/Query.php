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
 * Class Query
 * For getting the query of some entity
 *
 * @package Molodyko\DashboardBundle\Data
 */
class Query
{
    /** Prefix which will be use to highlight the main table in query */
    const PREFIX_MAIN_TABLE = 'main';

    use InjectEntityManagerTrait;

    /**
     * Get query by entity and parameters
     *
     * @param string $entityClass Class name for query
     * @param array $select Array with field names which will be use in query
     * @param int $page Start page
     * @param int $count Count items on page
     * @return \Doctrine\ORM\Query
     */
    public function getQuery($entityClass, $select, $page, $count)
    {
        $query = $this->getEntityManager()->createQueryBuilder()
            ->select($this->getSelectExpression($select))
            ->from($entityClass, self::PREFIX_MAIN_TABLE)
            ->setFirstResult($page)
            ->setMaxResults($count)
        ;

        return $query->getQuery();
    }

    /**
     * Get select string for select method of query
     *
     * @param array $select
     * @return array|string
     */
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