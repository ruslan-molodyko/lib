<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 07.04.2016
 * Time: 23:23
 */

namespace Molodyko\DashboardBundle\Builder;

use Molodyko\DashboardBundle\Field\ListField;

/**
 * Class for build structure of entity list
 *
 * @package Molodyko\DashboardBundle\Builder
 */
class ListBuilder
{
    /** @var array Store list fields */
    protected $fieldContainer = [];

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
        $this->fieldContainer[] = new ListField($field, $options);

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
        /** @var ListField $field */
        foreach ($this->fieldContainer as $field) {
            $list[$field->getName()] = $field->getName();
        }
        return $list;
    }

    public function getFieldLabels()
    {
        $list = [];
        /** @var ListField $field */
        foreach ($this->fieldContainer as $field) {
            $list[$field->getName()] = $field->getLable();
        }
        return $list;
    }
}