<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 07.04.2016
 * Time: 23:30
 */

namespace Molodyko\DashboardBundle\Field\ListField;
use Molodyko\DashboardBundle\Data\Query;

/**
 * Store fields
 *
 * @package Molodyko\DashboardBundle\Field
 */
class Container
{
    /**
     * Field container
     *
     * @var Field[]
     */
    public $container = [];

    /**
     * Add field to collection
     *
     * @param Field $field
     */
    public function add(Field $field)
    {
        $this->container[$field->getName()] = $field;
    }

    /**
     * Remove field from collection
     *
     * @param string $fieldName
     * @return bool
     */
    public function remove($fieldName)
    {
        if ($this->has($fieldName)) {
            unset($this->container[$fieldName]);
            return true;
        }
        return false;
    }

    /**
     * Field exists in collection
     *
     * @param string $fieldName
     * @return bool
     */
    public function has($fieldName)
    {
        return array_key_exists($fieldName, $this->container);
    }

    /**
     * Get field by his name
     *
     * @param string $fieldName
     * @return Field|null
     */
    public function get($fieldName)
    {
        if ($this->has($fieldName)) {
            return $this->container[$fieldName];
        }
        return null;
    }

    /**
     * Get all field from collection
     *
     * @return Field[]
     */
    public function all()
    {
        return $this->container;
    }
}
