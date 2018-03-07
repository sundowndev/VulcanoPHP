<?php

namespace App\Content;

use App\Application;
use App\Upload\UploadModel;

class ArticleModel
{
    public static function genHashID ()
    {
        return md5(uniqid());
    }

    public function __construct ()
    {}

    public static function createArticle (array $article, Application $app)
    {
        $article['slug'] = $article['slug'] ?? self::esc_url($article['title']);

        if (!self::getArticle($article['slug'], $app)) {
            $article['hash_id'] = $article['hash_id'] ?? self::genHashID();
            $article['image_url'] = $article['image_url'] ?? '';

            $app->getDB()->query('INSERT INTO d_articles (hash_id, title, author, category_id, publishDate, editedDate, content, slug, image_url) VALUES(:hash_id, :title, :author, :category_id, NOW(), NOW(), :content, :slug, :image_url)');

            $app->getDB()->bind(':hash_id', $article['hash_id']);
            $app->getDB()->bind(':title', $article['title']);
            $app->getDB()->bind(':author', $app->getModule('Session\Session')->r('id'));
            $app->getDB()->bind(':category_id', $article['category']);
            $app->getDB()->bind(':content', $article['content']);
            $app->getDB()->bind(':slug', $article['slug']);
            $app->getDB()->bind(':image_url', $article['image_url']);

            $app->getDB()->execute();

            return $article;
        }else{
            return false;
        }
    }

    public static function editArticle ($id, $article, Application $app)
    {
        $targetArticle = self::getArticle($id, $app);

        $app->getDB()->query('UPDATE d_articles SET title = :title, category_id = :cat, content = :content, editedDate = NOW(), slug = :slug, image_url = :image_url WHERE hash_id = :id');
        $app->getDB()->bind(':id', $id);
        $app->getDB()->bind(':title', $article['title'] ?? $targetArticle['title']);
        $app->getDB()->bind(':cat', $article['category'] ?? $targetArticle['category']);
        $app->getDB()->bind(':content', $article['content'] ?? $targetArticle['content']);
        $app->getDB()->bind(':slug', self::esc_url($article['title']) ?? $targetArticle['slug']);
        $app->getDB()->bind(':image_url', $article['image_url'] ?? $targetArticle['image_url']);

        $app->getDB()->execute();
    }

    public static function deleteArticle ($id, Application $app)
    {
        $article = self::getArticle($id, $app);

        $app->getDB()->query('DELETE FROM d_articles WHERE hash_id = :id');
        $app->getDB()->bind(':id', $id);
        $app->getDB()->execute();

        UploadModel::deleteUpload($article['image_url'], $app);
    }

    public static function getArticle ($id, Application $app)
    {
        $app->getDB()->query('SELECT id, hash_id, title, author, category_id, publishDate, editedDate, content, slug, image_url FROM d_articles WHERE id = :id || hash_id = :hash_id || slug = :slug');

        $app->getDB()->bind(':id', $id);
        $app->getDB()->bind(':hash_id', $id);
        $app->getDB()->bind(':slug', $id);

        $app->getDB()->execute();

        $article = $app->getDB()->single();

        if ($article) {
            $app->getDB()->query('SELECT id, hash_id, username, description, avatar FROM d_users WHERE id = :id');
            $app->getDB()->bind('id', $article['author']);
            $app->getDB()->execute();
            $author = $app->getDB()->single();
            $article['author'] = $author;

            $app->getDB()->query('SELECT id, hash_id, name, slug FROM d_category WHERE id = :id');
            $app->getDB()->bind('id', $article['category_id']);
            $app->getDB()->execute();
            $category = $app->getDB()->single();
            $article['category_hash_id'] = $category['hash_id'];
            $article['category_slug'] = $category['slug'];
            $article['category'] = $category['name'];

            return $article;
        }else{
            return false;
        }
    }

