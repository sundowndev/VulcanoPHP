<?php

namespace App\Upload;

use App\Application;

Class UploadModel extends Upload
{
    private $path;

    public static function fileExist ($file, Application $app)
    {
        $path = $app->WEBROOT . $app->config['paths']['uploads'] . '/' . $file;
        
        if(file_exists($path)){
            return $path;
        }else{
            return false;
        }
    }

    public static function ConvertImageToJPG ($file, Application $app)
    {}

    public static function CompressImage ($file, Application $app)
    {}
    
    public static function deleteUpload ($file, Application $app)
    {
        if(self::fileExist($file, $app)){
            \unlink($app->WEBROOT . $app->config['paths']['uploads'] . '/' . $file);
        }else{
            return false;
        }
    }
}
