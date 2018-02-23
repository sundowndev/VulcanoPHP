<?php

namespace App\Upload;

use App\Application;

Class UploadModel extends Upload
{
    public static function fileExist (Application $app)
    {
        if(file_exists($app->webroot . $app->config['paths']['uploads'] . '/' . $file)){
            $cover = $app->config['paths']['uploads'].'/' . $file;

            return $cover;
        }else{
            return false;
        }
    }
    
    public static function deleteUpload (Application $app)
    {
        if(self::fileExist($file)){
            \unlink($app->webroot . $app->config['paths']['uploads'].'/' . $file);
        }else{
            return false;
        }
    }
}