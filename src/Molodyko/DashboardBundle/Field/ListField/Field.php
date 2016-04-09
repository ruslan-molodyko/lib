<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 07.04.2016
 * Time: 23:30
 */

namespace Molodyko\DashboardBundle\Field\ListField;
use Molodyko\DashboardBundle\Data\Query;

/**
 * Define single list field
 *
 * @package Molodyko\DashboardBundle\Field
 */
class Field
{
    /**
     * Option name label text
     */
    const OPTION_LABEL_NAME = 'label';

    /**
     * Option name, need label(column) to be sortable
     */
    const OPTION_IS_LABEL_SORTABLE_NAME = 'sortable';

    /**
     * Entity alias which used in query for knp paginator
     */
    const OPTION_ENTITY_ALIAS = 'entity_alias';

    /**
     * Route of link
     */
    const OPTION_ROUTE = 'route';

    /**
     * Can field be linked
     */
    const OPTION_IS_LINKED = 'linked';

    /**
     * Name of field should be the same as defined entity fiend
     *
     * @var string
     */
    protected $name;

    /**
     * Label object
     *
     * @var Label
     */
    protected $label;

    /**
     * Is linked value
     *
     * @var bool
     */
    protected $isLinked = false;

    /**
     * Field link instance
     *
     * @var Link
     */
    protected $link;

    /**
     * Init field
     *
     * @param $name
     * @param $options
     */
    public function __construct($name, $options)
    {
        $this->name = $name;

        $this->initLabel($options);
        $this->initLink($options);
    }

    /**
     * Init link instance
     *
     * @param array $options
     */
    protected function initLink($options)
    {
        $this->isLinked = isset($options[self::OPTION_IS_LINKED]) ?
            $options[self::OPTION_IS_LINKED] :
            // If is linked option not defined but route is it the set is linked as true
            (isset($options[self::OPTION_ROUTE]) ? true : false);

        $route = isset($options[self::OPTION_ROUTE]) ?
            $options[self::OPTION_ROUTE] :
            'molodyko.dashboard.form';

        $isCustomRoute = isset($options[self::OPTION_ROUTE]);

        $this->link = new Link($this->name, $route, $isCustomRoute);
    }

    /**
     * Init label instance
     *
     * @param array $options
     */
    protected function initLabel($options)
    {
        $labelName = isset($options[self::OPTION_LABEL_NAME]) ?
            $options[self::OPTION_LABEL_NAME] :
            $this->name;

        $isLabelSortable = isset($options[self::OPTION_IS_LABEL_SORTABLE_NAME]) ?
            $options[self::OPTION_IS_LABEL_SORTABLE_NAME] :
            false;

        $entityAlias = isset($options[self::OPTION_ENTITY_ALIAS]) ?
            $options[self::OPTION_ENTITY_ALIAS] :
            Query::PREFIX_MAIN_TABLE . '.' . $this->name;

        $this->label = new Label($labelName, $isLabelSortable, $entityAlias);
    }

    /**
     * Link is linked
     *
     * @return bool
     */
    public function isLinked()
    {
        return $this->isLinked;
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
     * @return Label
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Get link
     *
     * @return Link
     */
    public function getLink()
    {
        return $this->link;
    }
}
