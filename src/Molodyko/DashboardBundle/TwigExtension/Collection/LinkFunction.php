<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 15.04.2016
 * Time: 1:07
 */

namespace Molodyko\DashboardBundle\TwigExtension\Collection;

use Molodyko\DashboardBundle\Collection\Field;
use Molodyko\DashboardBundle\TwigExtension\TwigExtension;

class LinkFunction extends TwigExtension {

    /**
     * Initial template for extension
     *
     * @var string
     */
    protected $template = 'DashboardBundle:Extension/Collection:link_collection.html.twig';

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
            ),
            'theme_link_collection' => new \Twig_Function_Method(
                $this,
                'setTemplate'
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
        return $this->renderBlock('link_collection_start', ['field' => $field, 'attr' => $attr]);
    }

    /**
     * Render end of link
     *
     * @param Field $field
     * @return string
     */
    public function linkCollectionEnd(Field $field)
    {
        return $this->renderBlock('link_collection_end', ['field' => $field]);
    }
}
