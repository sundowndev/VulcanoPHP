<?php

namespace Controllers\Admin;

use \App\Application;

class Controller
{
    
    private $app;
    private $session;
    
    public function __construct () {
        $this->app = new \App\Application;
        $this->session = new \App\Session\Session;
    }
    
    public function logoutAction ($token) {
        if($this->session->r('auth') === true && $token == $this->session->getCSRF()){
            $this->session->destroy();
            $this->app->redirect($this->app->config['paths']['admin']);
        } else {
            $this->app->redirect('/404');
        }
    }
}