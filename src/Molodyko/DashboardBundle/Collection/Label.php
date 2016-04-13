<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 07.04.2016
 * Time: 23:30
 */

namespace Molodyko\DashboardBundle\Collection;

/**
 * Define label of list
 *
 * @package Molodyko\DashboardBundle\Collection
 */
class Label
{
    /**
     * Label of field
     *
     * @var string
     */
    protected $label;

    /**
     * User can sort list by current label
     *
     * @var bool
     */
    protected $isSortable;

    /**
     * Table entity alias
     *
     * @var string
     */
    protected $entityAlias;

    /**
     * Init label
     *
     * @param string $label
     * @param bool $isSortable
     * @param string $entityAlias
     */
    public function __construct($label, $isSortable, $entityAlias)
    {
        $this->label = $label;
        $this->isSortable = $isSortable;
        $this->entityAlias = $entityAlias;
    }

    /**
     * Get label of field
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * If label is sortable
     *
     * @return bool
     */
    public function isSortable()
    {
        return $this->isSortable;
    }

    /**
     * Entity alias which used in query for knp paginator "main.id"
     *
     * @return string
     */
    public function getEntityAlias()
    {
        return $this->entityAlias;
    }
}
