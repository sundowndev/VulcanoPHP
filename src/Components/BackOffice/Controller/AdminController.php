<?php

namespace App\Components\BackOffice\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/", name="admin_")
 */
class AdminController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index ()
    {
        return $this->render('@admin/index.html.twig');
    }
}