    public static function getAllArticles ($limit = null, Application $app)
    {
        $app->getDB()->query('SELECT id, hash_id, slug, title, author, category_id, publishDate, content, image_url FROM d_articles ORDER BY id DESC');
        $app->getDB()->execute();
        $articles = $app->getDB()->resultset();

        foreach ($articles as $key => $article) {
            $app->getDB()->query('SELECT id, username FROM d_users WHERE id = :id');
            $app->getDB()->bind('id', $articles[$key]['author']);
            $app->getDB()->execute();
            $username = $app->getDB()->resultset();
            $articles[$key]['author'] = $username[0]['username'];

            $app->getDB()->query('SELECT id, hash_id, name, slug FROM d_category WHERE id = :id');
            $app->getDB()->bind('id', $articles[$key]['category_id']);
            $app->getDB()->execute();
            $category = $app->getDB()->single();
            $articles[$key]['category_hash_id'] = $category['hash_id'];
            $articles[$key]['category_slug'] = $category['slug'];
            $articles[$key]['category'] = $category['name'];
        }

        return $articles;
    }

    public static function getArticlesFromCategory ($cat_id, Application $app)
    {
        $app->getDB()->query('SELECT id, hash_id, slug, title, author, category_id, publishDate, content, image_url FROM d_articles WHERE category_id = :cat_id ORDER BY id DESC');
        $app->getDB()->bind(':cat_id', $cat_id);
        $app->getDB()->execute();
        $articles = $app->getDB()->resultset();

        foreach ($articles as $key => $article) {
            $app->getDB()->query('SELECT id, username FROM d_users WHERE id = :id');
            $app->getDB()->bind('id', $articles[$key]['author']);
            $app->getDB()->execute();
            $username = $app->getDB()->resultset();
            $articles[$key]['author'] = $username[0]['username'];

            $app->getDB()->query('SELECT id, hash_id, name, slug FROM d_category WHERE id = :id');
            $app->getDB()->bind('id', $articles[$key]['category_id']);
            $app->getDB()->execute();
            $category = $app->getDB()->single();
            $articles[$key]['category_hash_id'] = $category['hash_id'];
            $articles[$key]['category_slug'] = $category['slug'];
            $articles[$key]['category'] = $category['name'];
        }

        return $articles;
    }

    /*
     * Increase the order of the article
     */
    public static function increaseArticle ($id, Application $app)
    {}

    /*
     * Decrease the order of the article
     */
    public static function decreaseArticle ($id, Application $app)
    {}

    public static function getArticlesByRequest ($req, Application $app)
    {
        $app->getDB()->query('SELECT id, hash_id, slug, title, author, category_id, publishDate, content, image_url FROM d_articles WHERE title LIKE :search || content LIKE :search ORDER BY id DESC');
        $app->getDB()->bind(':search', "%" . $req . "%");
        $app->getDB()->execute();
        $articles = $app->getDB()->resultset();

        foreach ($articles as $key => $article) {
            $app->getDB()->query('SELECT id, username FROM d_users WHERE id = :id');
            $app->getDB()->bind('id', $articles[$key]['author']);
            $app->getDB()->execute();
            $username = $app->getDB()->resultset();
            $articles[$key]['author'] = $username[0]['username'];

            $app->getDB()->query('SELECT id, hash_id, name, slug FROM d_category WHERE id = :id');
            $app->getDB()->bind('id', $articles[$key]['category_id']);
            $app->getDB()->execute();
            $category = $app->getDB()->single();
            $articles[$key]['category_hash_id'] = $category['hash_id'];
            $articles[$key]['category_slug'] = $category['slug'];
            $articles[$key]['category'] = $category['name'];
        }

        return $articles;
    }

    /**
     * Checks and cleans a URL.
     *
     * A number of characters are removed from the URL. The filter
     * is applied to the returned cleaned URL.
     *
     * @param string $text       The STRING to be cleaned.
     * @return string The cleaned $text after the filter is applied.
     */
    public static function esc_url ($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}