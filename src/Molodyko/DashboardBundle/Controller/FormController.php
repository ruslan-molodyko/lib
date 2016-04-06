<?php

namespace Molodyko\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AdminBundle\Admin\BookForm;

class FormController extends Controller
{
    /**
     * @Route("/form")
     */
    public function indexAction()
    {
        dump($this->get('molodyko.di.config.service'));die;
        //$this->get('abc');

        $type = $this->get('admin.book.form');
        $html = $this->get('molodyko.dashboard.render.render')->render($type);
        return $this->render('AdminBundle:Block:index.html.twig', ['content' => $html]);
    }
}
