<?php

namespace Controllers\HTTP;

use App\Session\Auth;
use App\Content\ArticleModel;
use App\Content\CategoryModel;
use App\Upload\UploadModel;
use App\User\UserModel;
//TODO delete pure upload methods
use App\Upload\Upload;

class AdminController extends MainController
{

    /*
     * Authentification
     *
     * Sign in & sign out features
     */
    public function loginAction ()
    {
        $this->render('@admin/login', ['title' => 'Login', 'page' => 'login']);
    }

    public function loginPostAction ()
    {
        Auth::login($_POST['username'], $_POST['password'], $this);

        if (!Auth::isLogged() || Auth::isAdmin()){
            $this->redirect($this->config['paths']['admin']);
        }elseif (Auth::isLogged() && !Auth::isAdmin()) {
            $this->redirect($this->config['paths']['home']);
        }
    }

    public function logoutAction ($csrf)
    {
        if (Auth::logout($csrf, $this))
        {
            $this->redirect($app->config['paths']['admin']);
        } else {
            $this->ErrorAction();
        }
    }

    public function DashboardAction ()
    {
        $this->render('@admin/dashboard', ['title' => 'Dashboard', 'page' => 'dashboard']);
    }

    /*
     * Articles
     *
     * Articles management
     */
    public function ManageArticlesAction ()
    {
        $articles = ArticleModel::getAllArticles(null, $this);

        $this->getTwig()->addGlobal('articles', $articles);
        
        $this->render('@admin/manage_articles', ['title' => 'Manage articles', 'page' => 'articles']);
    }

    public function CreateArticleAction ()
    {
        $categories = CategoryModel::getAllCategories(null, $this);

        $this->getTwig()->addGlobal('categories', $categories);
        
        $this->render('@admin/create_article', ['title' => 'Create an article', 'page' => 'articles']);
    }

