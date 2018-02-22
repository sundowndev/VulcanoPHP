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
    }else{
        $app->getModule('Session\Advert')->setAdvert('danger', 'Please enter a valid username that respect the format : a-Z0-9-_');
    }
    
    $app->getTwig()->addGlobal('POST', $_POST);
}

if(isset($_POST['changeEmail'])){
    if(!empty($_POST['newemail']) && !empty($_POST['password'])){
        $app->getDB()->query('SELECT * FROM d_users WHERE id = :id');

        $app->getDB()->bind(':id', $app->getModule('Session\Session')->r('id'));

        $app->getDB()->execute();
        
        $user = $app->getDB()->single();
        
        if($app->getModule('Secure\Secure')->verifyHash($_POST['password'], $user['password'])){
            
            if (filter_var($_POST['newemail'], FILTER_VALIDATE_EMAIL)){
                $app->getDB()->query('UPDATE d_users SET email = :email WHERE id = :id');

                $app->getDB()->bind(':id', $app->getModule('Session\Session')->r('id'));

                $app->getDB()->bind(':email', $_POST['newemail']);

                $app->getDB()->execute();

                $app->getModule('Session\Advert')->setAdvert('success', 'Changes has been saved');

                $app->getModule('Session\Session')->w('email', $_POST['newemail']);
            }else{
                $app->getModule('Session\Advert')->setAdvert('danger', 'Invalid email address');
            }
        }else{
            $app->getModule('Session\Advert')->setAdvert('danger', 'Incorrect password');
        }
        
    }else{
        $app->getModule('Session\Advert')->setAdvert('danger', 'Please fill all the fields');
    }
    
    $app->getTwig()->addGlobal('POST', $_POST);
}

if(isset($_POST['changePassword'])){
    if(!empty($_POST['actualpassword']) && !empty($_POST['newpassword']) && !empty($_POST['repeatpassword'])){
        $app->getDB()->query('SELECT * FROM d_users WHERE id = :id');

        $app->getDB()->bind(':id', $app->getModule('Session\Session')->r('id'));

        $app->getDB()->execute();
        
        $user = $app->getDB()->single();
        
        if($app->getModule('Secure\Secure')->verifyHash($_POST['actualpassword'], $user['password'])){
            
            if ($_POST['newpassword'] === $_POST['repeatpassword']){
                $app->getDB()->query('UPDATE d_users SET password = :pwd WHERE id = :id');

                $app->getDB()->bind(':id', $app->getModule('Session\Session')->r('id'));

                $app->getDB()->bind(':pwd', $app->getModule('Secure\Secure')->hash_pass($_POST['newpassword']));

                $app->getDB()->execute();

                $app->getModule('Session\Advert')->setAdvert('success', 'New password has been saved');
            }else{
                $app->getModule('Session\Advert')->setAdvert('danger', 'Passwords are different');
            }
        }else{
            $app->getModule('Session\Advert')->setAdvert('danger', 'Incorrect password');
        }
        
    }else{
        $app->getModule('Session\Advert')->setAdvert('danger', 'Please fill all the fields');
    }
}