<?php
$host_name = '192.168.1.8';
$user_name = 'root';
$pass_word = 's9q7l5.,777';
$database_name = 'foco';
$conn = mysql_connect($host_name, $user_name, $pass_word) or die ('Error connecting to mysql');
mysql_select_db($database_name);
class Usuarios
{

  public function crearUsuarios($usuario,$nombre,$password,$nivel,$cargo,$idMandante,$userDial,$passDial,$email,$idCedente,$idTrabajador,$idEmpresa)
  {
    // Valido si el usuario existe antes de registrarlo
    if ($this->validarUsuario($usuario,""))
      $array = array('respuesta' => "1");
    else
    {
      mysql_query("INSERT INTO Usuarios(usuario,nombre,clave,nivel,cargo,Id_Cedente,user_dial,pass_dial,email,mandante,Id_Personal,idEmpresaExterna) VALUES('$usuario','$nombre','$password','$nivel','$cargo','$idCedente','$userDial','$passDial','$email','$idMandante','$idTrabajador','$idEmpresa')");
      if ($idTrabajador > 0){
        $sql = mysql_query("SELECT id FROM Usuarios WHERE Id_Personal = '".$idTrabajador."'");
        $row=mysql_fetch_array($sql);
        $idNuevoUsuario = $row['id'];
        mysql_query("UPDATE Personal SET id_usuario='$idNuevoUsuario' Where Id_Personal='$idTrabajador'");
      }
      $array = array('respuesta' => "2");
    }
    echo json_encode($array);
  }

  public function validarUsuario($usuario,$id)
  {
    /*$isValid = false;
    if ($id == "")
      $sql_num = mysql_query("SELECT * FROM Usuarios WHERE usuario='$usuario'");
      if(mysql_num_rows($sql_num)>0)
      $isValid = true; // el usuario existe osea no lo puede volver a crear
    else
    {
      $sql_num = mysql_query("SELECT usuario FROM Usuarios WHERE id='$id'");
      $row4=mysql_fetch_array($sql_num);
      if ($row4['usuario'] == $usuario) // osea el usuario no modifico al campo usuario
      {
        $isValid = false; // puede modificarlo sin problema por q el usuario no lo cambio
      } else { // como lo modifico verifico pero con todos los usuario menos con el mismo
        $sql_num = mysql_query("SELECT * FROM Usuarios WHERE usuario='$usuario' AND id='$id'");
        if(mysql_num_rows($sql_num)>0)
        $isValid = true; // no lo puede modificar
      }*/
      $isValid = false;
      if ($id == "")
        $sql_num = mysql_query("SELECT * FROM Usuarios WHERE usuario='$usuario'");
      else {
        $sql_num = mysql_query("SELECT * FROM Usuarios WHERE usuario='$usuario' AND id!='$id'");
      }


      if(mysql_num_rows($sql_num)>0)
      $isValid = true;

    return $isValid;
  }

  public function validarUsuarioPorSi($usuario)
  {
    $isValid = false;
    $sql_num = mysql_query("SELECT * FROM Usuarios WHERE usuario='$usuario'");
    if(mysql_num_rows($sql_num)>0)
      return $isValid = true;
  }

  public function modificarUsuario($usuario,$nombre,$password,$nivel,$cargo,$idCedente,$userDial,$passDial,$email,$id,$idMandanteUsu,$modificoPassword)
  {
    // ,clave='$clave'
    // Valido si el usuario existe antes de modificarlo
    if ($this->validarUsuario($usuario,$id))
      $array = array('respuesta' => "1");
    else
    {
      if ($modificoPassword)
      {
        mysql_query("Update Usuarios Set usuario='$usuario',nombre='$nombre',clave='$password',nivel='$nivel',cargo='$cargo',Id_Cedente='$idCedente',user_dial='$userDial',pass_dial='$passDial',email='$email',mandante='$idMandanteUsu' Where id='$id'");
      }else {
        mysql_query("Update Usuarios Set usuario='$usuario',nombre='$nombre',nivel='$nivel',cargo='$cargo',Id_Cedente='$idCedente',user_dial='$userDial',pass_dial='$passDial',email='$email',mandante='$idMandanteUsu' Where id='$id'");
      }

      //mysql_query("Update Usuarios Set usuario='$usuario' Where id='$id'");
      $array = array('respuesta' => "2");
    }
    echo json_encode($array);
  } // *.8++

  // Verifico sip el usuario cambio la contraseña
  public function validarClave($clave)
  {
    $isValid = false; // no la cambio
    if ($clave != '*.8++')
     $isValid = true; // si la cambio

    return $isValid;
  }


  public function eliminarUsuarios($idUsuario)
  {
    mysql_query("DELETE FROM Usuarios WHERE id = '$idUsuario'");
    mysql_query("UPDATE Personal SET id_usuario='0' Where id_usuario='$idUsuario'");
  }

