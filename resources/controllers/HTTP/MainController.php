<?php

namespace Controllers\HTTP;

use App\Content\ArticleModel;
use App\Content\CategoryModel;

class MainController extends \App\Application
{

    public function HomeAction ()
    {
        $categories = CategoryModel::getAllCategories(null, $this);
        $this->getTwig()->addGlobal('categories', $categories);

        $articles = ArticleModel::getAllArticles(null, $this);

        $this->getTwig()->addGlobal('articles', $articles);

        $this->render('home/home');
    }

    public function SearchAction ()
    {
        // Handle search request
        $request = $_GET['q'];
        $this->getTwig()->addGlobal('request', $request);

        $categories = CategoryModel::getAllCategories(null, $this);
        $this->getTwig()->addGlobal('categories', $categories);

        $articles = ArticleModel::getArticlesByRequest($request, $this);
        $this->getTwig()->addGlobal('articles', $articles);

        $this->render('blog/search', ['title' => $request]);
    }

    public function SingleArticleAction ($id)
    {
        if (!$article = ArticleModel::getArticle($id, $this)) {
            $this->ErrorAction();
        }

        $categories = CategoryModel::getAllCategories(null, $this);
        $this->getTwig()->addGlobal('categories', $categories);

        $this->getTwig()->addGlobal('article', $article);

        $this->render('blog/single_article', ['title' => $article['title']]);
    }

    public function CategoriesAction ()
    {
        $this->render('categories/categories', ['title' => 'Categories']);
    }

    public function SingleCategoryAction ($id)
    {
        if (!$category = CategoryModel::getCategory($id, $this)) {
            $this->ErrorAction();
        }

        $categories = CategoryModel::getAllCategories(null, $this);
        $this->getTwig()->addGlobal('categories', $categories);

        $articles = ArticleModel::getArticlesFromCategory($category['id'], $this);

        $this->getTwig()->addGlobal('category', $category);
        $this->getTwig()->addGlobal('articles', $articles);

        $this->render('blog/single_category', ['title' => $category['name']]);
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
