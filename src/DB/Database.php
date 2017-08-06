<?php
/**
* 
* @author cbarrau
*
*
* ===================================== UPDATE =====================================
* 27/09/2016 U1 CBA ne sera pas utilisé car l'objet technico-fonctionnel
* n'est pas la copie de la table
* 
*/
namespace App\DB;

/**
 * Class Database
 */
class Database {

  private $_dbDns;
  private $_dbUser;
  private $_dbPassword;
  private $_connexion;
  private $_statement;
  private $_nombreRequetes;
  private $_lastInsertID;
  private static $_instance = null;

  /**
  * \brief Accesseur a  l'objet connecteur de la base de donnees.
  *
  * \return _instance le nouveau serveur instance unique de l'objet.
  */
  public static function getInstance()
  {
    if( is_null(self::$_instance) ) {
      self::$_instance = new database();
    }
    
    return self::$_instance;
  }
  
  public function __construct() {}

  private function __clone() {}

  /**
  * Destructeur d'objet
  */
  public function __destruct() {
    $this -> closeConnexion();
  }

  /**
  * \brief Modificateur du serveur de la base de donnees.
  *
  * \param dbDns le nouveau serveur.
  *
  * \info Different type de chaines:
  * - MySQL: mysql:dbname=<nomBD>;host=<nomHost>
  * - PosGreSQL: pgsql:dbname=<nomBD> host=<nomHost>
  * - SQLite:
  * * sqlite:<chemin/vers/maBdd.sq2> <=> <dbName>
  * * sqlite::memory: <=> <dbName>
  * * sqlite2:<chemin/vers/maBdd.sq3> <=> <dbName>
  * * sqlite2::memory: <=> <dbName>
  * - ODBC: odbc:monAliasBDD <=> <dbName>
  */
  public function setDbDns($dbEngine,$dbName,$dbHost="") {
    $dbDns = $dbEngine.":";

    if (!strstr($dbEngine, "sqlite") || !strstr($dbEngine, "odbc")) {
      $dbDns .= "dbname=".$dbName;
      
      if (!strstr($dbEngine, "mysql")) {
        //Cas de posGreSQL
        $dbDns .= " host=".$dbHost;
      } else {
        //Cas de MySQL
        $dbDns .= "; host=".$dbHost;
      }
    } else {
      //Cas de sqlite,sqlite2,odbc
      $dbDns .= $dbName;
    }
    
    $this->_dbDns = $dbDns;
  }
  
  /**
  * \brief Modificateur de l'utilisateur de la base de donnees.
  *
  * \param dbUser le nouvel utilisateur.
  */
  public function setDbUser($dbUser) {
    $this->_dbUser = $dbUser;
  }

  /**
  * \brief Modificateur du mot de passe de la base de donnees.
  *
  * \param dbPassword le nouveau mot de passe.
  */
  public function setDbPassword($dbPassword) {
    $this->_dbPassword = $dbPassword;
  }

  /**
  * \brief Initialisation du nombre de requ&ecirc;tes envoy&eacute;.
  */
  public function setNombreRequetes() {
    $this->_nombreRequetes = 0;
  }

  /**
  * \brief Retourne le nombre de requ&ecirc;tes envoy&eacute;.
  * 
  * \return _nombreRequete
  */
  public function getNombreRequetes() {
    return $this->_nombreRequetes;
  }

  /**
  * \brief Accesseur a  la connexion de l'exterieur.
  *
  * \return la connexion a  la base de donnees.
  */
  public function getConnexion() {
    return self::$_instance -> _connexion;
  }

  /**
  * \brief Methode preparant la requete envoyee.
  *
  * \param requete la requete a  preparer.
  */
  public function prepareRequete($requete) {
    if (!empty($requete)) {
      self::$_instance -> _statement = self::$_instance -> _connexion -> prepare($requete);
    } else {
      throw new Exception("requ&ecirc;te vide");
    }
  }

  /**
  * \brief Methode executant la requete preparee par prepareRequete()
  *
  * \return booleen
  */
  public function executeRequete($requete="") {
    if (empty($requete)) {
      //PREPAREE
      if (self::$_instance -> _statement -> execute() === false) {
        return false;
      }
    } else {
      //NON PREPAREE
      self::$_instance -> _statement = self::$_instance -> _connexion -> query($requete);
      
      if (self::$_instance -> _statement === false) {
        return false;
      }
    }

    //Memorise le dernier ID insere, au cas ou
    $this -> _lastInsertID = self::$_instance -> _connexion -> lastInsertId();
    
    //Ajoute une requete au compteur
    ++ $this -> _nombreRequetes;
    
    return true;
  }

