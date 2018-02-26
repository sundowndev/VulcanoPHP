<?php

namespace App\Content;

use App\Application;
use App\Content\ArticleModel;

class CategoryModel
{ 
    public function __construct ()
    {}
    
    public static function createCategory (array $category, Application $app)
    {
        $app->getDB()->query('INSERT INTO d_category (hash_id, name, slug, createdDate, description) VALUES(:hash_id, :name, :slug, NOW(), :description)');
        $app->getDB()->bind(':id', md5(uniqid()));
        $app->getDB()->bind(':name', $category['name']);
        $app->getDB()->bind(':slug', ArticleModel::esc_url($category['name']));
        $app->getDB()->bind(':description', $category['description']);
        $app->getDB()->execute();
    }
    
    public static function editCategory ($id, array $category, Application $app)
    {
        $app->getDB()->query('UPDATE d_category SET name = :name, description = :desc, slug = :slug WHERE slug = :id');
        $app->getDB()->bind(':id', $id);
        $app->getDB()->bind(':name', $category['name']);
        $app->getDB()->bind(':desc', $category['description']);
        $app->getDB()->bind(':slug', ArticleModel::esc_url($category['name']));
        $app->getDB()->execute();
    }
    
    public static function deleteCategory ($id, Application $app)
    {
        $app->getDB()->query('DELETE FROM d_category WHERE hash_id = :id');
        $app->getDB()->bind(':id', $id);
        $app->getDB()->execute();
    }
    
    public static function getCategory ($id, Application $app)
    {
        $app->getDB()->query('SELECT id, hash_id, name, slug, createdDate, description FROM d_category WHERE hash_id = :id');
        $app->getDB()->bind(':id', $id);
        $app->getDB()->execute();
        $category = $app->getDB()->single();

        return $category;
    }
    
    public static function getAllCategories ($limit = null, Application $app)
    {
        $app->getDB()->query('SELECT id, hash_id, name, slug, createdDate, description FROM d_category ORDER BY id DESC');
        $app->getDB()->execute();
        $categories = $app->getDB()->resultset();
        
        return $categories;
    }
    
    public static function increaseCategory ($id)
    {}
    
    public static function decreaseCategory ($id)
    {}
}
