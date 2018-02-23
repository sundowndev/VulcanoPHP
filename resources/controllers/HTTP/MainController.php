<?php

namespace Controllers\HTTP;

class MainController extends \App\Application
{

    public function HomeAction ()
    {
        $this->getDB()->query('SELECT * FROM d_articles ORDER BY id DESC LIMIT 0, 6');
        $this->getDB()->execute();

        $articles = $this->getDB()->resultset();

        foreach ($articles as $key => $article) {
            $this->getDB()->query('SELECT id,username FROM d_users WHERE id = :id');
            $this->getDB()->bind('id', $articles[$key]['author']);
            $this->getDB()->execute();
            $username = $this->getDB()->resultset();
            $articles[$key]['author'] = $username[0]['username'];

            $this->getDB()->query('SELECT id,name FROM d_category WHERE id = :id');
            $this->getDB()->bind('id', $articles[$key]['category_id']);
            $this->getDB()->execute();
            $category = $this->getDB()->resultset();
            $articles[$key]['category'] = $category[0]['name'];
        }

        $this->getTwig()->addGlobal('articles', $articles);

        $this->render('home/home', ['title' => 'Welcome']);
    }

    public function SearchAction ()
    {
        $this->render('search', ['title' => 'Search']);
    }

    public function BlogAction ()
    {
        $this->render('blog/blog', ['title' => 'Blog']);
    }

    public function AboutAction ()
    {
        $this->render('about/about', ['title' => 'About']);
    }

    public function ContactAction ()
    {
        $this->render('contact/contact', ['title' => 'Me contacter']);
    }

    public function SingleArticleAction ($id)
    {
        $this->render('articles/single_article', ['title' => '']);
    }

    public function CategoriesAction ()
    {
        $this->render('categories/categories', ['title' => 'Categories']);
    }

    public function SingleCategoryAction ()
    {
        $this->render('categories/single_category', ['title' => '']);
    }

    public function SingleUserAction ()
    {
        $this->render('users/single_user', ['title' => '']);
    }

    public function ErrorAction ()
    {
        $this->render('404/404', ['title' => 'Page not found']);
    }
}
