<?php
namespace App\Session;
use App\Application;
use App\Session\Session;
class Advert
{
    private $app;
    private $session;

    public function __construct()
    {
        $this->app = new Application;
        $this->session = new Session;
    }

    public function setAdvert($type, $message)
    {
        $advert = array('type' => $type, 'message' => $message);

        $this->session->w('advert', $advert);
    }
}