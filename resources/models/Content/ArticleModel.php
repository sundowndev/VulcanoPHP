<?php
namespace App\Content;

use App\Application;

class ArticleModel
{ 
    public function __construct () {}

    public static function createArticle ($article) {}

    public static function editArticle ($id, $article) {}

    public static function deleteArticle ($id) {}

    public static function getArticle ($id) {}

    public static function getAllArticles ($limit = null, Application $app) {
        $app->getDB()->query('SELECT hash_id, title, author, category_id, publishDate, content FROM d_articles ORDER BY id DESC');

        $app->getDB()->execute();
        $articles = $app->getDB()->resultset();

        foreach ($articles as $key => $article) {
            $app->getDB()->query('SELECT id, username FROM d_users WHERE id = :id');
            $app->getDB()->bind('id', $articles[$key]['author']);
            $app->getDB()->execute();
            $username = $app->getDB()->resultset();
            $articles[$key]['author'] = $username[0]['username'];

            $app->getDB()->query('SELECT id, hash_id, name FROM d_category WHERE id = :id');
            $app->getDB()->bind('id', $articles[$key]['category_id']);
            $app->getDB()->execute();
            $category = $app->getDB()->single();
            $articles[$key]['category_hash_id'] = $category['hash_id'];
            $articles[$key]['category'] = $category['name'];
        }

        return $articles;
    }

    public static function increaseArticle ($id, Application $app)
    {}

    public static function decreaseArticle ($id)
    {}
}
