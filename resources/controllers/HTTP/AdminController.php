<?php

namespace Controllers\HTTP;

use App\Upload\Upload;


class AdminController extends MainController
{

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

        $this->render('@admin/login', ['title' => 'Login', 'page' => 'login']);
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
    
    /* Articles */
    public function ManageArticlesAction ()
    {}
    
    public function CreateArticleAction ()
    {}
    
    public function EditArticleAction ($id)
    {}
    
    /* Categories */
    public function ManageCategoriesAction ()
    {}
    
    public function CreateCategoryAction ()
    {}
    
    public function EditCategoryAction ($id)
    {}

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
