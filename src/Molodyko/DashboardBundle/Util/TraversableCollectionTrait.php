<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 08.04.2016
 * Time: 0:21
 */

namespace Molodyko\DashboardBundle\Util;

/**
 * Inject collection into the class
 * You should add the \Iterator interface to the injected class
 *
 * @package Molodyko\DashboardBundle\Util
 */
trait TraversableCollectionTrait
{
    /**
     * List container
     *
     * @var mixed
     */
    public $collection = [];

    /**
     * Position of cursor
     *
     * @var int
     */
    protected $position = 0;

    /**
     * Rewind
     */
    function rewind() {
        $this->position = 0;
    }

    /**
     * Current element
     *
     * @return mixed
     */
    public function current() {
        return $this->collection[$this->keys()[$this->position]];
    }

    /**
     * Get key
     *
     * @return int
     */
    public function key() {
        $keys = $this->keys();
        return $keys[$this->position];
    }

    /**
     * Next cursor
     */
    public function next() {
        ++$this->position;
    }

    /**
     * Check is valid
     *
     * @return bool
     */
    public function valid() {
        $keys = $this->keys();
        return isset($keys[$this->position]);
    }

    /**
     * Keys of array
     *
     * @return array
     */
    public function keys()
    {
        return array_keys($this->collection);
    }
}