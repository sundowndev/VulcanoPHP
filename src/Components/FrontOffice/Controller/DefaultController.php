<?php

namespace App\Components\FrontOffice\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class DefaultController
 * @package App\Controller
 *
 * @Route("/", name="default_")
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
        return $this->render('@default/index.html.twig');
    }

    /**
     * Show single category's articles
     *
     * @Route("/category/{slug}", name="single_category")
     * @Method("GET")
     */
    public function single_categoryAction ($slug)
    {
        return $this->render('@default/index.html.twig');
    }

    /**
     * Show one article
     *
     * @Route("/article/{slug}", name="single_article")
     * @Method("GET")
     */
    public function single_articleAction ($slug)
    {
        return $this->render('@default/index.html.twig');
    }

    /**
     * Search page
     *
     * @Route("/search", name="search")
     * @Method("GET")
     */
    public function searchAction ()
    {
        return $this->render('@default/search.html.twig');
    }
}
