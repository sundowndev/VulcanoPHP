<?php

namespace App\Controller\FrontOffice;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class DefaultController
 * @package App\Controller
 *
 * @Route("/")
 */
class DefaultController extends Controller
{
    /**
     * Home page
     *
     * @Route("/", name="index")
     * @Method("GET")
     */
    public function index ()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * Show single category's articles
     *
     * @Route("/category/{slug}", name="single_category")
     * @Method("GET")
     */
    public function single_category ($slug)
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * Show one article
     *
     * @Route("/article/{slug}", name="single_article")
     * @Method("GET")
     */
    public function single_article ($slug)
    {
        return $this->render('default/index.html.twig');
    }
}
