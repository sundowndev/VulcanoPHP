<?php

namespace App\Upload;

use App\Application;

Class UploadModel extends Upload
{
    public static function fileExist ($file, Application $app)
    {
        $path = $app->WEBROOT . $app->config['paths']['uploads'] . '/' . $file;
        
        if(file_exists($path)){
            return $path;
        }else{
            return false;
        }
    }
    
    public static function deleteUpload (Application $app)
    {
        if(self::fileExist($file)){
            \unlink($app->WEBROOT . $app->config['paths']['uploads'].'/' . $file);
        }else{
            return false;
        }
    }
}
