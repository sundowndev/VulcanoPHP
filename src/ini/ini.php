<?php
namespace App\ini;

class ini
{
    private static $connect

    private $DEFAULT_PATH;
    private $FILE_NAME;
    private $FILE_CONTENT;
    private $FILE_PATH;

    /**
     * Constructor
     */
    public function __construct() {}

    public static function getInstance() {
        if(is_null(self::$connect)) {
            self::$connect = new ini(); 
        }
        
        return self::$connect;
    }

    public function set_default_path(string $path){
      $this->DEFAULT_PATH = $path;
    }

    public function set_file_name(string $file){
      $this->FILE_NAME = $file;
    }

    public function get_file_name(){
      return $FILE_NAME;
    }

    public function get_file_content(){
      return $FILE_CONTENT;
    }

    /**
     * Clear file infos
     */
    public function clear(){
      $this->$FILE_NAME = "";
      $this->$FILE_CONTENT = "";
      $this->$FILE_PATH = "";
    }
}
