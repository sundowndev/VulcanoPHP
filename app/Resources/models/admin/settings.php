<?php

if(isset($_POST['changeUsername'])){
    if(!empty($_POST['username'])){
        $app->getDB()->query('UPDATE d_users SET username = :username WHERE id = :id');

        $app->getDB()->bind(':id', $app->getModule('Session\Session')->r('id'));
        $app->getDB()->bind(':username', $_POST['username']);

        $app->getDB()->execute();
        
        $app->getModule('Session\Session')->w('username', $_POST['username']);
        
        exit(var_dump($_POST));
        
        $app->getModule('Session\Advert')->setAdvert('success', 'Changes has been saved'); 
    }else{
        $app->getModule('Session\Advert')->setAdvert('danger', 'Please enter a valid username that respect the format : a-Z0-9-_');
    }
}