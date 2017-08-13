<?php
namespace App\DB;

class Database
{
    private static $connect = null;
    private $db;
    private $dbDns;

    public static function getInstance() {
        if(is_null(self::$connect)) {
            self::$connect = new Database(); 
        }
        
        return self::$connect;
    }

    /**
     * Constructor
     */
    public function __construct() {

        $dbDns = $this->dbDns;

        try{
            $this->db = new \PDO('mysql:host='.$dbDns['host'].';dbname='.$dbDns['dbname'],$dbDns['user'],$dbDns['password'],array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES '.$dbDns['charset']));
            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        catch(Exception $e){
            die('Error : '.$e->getMessage());
        }
    }

    private function __clone() {}

    /**
     * Close the connection
     */
    public function __destruct() {
      $this->closeConnection();
    }

    public function setDbDns(string $host, string $dbname, string $user, string $password = '', string $charset){
      $dbDns = [
        'host' => $host,
        'dbname' => $dbname,
        'user' => $user,
        'password' => $password,
        'charset' => $charset
      ];
    }

    public function prepare($sql, $tab, $one = true){
        $req = $this->db->prepare($sql);
    }

    public function execute($tab){
        $req->execute($tab);
    }

    public function fetch($one = true){
        if ($one) {
            $datas = $req->fetch();
        }else{
            $datas = $req->fetchAll();
        }

        return $datas;
    }

    public function get_last_id($table){
        /* 
         *  This require high right level on the database
         *  $req = self::getInstance()->prepare("SHOW TABLE STATUS FROM ".$this->dbDns['dbname']." LIKE ".$table,[],$one=true);
         *  return $req['Auto_increment'];
        */

        // or use this but you'll need to insert before
        $last_id = $this->db->lastInsertId();
        return $last_id;
    } 

    public function closeConnection(){
      if (!is_null(self::$_instance)) {
        $this->db = null;
      }
    }

    public function closeCursor(){
      $this->db->closeCursor();
    }
}
