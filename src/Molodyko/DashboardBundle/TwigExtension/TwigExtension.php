<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 15.04.2016
 * Time: 1:07
 */

namespace Molodyko\DashboardBundle\TwigExtension;

use Molodyko\DashboardBundle\Util\InjectContainerTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class TwigExtension extends \Twig_Extension {

    use InjectContainerTrait;

    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * Main twig template file
     *
     * @var string
     */
    protected $template;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->twig = $this->getContainer()->get('twig');
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param string $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }

    /**
     * @return \Twig_Environment
     */
    public function getTwig()
    {
        return $this->twig;
    }

    /**
     * Render block
     *
     * @param string $block
     * @param array|null $params
     * @return string
     * @throws \Exception
     * @throws \Twig_Error
     */
    protected function renderBlock($block, array $params = []) {

        return $this->getTwig()->loadTemplate($this->getTemplate())->renderBlock(
            $block,
            $this->getTwig()->mergeGlobals($params)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'custom_twig_extension';
    }
}
