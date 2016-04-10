<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 07.04.2016
 * Time: 23:30
 */

namespace Molodyko\DashboardBundle\Field\ListField;

/**
 * Define link of label
 *
 * @package Molodyko\DashboardBundle\Field
 */
class Link
{

    /**
     * Related field name
     *
     * @var string
     */
    protected $fieldName;

    /**
     * Target of link
     *
     * @var string
     */
    protected $route;

    /**
     * If this is custom route then you can define any route with parameters
     * But if not it will be route to form of entity editing
     *
     * @var string
     */
    protected $isCustomRoute;

    /**
     * Need show link in field or not
     *
     * @var string
     */
    protected $isLinked;

    /**
     * Init link
     *
     * @param string $fieldName
     * @param bool $isLinked
     * @param mixed $route
     * @param bool $isCustomRoute
     */
    public function __construct($fieldName, $isLinked, $route, $isCustomRoute)
    {
        $this->fieldName = $fieldName;
        $this->isLinked = $isLinked;
        $this->route = $route;
        $this->isCustomRoute = $isCustomRoute;
    }

    /**
     * Get label of field
     *
     * @return string
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }

    /**
     * Target of link
     *
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * If this is custom route then you can define any route with parameters
     * But if not it will be route to form of entity editing
     *
     * @return string
     */
    public function isCustomRoute()
    {
        return $this->isCustomRoute;
    }

    /**
     * Show link or not
     *
     * @return string
     */
    public function isLinked()
    {
        return $this->isLinked;
    }
}
