<?php

namespace Controllers\Admin;

use App\Application;
use App\Session\Session;

class Controller
{
    
    private $app;
    private $session;
    
    public function __construct () {
        $this->app = new Application;
        $this->session = new Session;
    }
    
    public function dashboardAction () {}
    
    /* Articles */
    public function manageArticlesAction () {}
    
    public function createArticleAction () {}
    
    public function editArticleAction ($id) {}
    
    /* Categories */
    public function manageCategoriesAction () {}
    
    public function createCategoryAction () {}
    
    public function editCategoryAction ($id) {}
    
    public function configAction () {}
    
    public function settingsAction () {}
    
    public function logoutAction ($token) {
        if($this->session->r('auth') === true && $token == $this->session->getCSRF()){
            $this->session->destroy();
            $this->app->redirect($this->app->config['paths']['admin']);
        } else {
            $this->app->redirect('/404');
        }
    }
    
    /* extra methods */
    public function deleteUpload ($file) {
        if(file_exists($this->app->config['paths']['uploads'].'/'.$file)){
            \unlink($this->app->webroot . $this->app->config['paths']['uploads'].'/' . $file);
        }else{
            return false;
        }
    }
}
