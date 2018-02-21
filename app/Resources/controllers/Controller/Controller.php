<?php

namespace Controllers\MainController;

use App\Application;
use App\Session\Session;

class Controller
{

    private $app;
    private $session;

    public function __construct () {
        $this->app = new Application();
        $this->session = new Session();
    }

    public function homeAction () {
        $app->render(['models' => 'home', 'views' => 'home/home'], ['title' => 'Welcome']);
    }

    public function aboutAction () {}

    public function ErrorAction () {
        echo 'test';
    }
}
