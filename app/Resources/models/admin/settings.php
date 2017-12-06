<?php

use App\Upload\Upload;

if(isset($_POST['changeUsername'])){
    if(!empty($_POST['username'])){
        $app->getDB()->query('UPDATE d_users SET username = :username WHERE id = :id');

        $app->getDB()->bind(':id', $app->getModule('Session\Session')->r('id'));
        $app->getDB()->bind(':username', $_POST['username']);

        $app->getDB()->execute();
        
        $app->getModule('Session\Session')->w('username', $_POST['username']);
        
        if (!empty($_FILES['avatar'])) {
            //set max. file size (2 in mb)
            $upload = Upload::factory('content/uploads/avatars');
            
            $upload->set_max_file_size(10);
            //set allowed mime types
	        $upload->set_allowed_mime_types(array('image/jpeg','image/png'));
            
            $upload->file($_FILES['avatar']);
            $results = $upload->upload($filename = $app->getModule('Session\Session')->r('hash_id'));
        }
        
        $app->getModule('Session\Advert')->setAdvert('success', 'Changes has been saved');
        
        //$app->redirect('/manager/settings');
    }else{
        $app->getModule('Session\Advert')->setAdvert('danger', 'Please enter a valid username that respect the format : a-Z0-9-_');
    }
}