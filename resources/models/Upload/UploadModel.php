<?php

namespace App\Upload;

use App\Application;

Class UploadModel extends Upload
{
    private $path;

    public static function fileExist ($file, Application $app)
    {
        return file_exists($file);
    }

    public static function ConvertImageToJPG ($file, Application $app)
    {}

    public static function CompressImage ($file, Application $app)
    {}
    
    public static function deleteUpload ($file, Application $app)
    {
        if(self::fileExist($target = $app->ROOT . '/public/' . $app->config['paths']['uploads'] . '/' . $file, $app)){
            \unlink($target);
        }else{
            return false;
        }
    }
}