    public function CreateArticlePostAction ()
    {
        if(!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['category'])){
            ArticleModel::createArticle([
                'title' => $_POST['title'],
                'category' => $_POST['category'],
                'content' => $_POST['content']
            ], $this);
            if (!empty($_FILES['cover'])) {
                //set max. file size (2 in mb)
                $upload = Upload::factory('content/uploads');
                $upload->set_max_file_size(10);
                //set allowed mime types
                $upload->set_allowed_mime_types(array('image/jpeg','image/png'));
                $upload->file($_FILES['cover']);
                $results = $upload->upload($filename = $hash_id);
                // TODO: stocker l'extension dans la colonne image_url
            }
            $this->getModule('Session\Advert')->setAdvert('success', 'You successfully published your article!');
            $this->redirect($this->config['paths']['admin'].'/manage/articles');
        }else{
            $this->getModule('Session\Advert')->setAdvert('danger', "You didn't complete all fields");
        }
        $this->redirect($this->config['paths']['admin'] . '/create/article');
    }

    public function EditArticleAction ($id)
    {
        if ($article = ArticleModel::getArticle($id, $this)) {
            $categories = CategoryModel::getAllCategories(null, $this);

            if ($cover = UploadModel::fileExist($article['hash_id'] . '.jpg', $this)) {
                $this->getTwig()->addGlobal('cover', $cover);
            }

            $this->getTwig()->addGlobal('article', $article);
            $this->getTwig()->addGlobal('categories', $categories);

            $this->render('@admin/edit_article', ['title' => 'Edit an article', 'id' => $id, 'page' => 'articles']);
        }else{
            $this->AdminErrorAction();
        }
    }

    public function EditArticlePostAction ($id)
    {
        $article = ArticleModel::getArticle($id, $this);

        if(!empty($_POST['id']) && !empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['category'])){
            ArticleModel::editArticle($_POST['id'], [
                'title' => $_POST['title'],
                'category' => $_POST['category'],
                'content' => $_POST['content']
            ], $this);

            $newSlug = ArticleModel::esc_url($_POST['title']);

            if (!empty($_FILES['cover']))
            {
                $upload = Upload::factory('content/uploads');

                $upload->set_max_file_size(10);
                //set allowed mime types
                $upload->set_allowed_mime_types(array('image/jpeg','image/png'));

                $upload->file($_FILES['cover']);
                $results = $upload->upload($filename = $article['hash_id']);
            }

            $this->getModule('Session\Advert')->setAdvert('success', 'You successfully edited your article!');
        }

        $this->redirect($this->config['paths']['admin'] . '/manage/article/' . $newSlug);
    }

    public function DeleteArticleAction ($id, $csrf)
    {
        if(!empty($id) && !empty($csrf) && $csrf === $this->getModule('Session\Session')->r('csrf')){
            ArticleModel::deleteArticle($id, $this);

            $this->getModule('Session\Advert')->setAdvert('success', 'Article deleted');

            $this->redirect($this->config['paths']['admin'].'/manage/articles');
        }else{
            $this->AdminErrorAction();
        }
    }

    /*
     * Categories
     *
     * Categories management
     */
    public function ManageCategoriesAction ()
    {
        $categories = CategoryModel::getAllCategories(null, $this);

        $this->getTwig()->addGlobal('categories', $categories);
        
        $this->render('@admin/manage_categories', ['title' => 'Manage categories', 'page' => 'categories']);
    }

    public function CreateCategoryAction ()
    {
        $this->render('@admin/create_category', ['title' => 'Create a category', 'page' => 'categories']);
    }

    public function CreateCategoryPostAction ()
    {
        if(!empty($_POST['name'])){
            $description = $_POST['description'] ?? '';

            CategoryModel::createCategory([
                'name' => $_POST['name'],
                'description' => $description
            ], $this);

            $this->getModule('Session\Advert')->setAdvert('success', 'You successfully created your category!');
        }

        $this->redirect($this->config['paths']['admin'] . '/manage/categories');
    }

    public function EditCategoryAction ($id)
    {
        if(!$category = CategoryModel::getCategory($id, $this)) {
            $this->AdminErrorAction();
        }

        $this->getTwig()->addGlobal('category', $category);
        
        $this->render('@admin/edit_category', ['title' => 'Edit an category', 'id' => $id, 'page' => 'categories']);
    }

    public function EditCategoryPostAction ($id)
    {
        if(!empty($_POST['name']) && !empty($_POST['csrf']) && $_POST['csrf'] === $this->getModule('Session\Session')->r('csrf')){
            $description = $_POST['description'] ?? '';

            CategoryModel::editCategory($id, [
                'name' => $_POST['name'],
                'description' => $description
            ], $this);

            $newSlug = ArticleModel::esc_url($_POST['title']);

            $this->getModule('Session\Advert')->setAdvert('success', 'You successfully edited your category!');
        }

        $this->redirect($this->config['paths']['admin'] . '/manage/category/' . $newSlug);
    }

    public function DeleteCategoryAction ($id, $csrf)
    {
        if(!empty($id) && !empty($csrf) && $csrf === $this->getModule('Session\Session')->r('csrf')){
            CategoryModel::deleteCategory($id, $this);

            $this->getModule('Session\Advert')->setAdvert('success', 'You successfully deleted a category');
        }else{
            $this->AdminErrorAction();
        }

        $this->redirect($this->config['paths']['admin'] . '/manage/categories');
    }

    /*
     * Users
     *
     * Users management
     */
    public function ManageUsersAction ()
    {
        UserModel::getAllUsers(null, $this);

        $this->render('@admin/manage_users');
    }

    public function CreateUserAction ()
    {
        $this->render('@admin/create_user', ['title' => 'Create a category', 'page' => 'categories']);
    }

    public function CreateUserPostAction ()
    {
        //validator

        $this->redirect($this->config['paths']['admin'] . '/manage/users');
    }

    public function EditUserAction ($id)
    {
        $user = UserModel::getUser($id, $this);
        //$user to twig

        $this->render('@admin/edit_user', ['title' => 'Edit an user', 'id' => $id, 'page' => 'users']);
    }

    public function EditUserPostAction ($id)
    {
        $this->redirect($this->config['paths']['admin'] . '/manage/categories');
    }

    public function DeleteUserAction ($id, $csrf)
    {
        $this->render(['models' => 'admin/delete_user'], ['id' => $id, 'token' => $token, 'page' => 'users']);
    }

    /*
     * Configuration
     *
     * Modify the general configuration
     */
    public function ConfigurationAction ()
    {
        $this->render('@admin/configuration', ['title' => 'Configuration', 'page' => 'configuration']);
    }

    public function ConfigurationPostAction ()
    {
        if (!empty($_POST['saveConfig']))
        {
            //
        }

        $this->redirect($this->config['paths']['admin'] . '/configuration');
    }

    /*
     * Settings
     *
     * User settings
     */
    public function SettingsAction ()
    {
        $user = UserModel::getUser($this->getModule('Session\Session')->r('id'), $this);
        $this->getTwig()->addGlobal('user', $user);

        $this->render('@admin/settings', ['title' => 'Mes paramètres', 'page' => 'settings']);
    }

    public function SettingsGeneralPostAction ()
    {
        if(!empty($_POST['username'])){
            $this->getDB()->query('UPDATE d_users SET username = :username, description = :desc WHERE id = :id');

            $this->getDB()->bind(':id', $this->getModule('Session\Session')->r('id'));
            $this->getDB()->bind(':username', $_POST['username']);
            $this->getDB()->bind(':desc', $_POST['desc']);

            $this->getDB()->execute();

            $this->getModule('Session\Session')->w('username', $_POST['username']);

            if (!empty($_FILES['avatar'])) {
                $upload = Upload::factory('content/uploads/avatars');

                $upload->set_max_file_size(10);
                //set allowed mime types
                $upload->set_allowed_mime_types(array('image/jpeg','image/png'));

                $upload->file($_FILES['avatar']);
                $results = $upload->upload($filename = $this->getModule('Session\Session')->r('hash_id'));
            }

            $this->getModule('Session\Advert')->setAdvert('success', 'Changes has been saved');
        }else{
            $this->getModule('Session\Advert')->setAdvert('danger', 'Please enter a valid username that respect the format : a-Z0-9-_');
        }

        $this->redirect($this->config['paths']['admin'] . '/settings');
    }

    public function SettingsEmailPostAction ()
    {
        if(!empty($_POST['newemail']) && !empty($_POST['password'])){
            $this->getDB()->query('SELECT * FROM d_users WHERE id = :id');

            $this->getDB()->bind(':id', $this->getModule('Session\Session')->r('id'));

            $this->getDB()->execute();

            $user = $this->getDB()->single();

            if($this->getModule('Secure\Secure')->verifyHash($_POST['password'], $user['password'])){

                if (filter_var($_POST['newemail'], FILTER_VALIDATE_EMAIL)){
                    $this->getDB()->query('UPDATE d_users SET email = :email WHERE id = :id');

                    $this->getDB()->bind(':id', $this->getModule('Session\Session')->r('id'));

                    $this->getDB()->bind(':email', $_POST['newemail']);

                    $this->getDB()->execute();

                    $this->getModule('Session\Advert')->setAdvert('success', 'Changes has been saved');

                    $this->getModule('Session\Session')->w('email', $_POST['newemail']);
                }else{
                    $this->getModule('Session\Advert')->setAdvert('danger', 'Invalid email address');
                }
            }else{
                $this->getModule('Session\Advert')->setAdvert('danger', 'Incorrect password');
            }

        }else{
            $this->getModule('Session\Advert')->setAdvert('danger', 'Please fill all the fields');
        }

        $this->redirect($this->config['paths']['admin'] . '/settings');
    }

    public function SettingsPasswordPostAction ()
    {
        if(!empty($_POST['actualpassword']) && !empty($_POST['newpassword']) && !empty($_POST['repeatpassword'])){
            $this->getDB()->query('SELECT * FROM d_users WHERE id = :id');

            $this->getDB()->bind(':id', $this->getModule('Session\Session')->r('id'));

            $this->getDB()->execute();

            $user = $this->getDB()->single();

            if($this->getModule('Secure\Secure')->verifyHash($_POST['actualpassword'], $user['password'])){

                if ($_POST['newpassword'] === $_POST['repeatpassword']){
                    $this->getDB()->query('UPDATE d_users SET password = :pwd WHERE id = :id');

                    $this->getDB()->bind(':id', $this->getModule('Session\Session')->r('id'));

                    $this->getDB()->bind(':pwd', $this->getModule('Secure\Secure')->hash_pass($_POST['newpassword']));

                    $this->getDB()->execute();

                    $this->getModule('Session\Advert')->setAdvert('success', 'New password has been saved');
                }else{
                    $this->getModule('Session\Advert')->setAdvert('danger', 'Passwords are different');
                }
            }else{
                $this->getModule('Session\Advert')->setAdvert('danger', 'Incorrect password');
            }

        }else{
            $this->getModule('Session\Advert')->setAdvert('danger', 'Please fill all the fields');
        }

        $this->redirect($this->config['paths']['admin'] . '/settings');
    }
    
    public function AdminErrorAction ()
    {
        $this->render('@admin/404', ['title' => 'Page not found']);
    }
}
