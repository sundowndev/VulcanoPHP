<?php

namespace Controllers\HTTP;

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
        // TODO: vérification CSRF
        if(!empty($_POST['username']) && !empty($_POST['password']))
        {
            $username = $_POST['username'];
            $pw = $_POST['password'];

            $this->getDB()->query('SELECT * FROM d_users WHERE username = :name');
            $this->getDB()->bind(':name', $username);
            $this->getDB()->execute();

            $target = $this->getDB()->single();

            if($target && $this->getModule('Secure\Secure')->verifyHash($pw, $target['password']))
            {
                $this->getModule('Session\Session')->w('auth', true);
                $this->getModule('Session\Session')->w('id', $target['id']);
                $this->getModule('Session\Session')->w('hash_id', $target['hash_id']);
                $this->getModule('Session\Session')->w('username', $target['username']);
                $this->getModule('Session\Session')->w('email', $target['email']);
                $this->getModule('Session\Session')->setCSRF();

                if(!empty($_GET['redirect']))
                {
                    $this->redirect($_GET['redirect']);
                }else{
                    $this->redirect($this->config['paths']['admin'].'/dashboard');
                }
            }else{
                $this->getModule('Session\Advert')->setAdvert('error', 'Bad username or password');
            }
        }

        $this->redirect($this->config['paths']['admin']);
    }

    public function logoutAction ($csrf)
    {
        if($this->getModule('Session\Session')->r('auth') === true && $csrf == $this->getModule('Session\Session')->getCSRF())
        {
            $this->getModule('Session\Session')->w('auth', false);
            $this->getModule('Session\Session')->destroy();
            $this->redirect($this->config['paths']['admin']);
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
        $this->getDB()->query('SELECT hash_id, title, author, category_id, publishDate, content FROM d_articles ORDER BY id DESC');

        $this->getDB()->execute();
        $articles = $this->getDB()->resultset();

        foreach ($articles as $key => $article) {
            $this->getDB()->query('SELECT id, username FROM d_users WHERE id = :id');
            $this->getDB()->bind('id', $articles[$key]['author']);
            $this->getDB()->execute();
            $username = $this->getDB()->resultset();
            $articles[$key]['author'] = $username[0]['username'];

            $this->getDB()->query('SELECT id, hash_id, name FROM d_category WHERE id = :id');
            $this->getDB()->bind('id', $articles[$key]['category_id']);
            $this->getDB()->execute();
            $category = $this->getDB()->single();
            $articles[$key]['category_hash_id'] = $category['hash_id'];
            $articles[$key]['category'] = $category['name'];
        }

        $this->getTwig()->addGlobal('articles', $articles);
        
        $this->render('@admin/manage_articles', ['title' => 'Manage articles', 'page' => 'articles']);
    }

    public function CreateArticleAction ()
    {
        $this->getDB()->query('SELECT id, hash_id, name, slug, createdDate, description FROM d_category ORDER BY id DESC');
        $this->getDB()->execute();
        $categories = $this->getDB()->resultset();

        $this->getTwig()->addGlobal('categories', $categories);
        
        $this->render('@admin/create_article', ['title' => 'Create an article', 'page' => 'articles']);
    }

    public function CreateArticlePostAction ()
    {
        if(!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['category'])){
            $this->getDB()->query('INSERT INTO d_articles (hash_id, title, author, category_id, publishDate, editedDate, content) VALUES(:hash_id, :title, :author, :category_id, NOW(), NOW(), :content)');

            $hash_id = md5(uniqid());

            $this->getDB()->bind(':hash_id', $hash_id);
            $this->getDB()->bind(':title', $_POST['title']);
            $this->getDB()->bind(':author', $this->getModule('Session\Session')->r('id'));
            $this->getDB()->bind(':category_id', $_POST['category']);
            $this->getDB()->bind(':content', $_POST['content']);

            $this->getDB()->execute();

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

        $this->getTwig()->addGlobal('POST', $_POST);

        $this->redirect($this->config['paths']['admin'] . '/create/article');
    }

    public function EditArticleAction ($id)
    {
        $this->getDB()->query('SELECT * FROM d_articles WHERE hash_id = :id');

        $this->getDB()->bind(':id', $id);

        $this->getDB()->execute();

        $article = $this->getDB()->single();

        $this->getTwig()->addGlobal('article', $article);

        if(file_exists($this->webroot.$this->config['paths']['uploads'].'/'.$article['hash_id'].'.jpg')){
            $cover = $this->config['paths']['uploads'].'/'.$article['hash_id'].'.jpg';

            $this->getTwig()->addGlobal('cover', $cover);
        }

        $this->getDB()->query('SELECT * FROM d_category');

        $this->getDB()->execute();

        $categories = $this->getDB()->resultset();

        $this->getTwig()->addGlobal('categories', $categories);
        
        $this->render('@admin/edit_article', ['title' => 'Edit an article', 'id' => $id, 'page' => 'articles']);
    }

    public function EditArticlePostAction ($id)
    {
        if(!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['category'])){
            $this->getDB()->query('UPDATE d_articles SET title = :title, category_id = :cat, content = :content, editedDate = NOW() WHERE hash_id = :id');

            $this->getDB()->bind(':id', $id);
            $this->getDB()->bind(':title', $_POST['title']);
            $this->getDB()->bind(':cat', $_POST['category']);
            $this->getDB()->bind(':content', $_POST['content']);

            $this->getDB()->execute();

            if (!empty($_FILES['cover'])) {
                //set max. file size (2 in mb)
                $upload = Upload::factory('content/uploads');

                $upload->set_max_file_size(10);
                //set allowed mime types
                $upload->set_allowed_mime_types(array('image/jpeg','image/png'));

                $upload->file($_FILES['cover']);
                $results = $upload->upload($filename = $article['hash_id']);
            }

            $this->getModule('Session\Advert')->setAdvert('success', 'You successfully edited your article!');
        }

        $this->getTwig()->addGlobal('POST', $_POST);

        $this->redirect($this->config['paths']['admin'] . '/manage/article/' . $id);
    }

    public function DeleteArticleAction ($id, $csrf)
    {
        if(!empty($id) && !empty($csrf) && $csrf === $this->getModule('Session\Session')->r('csrf')){
            $this->getDB()->query('DELETE FROM d_articles WHERE hash_id = :id');
            $this->getDB()->bind(':id', $id);
            $this->getDB()->execute();

            $this->deleteUpload($id . '.jpg');

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
        $this->getDB()->query('SELECT hash_id, name, slug, createdDate, description FROM d_category ORDER BY id DESC');
        $this->getDB()->execute();
        $categories = $this->getDB()->resultset();

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
            $this->getDB()->query('INSERT INTO d_category (hash_id, name, slug, createdDate, description) VALUES(:hash_id, :name, :slug, NOW(), :description)');

            $this->getDB()->bind(':hash_id', md5(uniqid()));
            $this->getDB()->bind(':name', $_POST['name']);
            $this->getDB()->bind(':slug', 'www');
            $this->getDB()->bind(':description', $_POST['description']);

            $this->getDB()->execute();

            $this->getModule('Session\Advert')->setAdvert('success', 'You successfully created your category!');
        }

        $this->redirect($this->config['paths']['admin'] . '/manage/categories');
    }

    public function EditCategoryAction ($id)
    {
        $this->getDB()->query('SELECT hash_id, name, slug, createdDate, description FROM d_category WHERE hash_id = :id');

        $this->getDB()->bind('id', $id);

        $this->getDB()->execute();

        $category = $this->getDB()->single();

        if(!$category){
            $this->redirect($this->config['paths']['admin'].'/404');
        }

        $this->getTwig()->addGlobal('category', $category);
        
        $this->render('@admin/edit_category', ['title' => 'Edit an category', 'id' => $id, 'page' => 'categories']);
    }

    public function EditCategoryPostAction ($id)
    {
        if(!empty($_POST['name']) && !empty($_POST['csrf']) && $_POST['csrf'] === $this->getModule('Session\Session')->r('csrf')){
            $this->getDB()->query('UPDATE d_category SET name = :name, description = :desc WHERE hash_id = :hash_id');

            $this->getDB()->bind(':name', $_POST['name']);
            $this->getDB()->bind(':hash_id', $id);
            $this->getDB()->bind(':desc', $_POST['description']);

            $this->getDB()->execute();

            $this->getModule('Session\Advert')->setAdvert('success', 'You successfully edited your category!');
        }

        $this->getTwig()->addGlobal('POST', $_POST);

        $this->redirect($this->config['paths']['admin'] . '/manage/category/' . $id);
    }

    public function DeleteCategoryAction ($id, $csrf)
    {
        if(!empty($id) && !empty($csrf) && $csrf === $this->getModule('Session\Session')->r('csrf')){
            $this->getDB()->query('DELETE FROM d_category WHERE hash_id = :id');
            $this->getDB()->bind(':id', $id);
            $this->getDB()->execute();

            $this->getModule('Session\Advert')->setAdvert('success', 'You successfully deleted a category');

            $this->redirect($this->config['paths']['admin'].'/manage/categories');
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
    {}

    public function CreateUserAction ()
    {
        $this->render('@admin/create_category', ['title' => 'Create a category', 'page' => 'categories']);
    }

    public function CreateUserPostAction ()
    {
        $this->redirect($this->config['paths']['admin'] . '/manage/categories');
    }

    public function EditUserAction ($id)
    {
        $this->render(['models' => 'admin/edit_user', 'views' => '@admin/edit_user'], ['title' => 'Edit an user', 'id' => $id, 'page' => 'users']);
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
     * Uploads
     *
     * File uploads management
     */
    public function ManageUploadsAction ()
    {}

    public function CreateUploadAction ()
    {
        $this->render('@admin/create_upload', ['title' => 'Upload a file', 'page' => 'uploads']);
    }

    public function CreateUploadPostAction ()
    {
        $this->redirect($this->config['paths']['admin'] . '/manage/categories');
    }

    public function EditUploadAction ($id)
    {}

    public function EditUploadPostAction ($id)
    {
        $this->redirect($this->config['paths']['admin'] . '/manage/categories');
    }

    public function DeleteUploadAction ($id, $csrf)
    {
        $this->render(['models' => 'admin/delete_uploads'], ['id' => $id, 'token' => $token, 'page' => 'uploads']);
    }

    /* Configuration */
    public function ConfigurationAction ()
    {
        $this->render('@admin/configuration', ['title' => 'Configuration', 'page' => 'configuration']);
    }

    public function ConfigurationPostAction ()
    {
        if(isset($_POST['saveConfig']))
        {
            //
        }

        $this->redirect($this->config['paths']['admin'] . '/configuration');
    }

    public function AppearanceAction ()
    {
        $this->render('@admin/appearance', ['title' => 'Appearance', 'page' => 'configuration']);
    }

    public function PluginsAction ()
    {
        $this->render('@admin/plugins', ['title' => 'Plugins', 'page' => 'configuration']);
    }

    /* Settings */
    public function SettingsAction ()
    {
        $this->render('@admin/settings', ['title' => 'Mes paramètres', 'page' => 'settings']);
    }

    public function SettingsGeneralPostAction ()
    {
        if(!empty($_POST['username'])){
            $this->getDB()->query('UPDATE d_users SET username = :username WHERE id = :id');

            $this->getDB()->bind(':id', $this->getModule('Session\Session')->r('id'));
            $this->getDB()->bind(':username', $_POST['username']);

            $this->getDB()->execute();

            $this->getModule('Session\Session')->w('username', $_POST['username']);

            if (!empty($_FILES['avatar'])) {
                //set max. file size (2 in mb)
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

        $this->getTwig()->addGlobal('POST', $_POST);

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

        $this->getTwig()->addGlobal('POST', $_POST);

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
    
    /* extra methods */
    public function deleteUpload ($file)
    {
        // UploadModel::deleteUpload($file);

        if(file_exists($this->config['paths']['uploads'].'/'.$file)){
            \unlink($this->webroot . $this->config['paths']['uploads'].'/' . $file);
        }else{
            return false;
        }
    }
}
