<?php

namespace App\Components\FrontOffice\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/auth", name="auth")
 */
class AuthController extends Controller
{
    /**
     * Sign in form page
     *
     * @Route("/", name="signin")
     * @Method("GET")
     */
    public function signinAction ()
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * Sign in form page validation
     *
     * @Route("/", name="signinPost")
     * @Method("POST")
     */
    public function signinPostAction ()
    {
        // code
    }
}