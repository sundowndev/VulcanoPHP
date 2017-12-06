<?php

if($app->getModule('Session\Session')->r('auth') === true){
    $app->redirect($app->config['paths']['admin'].'/dashboard');
}

    if(!empty($_POST['username']) && !empty($_POST['password'])){
        $username = $_POST['username'];
        $pw = $_POST['password'];
        
        $app->getDB()->query('SELECT * FROM d_users WHERE username = :name');
        $app->getDB()->bind(':name', $username);
        $app->getDB()->execute();
        
        $target = $app->getDB()->single();
        
        if($target && $app->getModule('Secure\Secure')->verifyHash($pw, $target['password'])){
            $app->getModule('Session\Session')->w('auth', true);
            $app->getModule('Session\Session')->w('id', $target['id']);
            $app->getModule('Session\Session')->w('hash_id', $target['hash_id']);
            $app->getModule('Session\Session')->w('username', $target['username']);
            $app->getModule('Session\Session')->setCSRF();
            
            if(!empty($_GET['redirect'])){
                $app->redirect($_GET['redirect']);
            }else{
                $app->redirect($app->config['paths']['admin'].'/dashboard');
            }
        }else{
            $app->getModule('Session\Advert')->setAdvert('error', 'Bad username or password');
        }
    }
?>