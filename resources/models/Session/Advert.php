<?php

namespace App\Session;

use App\Application;
use App\Session\Session;

class Advert
{
    private $app;
    private $session;

    private $adverts = [];
    
    public function __construct()
    {
        $this->app = new Application;
        $this->session = new Session;
    }

    public function setAdvert($type, $message)
    {
        array_push(
            $this->adverts, [
            'type' => $type,
            'message' => $message
        ]);

        $this->WriteAdvertSession();
    }

    public function setAdverts($type, array $messages)
    {
        foreach ($messages as $message)
        {
            array_push(
                $this->adverts, [
                'type' => $type,
                'message' => $message
            ]);
        }

        $this->WriteAdvertSession();
    }

    public function WriteAdvertSession ()
    {
        $this->session->w('advert', $this->adverts);
    }
}

?>