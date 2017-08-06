<?php
namespace App\DB;

class Database
{
    private static $connect = null;
    private $db;

    private $dbDns = [
      'host' => '127.0.0.1',
      'dbname' => '',
      'user' => 'root',
      'password' => '',
      'charset' => 'utf8'
    ];

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

    public static function getInstance() {
        if(is_null(self::$connect)) {
            self::$connect = new Database(); 
        }
        
        return self::$connect;
    }

    public function prepareRequete($sql, $tab, $one = true){
        $req = $this->db->prepare($sql);
        $req->execute($tab);

        if ($one) {
            $datas = $req->fetch();
        }else{
            $datas = $req->fetchAll();
        }

        return $datas;
    }

    public function executeRequete($sql, $tab){
        $req = $this->db->prepare($sql);
        $req->execute($tab);

        return true;
    }

    public function get_last_id($table){
        /* 
         *  This require high right level on the database
         *  $req = self::getInstance()->prepare("SHOW TABLE STATUS FROM ".$this->dbDns['dbname']." LIKE ".$table,[],$one=true);
         *  return $req['Auto_increment'];
        */

        $last_id = $this->db->lastInsertId();
        return $last_id;
    } 

    public function closeConnexion(){
      if (!is_null(self::$_instance)) {
        $this->db = null;
      }
    }

    public function closeCursor(){
      $this->db->closeCursor();
    }
}