  /**
  * \brief Methode retournant un tableau des resultats de la requete
  *
  * \return Le tableau de resultat
  */
  public function getTableauResultat($_class="") {
    ////////
    // U1 //
    ////////
    // if (empty($_class)) {
    return self::$_instance -> _statement -> fetchAll(PDO::FETCH_ASSOC);
    // } else {
    // return self::$_instance -> _statement -> fetchAll(PDO::FETCH_CLASS,$_class);
    // }
    /////////
    // /U1 //
    /////////
  }

  /**
  * 
  * @param string $param le type de fetch (assoc,object,class) BOTH par defaut
  * @param string $_class le nom de la classe a sortir
  */
  public function fetch($param="",$_class="") {
    switch ($param) {
    case "assoc":
    return self::$_instance -> _statement -> fetch(PDO::FETCH_ASSOC);
    ////////
    // U1 //
    ////////
    // case "object":
    // case "class":
    // return self::$_instance -> _statement -> fetch(PDO::FETCH_OBJ);
    // return self::$_instance -> _statement -> fetchObject($_class);
    /////////
    // /U1 //
    /////////
    default:
      return self::$_instance -> _statement -> fetch(PDO::FETCH_BOTH);
    }
    
    return self::$_instance -> _statement -> fetch();
  }

  /**
  * \brief Cree la connexion a  la base de donnees
  */
  public function connexion($pooling=false) {
    if (empty($this->_dbDns) || empty($this->_dbUser) || empty($this->_dbPassword)) {
      die("Param&egrave;tre de connexion manquant");
    } else {
      // Gestion des erreurs et du pooling de CX
      if (!$pooling) {
        self::$_instance -> _connexion = new PDO( self::$_instance -> _dbDns,
        self::$_instance -> _dbUser,
        self::$_instance -> _dbPassword,
        array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      } else {
        self::$_instance -> _connexion = new PDO( self::$_instance -> _dbDns,
        self::$_instance -> _dbUser,
        self::$_instance -> _dbPassword,
        array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_PERSISTENT => true));
      }
    }
  }

  /**
  * \brief Ferme la connexion a  la base de donnees
  */
  public function closeConnexion() {
    if (!is_null(self::$_instance)) {
      self::$_instance->_connexion = null;
    }
  }

  /**
  * \brief Ferme le curseur a  la base de donnees
  */
  public function closeCursor() {
    self::$_instance -> _statement -> closeCursor();
  }

  /**
  * \brief Demarre une transaction
  */
  public function startTransaction() {
    return self::$_instance->_connexion->beginTransaction();
  }

  /**
  * \brief committe une transaction
  */
  public function commitTransaction() {
    return self::$_instance->_connexion->commit();
  }

  /**
  * \brief defait une transaction
  */
  public function rollbackTransaction() {
    return self::$_instance -> _connexion -> rollback();
  }

  /**
  * \brief r&eacute;cup&egrave;re le dernier ID insere, au cas ou
  */
  public function getLastInsertID() {
    return (int) $this -> _lastInsertID;
  }

  /**
  * \brief Attache un parametre
  */
  public function bind(array $datas) {
    $test = true;
    
    foreach($datas AS $cle => $valeur) {
      if (is_numeric($valeur)) {
        //20160927, ajout des IF supplementaire pour differencier INT / FLOAT / BOOL
        if (is_int($valeur)) {
          $test = self::$_instance -> _statement -> bindValue($cle,$valeur, PDO::PARAM_INT);
        } else if (is_bool($valeur)) {
          $test = self::$_instance -> _statement -> bindValue($cle,$valeur, PDO::PARAM_BOOL);
        } else {
          //par defaut je met les flottant
          $test = self::$_instance -> _statement -> bindValue($cle,$valeur);
        }
      } else {
          $test = self::$_instance -> _statement -> bindValue($cle,$valeur, PDO::PARAM_STR);
      }
      if ($test === false) {
          throw new exceptionDatabase('Erreur sur BIND, data: '.$cle.' / '.$valeur);
      }
    }
  }

  public function debug() {
    return self::$_instance -> _statement -> debugDumpParams();
  }

  public function quote($value) {
    return self::$_instance -> _connexion -> quote($value);
  }
}
?>