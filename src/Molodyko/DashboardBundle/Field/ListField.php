<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 07.04.2016
 * Time: 23:30
 */

namespace Molodyko\DashboardBundle\Field;

class ListField
{
    public $name;
    public $options;

    public function __construct($field, $options)
    {
        $this->field = $field;
        $this->options = $options;
    }
}
