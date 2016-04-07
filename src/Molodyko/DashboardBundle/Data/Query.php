<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 08.04.2016
 * Time: 0:46
 */

namespace Molodyko\DashboardBundle\Data;

use Molodyko\DashboardBundle\Util\InjectContainerTrait;

class Query
{
    use InjectContainerTrait;

    const PREFIX_MAIN_TABLE = 'main';

    public function getQuery($entityClass, $page, $count, $select = null)
    {
        $em = $this->getContainer()->get('doctrine.orm.default_entity_manager');
        $query = $em->createQueryBuilder()
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