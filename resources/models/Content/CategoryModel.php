<?php
namespace App\Content;

use App\Application;

class CategoryModel
{ 
    public function __construct ()
    {}
    
    public static function createCategory ($category, Application $app)
    {
        $app->getDB()->query('INSERT INTO d_category (hash_id, name, slug, createdDate, description) VALUES(:hash_id, :name, :slug, NOW(), :description)');
        $app->getDB()->bind(':hash_id', md5(uniqid()));
        $app->getDB()->bind(':name', $category['name']);
        $app->getDB()->bind(':slug', 'www');
        $app->getDB()->bind(':description', $category['description']);
        $app->getDB()->execute();
    }
    
    public static function editCategory ($id, $category, Application $app)
    {
        $app->getDB()->query('UPDATE d_category SET name = :name, description = :desc WHERE hash_id = :hash_id');
        $app->getDB()->bind(':hash_id', $id);
        $app->getDB()->bind(':name', $category['name']);
        $app->getDB()->bind(':desc', $category['description']);
        $app->getDB()->execute();
    }
    
    public static function deleteCategory ($id)
    {}
    
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
