<?php
class mysql
{
    private $localhost = "localhost";    
    private $usuario = "root";
    private $password = "M9a7r5s3A";
    private $database = "foco"; 

 public function conectar()
 {
  if(!isset($this->conexion)){
    $this->conexion = (mysql_connect($this->localhost, $this->usuario,$this->password)) or die(mysql_error() );
    mysql_select_db($this->database , $this->conexion) or die(mysql_error());      
  }
 }     

 public function consulta($q)
 {
    $resultado = mysql_query($q,$this->conexion);
    if(!$resultado){
     echo 'MySQL Error: ' . mysql_error();
     exit;
    }
    return $resultado; 
 }

 function numero_de_filas($result){
  if(!is_resource($result)) 
            return false;
  return mysql_num_rows($result);
 }

}

?>