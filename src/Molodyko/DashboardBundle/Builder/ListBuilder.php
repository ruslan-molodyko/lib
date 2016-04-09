<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 07.04.2016
 * Time: 23:23
 */

namespace Molodyko\DashboardBundle\Builder;

use Molodyko\DashboardBundle\Field\ListField;

class ListBuilder
{
    protected $fieldContainer = [];

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
            $list[] = $field->getName();
        }

        return $list;
    }
}