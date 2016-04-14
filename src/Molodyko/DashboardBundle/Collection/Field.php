<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 07.04.2016
 * Time: 23:30
 */

namespace Molodyko\DashboardBundle\Collection;
use Molodyko\DashboardBundle\Data\Query;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * Define single list field
 *
 * @package Molodyko\DashboardBundle\Collection
 */
class Field
{
    /**
     * Option name of event
     */
    const OPTION_EVENT_GET_VALUE = 'handler';

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
     * Field link instance
     *
     * @var Link
     */
    protected $link;

    /**
     * Value of the field
     *
     * @var mixed
     */
    protected $value;

    /**
     * Callback of event
     *
     * @var callable
     */
    protected $callBackHandlerEvent;

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
        $this->initEvent($options);
    }

    /**
     * Get value of field
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set value of field
     *
     * @param $value
     * @return Field
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Init event callbacks
     *
     * @param $options
     */
    protected function initEvent($options)
    {
        if (isset($options[self::OPTION_EVENT_GET_VALUE])) {
            if (is_callable($options[self::OPTION_EVENT_GET_VALUE])) {
                $this->callBackHandlerEvent = $options[self::OPTION_EVENT_GET_VALUE];
            }
        }
    }

    /**
     * Init link instance
     *
     * @param array $options
     */
    protected function initLink($options)
    {
        $isLinked = isset($options[self::OPTION_IS_LINKED]) ?
            $options[self::OPTION_IS_LINKED] :
            // If is linked option not defined but route is it the set is linked as true
            (isset($options[self::OPTION_ROUTE]) ? true : false);

        $route = isset($options[self::OPTION_ROUTE]) ?
            $options[self::OPTION_ROUTE] : null;

        $isCustomRoute = isset($options[self::OPTION_ROUTE]);

        $this->link = new Link($this->name, $isLinked, $route, $isCustomRoute);
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
     * Get name of field
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get handler callback
     *
     * @return callable|null
     */
    public function getCallbackHandler()
    {
        return $this->callBackHandlerEvent;
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

    /**
     * Clone field
     */
    public function __clone()
    {
        $this->link = clone $this->link;
        $this->label = clone $this->label;
    }
}
