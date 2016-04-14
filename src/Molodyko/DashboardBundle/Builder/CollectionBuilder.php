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
use Molodyko\DashboardBundle\Event\FieldConvertValueEvent;
use Symfony\Component\EventDispatcher\Debug\TraceableEventDispatcher;

/**
 * Class for build structure of entity list
 *
 * @package Molodyko\DashboardBundle\Builder
 */
class CollectionBuilder
{
    /**
     * @var FieldCollection Store fields
     */
    protected $collection;

    /**
     * @var TraceableEventDispatcher
     */
    protected $eventDispatcher;

    /**
     * @var string
     */
    protected $mapId;

    /**
     * Init container
     *
     * @param TraceableEventDispatcher $eventDispatcher
     */
    public function __construct(TraceableEventDispatcher $eventDispatcher)
    {
        $this->collection = new FieldCollection(null);
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * Get field container
     *
     * @return FieldCollection
     */
    public function getCollection()
    {
        return $this->collection;
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
        $field = new Field($field, $options);
        $this->initEvents($field);
        $this->getCollection()->add($field);

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
        foreach ($this->getCollection()->all() as $field) {
            $list[$field->getName()] = $field->getName();
        }
        return $list;
    }

    /**
     * Init all events of field
     *
     * @param Field $field
     */
    protected function initEvents(Field $field)
    {
        $handler = $field->getCallbackHandler();
        if (is_callable($handler)) {
            // Add event listener
            $this->getEventDispatcher()->addListener(
                FieldConvertValueEvent::getEventNameByField($this->getMapId(), $field->getName()),
                $field->getCallbackHandler()
            );
        }
    }

    /**
     * @return TraceableEventDispatcher
     */
    protected function getEventDispatcher()
    {
        return $this->eventDispatcher;
    }

    /**
     * @return string
     */
    public function getMapId()
    {
        return $this->mapId;
    }

    /**
     * @param string $mapId
     */
    public function setMapId($mapId)
    {
        $this->mapId = $mapId;
    }
}