  public function listarUsuarios($nivel)
  {
    $db = new Db();
    if ($nivel == 1)
    {
     //$visible = "display:block;";
     $visible = "";
    }
    else
    {
     //$visible = "display:none;";
     $visible = "disabled='disabled'";
    }
    $Records = $db -> select("SELECT * FROM Usuarios");
    //$sql_num = mysql_query("SELECT * FROM Usuarios");
    if($Records)
    {
      echo '<table id="TablaUsuarios" class="table table-striped table-bordered" cellspacing="0" width="100%">';
      echo '<thead>';
      echo '<tr>';
        echo '<th>Nombre</th>';
        echo '<th class="min-desktop"><center>Usuario</center></th>';
        echo '<th class="min-desktop"><center>Nivel</center></th>';
        echo '<th class="min-desktop"><center>Email</center></th>';
        echo '<th class="min-desktop"><center>Eliminar</center></th>';
        echo '<th class="min-desktop"><center>Modificar</center></th>';
      echo '</tr>';
      echo '</thead>';
      echo '<tbody>';
        foreach($Records as $Record){
         // inicio Datos de trabajador o empresa
         $idTrabajador = $Record['Id_Personal']; 
         $idEmpresa = $Record['idEmpresaExterna'];
         $email = "";
         $nombre = ""; 
         if (($idTrabajador > 0)){
            $sql3 = mysql_query("SELECT nombre, email FROM Personal WHERE Id_Personal = '".$idTrabajador."'");
            $row3=mysql_fetch_array($sql3);
            $email = $row3['email'];
            $nombre = $row3['nombre'];            
         }else{
            if (($idEmpresa > 0)){
              $sql3 = mysql_query("SELECT email, nombre FROM EE_empresa_externa WHERE idEmpresaExterna = '".$idEmpresa."'");
              $row3=mysql_fetch_array($sql3);
              $email = $row3['email'];
              $nombre = $row3['nombre']; 
            }  
         }
         // fin datos de trabajador o empresa 
        //while($row4=mysql_fetch_array($sql_num))
        //{
          echo "<tr id=".$Record['id'].">";
          echo "<td>".$nombre."</td>";
          echo '<td><center>';
          echo $Record['usuario'];
          echo '</center></td>';
          echo "<td><center>".$this->mostrarNombreRol($Record['nivel'])."</center></td>";
          echo "<td><center>".$email."</center></td>";
          echo "<td><center><button type='button' class='btn eliminar fa fa-trash btn-danger btn-icon icon-lg' $visible  data-toggle='modal' id='".$Record['id']."'></button></center></td>";
          echo "<td><center><button type='button' class='fa fa-pencil-square-o btn gestionar_usu btn-primary btn-icon icon-lg' $visible data-toggle='modal' id='".$Record['id']."' onclick=location.href='crear_usuarios.php'></button></center></td>";
          echo '</tr>';
        }
    echo '</tbody>';
    echo '</table>';
  }
    else
    {
        echo "No hay Usuarios creados en la BD";
    }

  }

  public function datosUsuario($idUsuario)
  {
    $sql = mysql_query("SELECT * FROM Usuarios WHERE id = '".$idUsuario."'");
    $row=mysql_fetch_array($sql);
    // busco el nombre del Rol
    $nivel = $row['nivel'];
    $sql2 = mysql_query("SELECT * FROM Roles WHERE id = '".$nivel."'");
    $row2=mysql_fetch_array($sql2);    

    $idTrabajador = $row['Id_Personal'];
    $idEmpresa = $row['idEmpresaExterna'];
    $cargoTelefono = "";
    $email = "";
    $nombre = "";
    $tipoUsuario = ""; 
    if (($idTrabajador > 0)){
       $sql3 = mysql_query("SELECT nombre, id_cargo, email FROM Personal WHERE Id_Personal = '".$idTrabajador."'");
       $row3=mysql_fetch_array($sql3);
       $idCargo = $row3['id_cargo'];
       $email = $row3['email'];
       $nombre = $row3['nombre'];
       // busco el nombre del cargo del trabajador
       $sql4 = mysql_query("SELECT cargo FROM RH_cargo WHERE id_cargo = '".$idCargo."'");
       $row4=mysql_fetch_array($sql4);
       $cargoTelefono = $row4['cargo'];
       $tipoUsuario = "Trabajador";
    }else{
      if (($idEmpresa > 0)){
       $sql3 = mysql_query("SELECT telefono, email, nombre FROM EE_empresa_externa WHERE idEmpresaExterna = '".$idEmpresa."'");
       $row3=mysql_fetch_array($sql3);
       $cargoTelefono = $row3['telefono'];
       $email = $row3['email'];
       $nombre = $row3['nombre']; 
       $tipoUsuario = "Empresa";
      }  
    }

    $usuarios = array('usuario'=> $row['usuario'], 'nombre'=>$row['nombre'], 'clave'=> $row['clave'], 'nivel'=> $row['nivel'],
    'cargo'=> $row['cargo'], 'id_cedente'=> $row['Id_Cedente'], 'email'=> $row['email'], 'id_mandante'=> $row['mandante'],
    'user_dial'=> $row['user_dial'], 'nombreNivel'=> $row2['nombre'], 'pass_dial'=> $row['pass_dial'],
    'cargoTelefono'=> $cargoTelefono, 'email'=> $email, 'nombre'=> $nombre, 'tipoUsuario'=> $tipoUsuario);

    return $usuarios;
  }

  public function mostrarNombreRol($nivel)
  {
    $sql = mysql_query("SELECT nombre FROM Roles WHERE nivel = $nivel");
    $row=mysql_fetch_array($sql);
    return $row['nombre'];
  }

}
?>
