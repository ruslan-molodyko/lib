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
    const OPTION_LABEL_NAME = 'label';

    /**
     * Name of field should be the same as defined entity fiend
     *
     * @var string
     */
    protected $name;

    /** @var array */
    protected $options;

    /** @var string */
    protected $label;

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

        $this->init();
    }

    /**
     * Init options
     */
    protected function init()
    {
        $this->label = isset($this->options[self::OPTION_LABEL_NAME]) ?
            $this->options[self::OPTION_LABEL_NAME] :
            $this->name;
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

    /**
     * Get label of field
     *
     * @return string
     */
    public function getLable()
    {
        return $this->label;
    }
}
