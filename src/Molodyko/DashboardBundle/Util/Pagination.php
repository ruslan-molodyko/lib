<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 08.04.2016
 * Time: 0:57
 */

namespace Molodyko\DashboardBundle\Util;


use Knp\Component\Pager\Paginator;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Pagination
{
    /** @var Paginator */
    protected $knpPaginator;

    public function __construct(Paginator $knpPaginator)
    {
        $this->knpPaginator = $knpPaginator;
    }

    public function getPagination($query, $page, $count)
    {
        $pagination = $this->knpPaginator->paginate($query, $page, $count);
        return $pagination;
    }
}