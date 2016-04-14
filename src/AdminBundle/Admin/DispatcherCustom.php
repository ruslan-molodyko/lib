<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 05.04.2016
 * Time: 0:43
 */

namespace AdminBundle\Admin;

use Molodyko\DashboardBundle\Collection\FieldGetValueEvent;

class YearHandler
{
    public function handle(FieldGetValueEvent $event)
    {
        /** @var \DateTime $value */
        $value = $event->getValue();
        $event->setValue($value->format('d-m-Y'));

        dump('dispatch');die;
    }
}