<?php

namespace Controllers\Controller;

use App\Application;
use App\Session\Session;

class Controller extends Application
{

    private $app;
    private $session;

    public function __construct () {
        $this->app = new Application();
        $this->session = new Session();
    }

    public function HomeAction () {
        $app->getDB()->query('SELECT title,author,category_id,content,publishDate,editedDate FROM d_articles ORDER BY id DESC LIMIT 0, 6');
        $app->getDB()->execute();

        $articles = $app->getDB()->resultset();

        foreach ($articles as $key => $article) {
            $app->getDB()->query('SELECT id,username FROM d_users WHERE id = :id');
            $app->getDB()->bind('id', $articles[$key]['author']);
            $app->getDB()->execute();
            $username = $app->getDB()->resultset();
            $articles[$key]['author'] = $username[0]['username'];

            $app->getDB()->query('SELECT id,name FROM d_category WHERE id = :id');
            $app->getDB()->bind('id', $articles[$key]['category_id']);
            $app->getDB()->execute();
            $category = $app->getDB()->resultset();
            $articles[$key]['category'] = $category[0]['name'];
        }

        $app->getTwig()->addGlobal('articles', $articles);

        $app->render(['models' => 'home', 'views' => 'home/home'], ['title' => 'Welcome']);
    }

    public function aboutAction () {}

    public function ErrorAction () {
        echo 'test';
    }
}
