<?php
# CLASE USUARIO PARA GESTIONAR A LOS USUARIOS DEL SISTEMA

require_once 'mysql_class.php';

class usuario extends mysql
{
#____________________________________________________________________________soy_una_barra_separadora :) 
  #Cuando se crea el objeto se realiza la conexion a la base de datos 
  public function __construct()
  {
    $this->conectar();    
  }
#____________________________________________________________________________soy_una_barra_separadora :) 
  public function validar_ingreso($usuario=NULL,$password=NULL)
  {
    if( $usuario!=null and $password!=null)
    {
        # se limpian variables
        $usuario = htmlspecialchars(trim($usuario), ENT_QUOTES);        
        $password = htmlspecialchars(trim($password), ENT_QUOTES);
        # se realiza la consulta a la base de datos
        $r = $this->consulta("SELECT * FROM Usuarios WHERE usuario='$usuario' AND password='$password' ");
        # retorna resultado en boolean
        return ( $this->numero_de_filas($r)>0) ? true : false ;          
    }
    else
        return false;    
  }  
#____________________________________________________________________________soy_una_barra_separadora :)  
}
?>