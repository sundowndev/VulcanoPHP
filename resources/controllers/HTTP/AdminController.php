<?php

namespace Controllers\HTTP;


class AdminController extends MainController
{

    public function dashboardAction ()
    {
        echo 'dashboard';
    }
    
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

    public function loginAction ()
    {
        //
    }

    public function logoutAction ($csrf)
    {
        if($this->getModule('Session\Session')->r('auth') === true && $csrf == $this->getModule('Session\Session')->getCSRF()){
            $this->getModule('Session\Session')->w('auth', false);
            $this->getModule('Session\Session')->destroy();
            $this->redirect($this->config['paths']['admin']);
        } else {
            $this->redirect('/404');
        }
    }
    
    /* extra methods */
    public function deleteUpload ($file)
    {
        if(file_exists($this->config['paths']['uploads'].'/'.$file)){
            \unlink($this->webroot . $this->config['paths']['uploads'].'/' . $file);
        }else{
            return false;
        }
    }
}
