<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 07.04.2016
 * Time: 23:23
 */

namespace Molodyko\DashboardBundle\Builder;

use Molodyko\DashboardBundle\Collection\Field;
use Molodyko\DashboardBundle\Collection\FieldCollection;

/**
 * Class for build structure of entity list
 *
 * @package Molodyko\DashboardBundle\Builder
 */
class ListBuilder
{
    /**
     * @var FieldCollection Store fields
     */
    protected $container;

    /**
     * Init container
     */
    public function __construct()
    {
        $this->container = new FieldCollection(null);
    }

    /**
     * Get field container
     *
     * @return FieldCollection
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Add field
     * The field name should be equal as field name of entity
     *
     * @param $field
     * @param null $options
     * @return $this
     */
    public function add($field, $options = null)
    {
        $this->getContainer()->add(new Field($field, $options));

        return $this;
    }

    /**
     * Get all names of field
     *
     * @return array
     */
    public function getFieldNames()
    {
        $list = [];
        /** @var Field $field */
        foreach ($this->getContainer()->all() as $field) {
            $list[$field->getName()] = $field->getName();
        }
        return $list;
    }
}