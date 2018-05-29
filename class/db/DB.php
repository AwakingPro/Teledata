<?php
    class Db {
        public $Server;
        public $User;
        public $Pass;
        public $Database;

        public $CrearLog;
        // The database connection
        protected static $connection;

        /**
         * Connect to the database
         *
         * @return bool false on failure / mysqli MySQLi object instance on success
         */
        public function __construct(){
            //$this->Server = "192.168.1.8";
            //$this->Pass = "s9q7l5.,777";
            $this->Server = "131.0.108.31";
            $this->Pass = "";
            $this->User = "root";
            $this->Database = "teledata";
            if (!isset($_SESSION))
            {
                session_start();
            }
        }
        public function connect() {
            // Try and connect to the database
            if(!isset(self::$connection)) {
                // Load configuration as an array. Use the actual location of your configuration file
                /*$config = parse_ini_file('includes/config/config.ini');
                self::$connection = new mysqli('localhost',$config['username'],$config['password'],$config['dbname']);*/
                //self::$connection = new mysqli('localhost',$this->User,$this->Pass,$this->Database);
                self::$connection = mysql_connect($this->Server,$this->User,$this->Pass);//,$this->Database);
                mysql_select_db($this->Database);
            }

            // If connection was not successful, handle the error
            if(self::$connection === false) {
                // Handle error - notify administrator, log to a file, show an error screen, etc.
                return false;
            }
            return self::$connection;
        }

        /**
         * Query the database
         *
         * @param $query The query string
         * @return mixed The result of the mysqli::query() function
         */
        public function query($query) {
            // Connect to the database
            $connection = $this -> connect();

            // Query the database
            $result = mysql_query($query,$connection);
            if ($result !== false){
                if(isset($_SESSION["id_usuario"])){
                    $this->registrarLogSistema($query);
                }
            }

            return $result;
        }

        /**
         * Fetch rows from the database (SELECT query)
         *
         * @param $query The query string
         * @return bool False on failure / array Database rows on success
         */
        public function select($query) {
            $rows = array();
            $result = $this -> query($query);
            if($result === false) {
                return false;
            }
            while ($row = mysql_fetch_assoc($result)) {
                $rows[] = $row;
            }
            return $rows;
        }

        /**
         * Fetch the last error from the database
         *
         * @return string Database error message
         */
        public function error() {
            $connection = $this -> connect();
            return $connection -> error;
        }

        /**
         * Quote and escape value for use in a database query
         *
         * @param string $value The value to be quoted and escaped
         * @return string The quoted and escaped string
         */
        public function quote($value) {
            $connection = $this -> connect();
            return "'" . $connection -> real_escape_string($value) . "'";
        }
        public function getLastID(){
            $connection = $this -> connect();
            return mysql_insert_id($connection);
        }
        public function getLastIDFromTable($field,$table){
            $Sql = "SELECT MAX(".$field.") AS id FROM ".$table;
            $Id = $this->select($Sql);
            return $Id[0]["id"];
        }

        public function insertLog($tablaOperacion,$query){
          $fechaHora = date('Y-m-d H:i:s');
          $id_registro = $this->getLastID(); // aun no tengo el id de los update y delete
          $sql="insert into log_sistema (fecha, id_usuario, operacion, id_registro, tabla, query) values('".$fechaHora."','".$_SESSION["id_usuario"]."','".$tablaOperacion[0]."','".$id_registro."','".$tablaOperacion[1]."','".addslashes($query)."')";
          $connection = $this -> connect();
          mysql_query($sql,$connection);
        }

        public function registrarLogSistema($query)
        {
          $queryTmp = $query;
          $queryTmp = strtoupper(trim($queryTmp));
          $posSelect = strpos($queryTmp,"SELECT");
          if(($posSelect !== FALSE) && ($posSelect === 0)) { // sip es un select entra aca (si lo consigue en la posicion 0)
            // Registra LOG de select
            /*$tablaOperacion = $this->buscarOperacion($query);
            $this->insertLog("fffffffff",$query);*/
          } else { // Registra LOG de insert update delete
            $posSelect = strpos($queryTmp,"DESCRIBE");
            if(($posSelect !== FALSE) && ($posSelect === 0)) {
            }else{
                    $tablaOperacion = $this->buscarOperacion($query);
            $this->insertLog($tablaOperacion,$query);
            }

          }

        }

        public function buscarOperacion($query)
        {
           $query = strtoupper(trim($query));
           $array = array("INSERT","DELETE","UPDATE");
           $tablaOperacion = array();
           foreach ($array as $clave => $buscar)
           {
             switch ($buscar) {
               case 'INSERT':
                 $queryTmp = str_replace("INSERT INTO ","",$query);
                 $posUltimoEspacio = strpos($queryTmp," ");
                 $tabla = substr($queryTmp,0,$posUltimoEspacio);
               break;
               case 'DELETE':
                 $queryTmp = str_replace("DELETE FROM ","",$query);
                 $posUltimoEspacio = strpos($queryTmp," ");
                 $tabla = substr($queryTmp,0,$posUltimoEspacio);
                 break;
               case 'UPDATE':
                 $queryTmp = str_replace("UPDATE ","",$query);
                 $posUltimoEspacio = strpos($queryTmp," ");
                 $tabla = substr($queryTmp,0,$posUltimoEspacio);
               break;
             }
             $tablaOperacion = array($buscar,$tabla);
             $resultado = strpos(strtoupper($query), strtoupper($buscar));
             if($resultado !== FALSE){
               break; // si lo encuentro cancelo el ciclo para no seguir buscando
             }
           }
         return $tablaOperacion; // envio el nombre de la tabla y la operacion
         }


    }


    /*

    Examples:

        // Our database object
        $db = new Db();

        // Quote and escape form submitted values
        $name = $db -> quote($_POST['username']);
        $email = $db -> quote($_POST['email']);

        // Insert the values into the database
        $result = $db -> query("INSERT INTO `users` (`name`,`email`) VALUES (" . $name . "," . $email . ")");

        $db = new Db();
        $rows = $db -> select("SELECT `name`,`email` FROM `users` WHERE id=5");
    */
?>
