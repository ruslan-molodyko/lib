<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 08.04.2016
 * Time: 0:57
 */

namespace Molodyko\DashboardBundle\Util;


use Knp\Component\Pager\Paginator;

/**
 * Class pagination which uses knp-paginator
 *
 * @package Molodyko\DashboardBundle\Util
 */
class Pagination
{
    /** @var Paginator */
    protected $knpPaginator;

    /**
     * Set dependency
     *
     * @param Paginator $knpPaginator
     */
    public function __construct(Paginator $knpPaginator)
    {
        $this->knpPaginator = $knpPaginator;
    }

    /**
     * Get pagination object
     *
     * @param $query
     * @param $page
     * @param $count
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     */
    public function getPagination($query, $page, $count)
    {
        $pagination = $this->knpPaginator->paginate($query, $page, $count);
        return $pagination;
    }
}