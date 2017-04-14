
<?php
  session_start();
    if( $_POST )
 {
     #Comprueba que las variables existan
     if ( isset( $_POST['usuario'] ) and isset( $_POST['password'] ) ){
            # archivo php necesario
   require_once 'usuario.class.php';
            # instancia a clase usuario
            $usuario = new usuario();
       if( $usuario->validar_ingreso($_POST['usuario'] , $_POST['password']) ){
                //crea instancia de sesion segura
                $_SESSION["usuario"]=$_POST['usuario'];
				$_SESSION["cedente"]=$_POST['cedente'];
                # si usuario existe -> redireccionar a nueva pagina 
                echo 'Exito: Usuario '.$_SESSION["usuario"].' logueado';exit;
            }else
              echo 'Error: Acceso Denegado';     
   }
  }        
?>

<form id="form" name="form" method="post" action="">
<span>Nombre de Usuario</span>
<br />
<input id="usuario" name="usuario" type="text" value="" />
<br />
<span>Contraseña</span>
<br />
<input id="password" name="password" type="password" value="" />
<input id="cedente" name="cedente" type="text" value="" />
<br />
<input name="enviar" id="enviar" type="submit" value="Entrar" />
</form>