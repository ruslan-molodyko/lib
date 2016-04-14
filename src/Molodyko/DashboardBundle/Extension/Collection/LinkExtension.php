<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 15.04.2016
 * Time: 1:07
 */

namespace Molodyko\DashboardBundle\Extension\Collection;

use Molodyko\DashboardBundle\Collection\Field;
use Molodyko\DashboardBundle\Util\InjectContainerTrait;

class LinkExtension extends \Twig_Extension {

    use InjectContainerTrait;

    /**
     * {@inheritdoc}
     */
    public function getFunctions() {
        return array(
            'link_collection_start' => new \Twig_Function_Method(
                $this,
                'linkCollectionStart',
                // Disable auto escaping of html code
                ['is_safe' => ['html']]
            ),
            'link_collection_end' => new \Twig_Function_Method(
                $this,
                'linkCollectionEnd',
                // Disable auto escaping of html code
                ['is_safe' => ['html']]
            )
        );
    }

    /**
     * Render start of link with route
     *
     * @param Field $field
     * @param array $attr
     * @return string
     */
    public function linkCollectionStart(Field $field, array $attr = null)
    {
        return $this->linkCollection('start', $field, $attr);
    }

    /**
     * Render end of link
     *
     * @param Field $field
     * @return string
     */
    public function linkCollectionEnd(Field $field)
    {
        return $this->linkCollection('end', $field);
    }

    /**
     * Link collection renderer
     *
     * @param $mode
     * @param Field $field
     * @param array $attr
     * @return string
     * @throws \Exception
     * @throws \Twig_Error
     */
    protected function linkCollection($mode, Field $field, $attr = null) {
        return $this->getContainer()->get('templating')
            ->render(
                "DashboardBundle:Extension/Collection:link_collection.html.twig",
                [
                    'mode' => $mode,
                    'field' => $field,
                    'attr' => $attr
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'link_collection';
    }
}
