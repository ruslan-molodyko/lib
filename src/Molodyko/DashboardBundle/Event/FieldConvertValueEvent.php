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
class FieldConvertValueEvent extends Event
{
    /**
     * Before getting value
     */
    const EVENT_NAME = 'field.convert.value';

    /**
     * Value of the field
     *
     * @var mixed
     */
    protected $value;

    /**
     * Field name
     *
     * @var string
     */
    protected $fieldName;

    /**
     * Entity id
     *
     * @var string
     */
    protected $entityName;

    /**
     * @param string $fieldName
     * @param mixed $value Value of the field passed by link
     */
    public function __construct($entityName, $fieldName, &$value)
    {
        $this->entityId = $entityName;
        $this->fieldName = $fieldName;
        $this->value = &$value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }

    /**
     * @param string $fieldName
     */
    public function setFieldName($fieldName)
    {
        $this->fieldName = $fieldName;
    }

    /**
     * Get full event name
     *
     * @return string
     */
    public function getEventName()
    {
        return static::getEventNameByField($this->getEntityName(), $this->getFieldName());
    }

    /**
     * @param $entityName
     * @param $fieldName
     * @return string
     */
    public static function getEventNameByField($entityName, $fieldName)
    {
        return static::EVENT_NAME . '.' . $entityName . '.' . $fieldName;
    }

    /**
     * @return string
     */
    public function getEntityName()
    {
        return $this->entityId;
    }

    /**
     * @param string $entityName
     */
    public function setEntityName($entityName)
    {
        $this->entityId = $entityName;
    }
}
