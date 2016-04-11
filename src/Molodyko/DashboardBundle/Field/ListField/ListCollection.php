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
 * Store field containers
 *
 * @package Molodyko\DashboardBundle\Field
 */
class ListCollection implements \Iterator
{
    use TraversableCollectionTrait;

    /**
     * Id of list container
     *
     * @var mixed
     */
    protected $id;

    /**
     * Init list container
     *
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Get id of list container
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add field container to collection
     *
     * @param FieldCollection $fieldContainer
     */
    public function add(FieldCollection $fieldContainer)
    {
        $this->collection[$fieldContainer->getId()] = $fieldContainer;
    }

    /**
     * Remove field container from collection
     *
     * @param string $fieldContainerId
     * @return bool
     */
    public function remove($fieldContainerId)
    {
        if ($this->has($fieldContainerId)) {
            unset($this->collection[$fieldContainerId]);
            return true;
        }
        return false;
    }

    /**
     * Field container exists in collection
     *
     * @param string $fieldContainerId
     * @return bool
     */
    public function has($fieldContainerId)
    {
        return array_key_exists($fieldContainerId, $this->collection);
    }

    /**
     * Get field container by his id
     *
     * @param string $fieldContainerId
     * @return Field|null
     */
    public function get($fieldContainerId)
    {
        if ($this->has($fieldContainerId)) {
            return $this->collection[$fieldContainerId];
        }
        return null;
    }

    /**
     * Get all field containers from collection
     *
     * @return FieldCollection[]
     */
    public function all()
    {
        return $this->collection;
    }
}
