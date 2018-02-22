<?php

use App\Upload\Upload;

if(isset($_POST['createArticle'])){
    if(!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['category'])){
        $app->getDB()->query('INSERT INTO d_articles (hash_id, title, author, category_id, publishDate, content) VALUES(:hash_id, :title, :author, :category_id, NOW(), :content)');

        $hash_id = md5(uniqid());

        $app->getDB()->bind(':hash_id', $hash_id);
        $app->getDB()->bind(':title', $_POST['title']);
        $app->getDB()->bind(':author', $app->getModule('Session\Session')->r('id'));
        $app->getDB()->bind(':category_id', $_POST['category']);
        $app->getDB()->bind(':content', $_POST['content']);

        $app->getDB()->execute();

        if (!empty($_FILES['cover'])) {
            //set max. file size (2 in mb)
            $upload = Upload::factory('content/uploads');

            $upload->set_max_file_size(10);
            //set allowed mime types
            $upload->set_allowed_mime_types(array('image/jpeg','image/png'));

            $upload->file($_FILES['cover']);
            $results = $upload->upload($filename = $hash_id);
        }

        $app->getModule('Session\Advert')->setAdvert('success', 'You successfully published your article!');
        
        $app->redirect($app->config['paths']['admin'].'/manage/articles');
    }else{
        $app->getModule('Session\Advert')->setAdvert('danger', "You didn't complete all fields");
    }
    
    $app->getTwig()->addGlobal('POST', $_POST);
}

$app->getDB()->query('SELECT * FROM d_category ORDER BY id DESC');
$app->getDB()->execute();
$categories = $app->getDB()->resultset();

$app->getTwig()->addGlobal('categories', $categories);