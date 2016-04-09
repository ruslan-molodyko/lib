<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 07.04.2016
 * Time: 23:30
 */

namespace Molodyko\DashboardBundle\Field;

/**
 * Define single list field
 *
 * @package Molodyko\DashboardBundle\Field
 */
class ListField
{
    /**
     * Name of field should be the same as defined entity fiend
     *
     * @var string
     */
    public $name;

    /** @var array */
    public $options;

    /**
     * Init field
     *
     * @param $name
     * @param $options
     */
    public function __construct($name, $options)
    {
        $this->name = $name;
        $this->options = $options;
    }

    /**
     * Get name of field
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
