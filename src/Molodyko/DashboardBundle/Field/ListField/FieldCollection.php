<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 07.04.2016
 * Time: 23:30
 */

namespace Molodyko\DashboardBundle\Field\ListField;
use Molodyko\DashboardBundle\Util\TraversableCollectionTrait;

/**
 * Store fields
 *
 * @package Molodyko\DashboardBundle\Field
 */
class FieldCollection implements \Iterator
{
    use TraversableCollectionTrait;

    /**
     * Id of collection
     *
     * @var mixed
     */
    protected $id;

    /**
     * Init field container
     *
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Get id of field container
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id of field container
     *
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Add field to collection
     *
     * @param Field $field
     */
    public function add(Field $field)
    {
        $this->collection[$field->getName()] = $field;
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
            unset($this->collection[$fieldName]);
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
        return array_key_exists($fieldName, $this->collection);
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
            return $this->collection[$fieldName];
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
        return $this->collection;
    }

    public function __clone()
    {
        foreach ($this->collection as $name => $field) {
            $this->collection[$name] = clone $field;
        }
    }
}
