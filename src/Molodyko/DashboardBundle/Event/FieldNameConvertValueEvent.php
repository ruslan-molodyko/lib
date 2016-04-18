<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 07.04.2016
 * Time: 23:30
 */

namespace Molodyko\DashboardBundle\Event;
use Symfony\Component\EventDispatcher\Event;

/**
 * Field convert value event
 *
 * @package Molodyko\DashboardBundle\Collection
 */
class FieldNameConvertValueEvent extends FieldConvertValueEvent
{
    /**
     * @param $entityName
     * @param $fieldName
     * @return string
     */
    public static function getEventNameByField($entityName, $fieldName)
    {
        return self::EVENT_NAME . '.' . $fieldName;
    }
}
