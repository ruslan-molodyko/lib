<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 08.04.2016
 * Time: 0:57
 */

namespace Molodyko\DashboardBundle\Util;


class Pagination
{
    use InjectContainerTrait;

    public function getPagination($query, $page, $count)
    {
        $paginator  = $this->getContainer()->get('knp_paginator');
        $pagination = $paginator->paginate($query, $page, $count);
        return $pagination;
    }
}