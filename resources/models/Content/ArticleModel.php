<?php

namespace App\Content;

use App\Application;

class ArticleModel
{ 
    public function __construct ()
    {}

    public static function createArticle (array $article, Application $app)
    {
        $app->getDB()->query('INSERT INTO d_articles (hash_id, title, author, category_id, publishDate, editedDate, content, slug) VALUES(:hash_id, :title, :author, :category_id, NOW(), NOW(), :content, :slug)');

        $hash_id = md5(uniqid());

        $app->getDB()->bind(':hash_id', $hash_id);
        $app->getDB()->bind(':title', $article['title']);
        $app->getDB()->bind(':author', $app->getModule('Session\Session')->r('id'));
        $app->getDB()->bind(':category_id', $article['category']);
        $app->getDB()->bind(':content', $article['content']);
        $app->getDB()->bind(':slug', 'www');
        
        $app->getDB()->execute();
    }

    public static function editArticle ($id, $article, Application $app)
    {
        $app->getDB()->query('UPDATE d_articles SET title = :title, category_id = :cat, content = :content, editedDate = NOW(), slug = :slug WHERE hash_id = :id');
        $app->getDB()->bind(':id', $id);
        $app->getDB()->bind(':title', $article['title']);
        $app->getDB()->bind(':cat', $article['category']);
        $app->getDB()->bind(':content', $article['content']);
        $app->getDB()->bind(':slug', 'www');
        $app->getDB()->execute();
    }

    public static function deleteArticle ($id, Application $app)
    {
        $app->getDB()->query('DELETE FROM d_articles WHERE hash_id = :id');
        $app->getDB()->bind(':id', $id);
        $app->getDB()->execute();
    }

    public static function getArticle ($id, Application $app)
    {
        $app->getDB()->query('SELECT id, hash_id, title, author, category_id, publishDate, editedDate, content, slug FROM d_articles WHERE hash_id = :id');

        $app->getDB()->bind(':id', $id);

        $app->getDB()->execute();

        $article = $app->getDB()->single();

        return $article;
    }

    public static function getAllArticles ($limit = null, Application $app)
    {
        $app->getDB()->query('SELECT id, hash_id, title, author, category_id, publishDate, content FROM d_articles ORDER BY id DESC');
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
