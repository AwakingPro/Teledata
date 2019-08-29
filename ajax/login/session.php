<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;
	$query = 'SELECT clave, id, nivel, estaLogin FROM usuarios WHERE usuario="'.$_POST['usuario'].'"';
	$data = $run->select($query);
	if (count($data) > 0) {
		if (password_verify($_POST['password'], $data[0]['clave'])) {
			if($data[0]['estaLogin'] == 1){
				$run->insert('INSERT INTO log_login (IdUsuario, Usuario, Fecha, Proceso) VALUES ("'.$data[0]['id'].'", "'.$_POST['usuario'].'", "'.date("Y-m-d H:i:s").'", "OTRO USUARIO INTENTO ENTRAR DESDE LA IP: '.$_SERVER['REMOTE_ADDR'].' ");');
				$array = array(2,null);
			}else{
				$run->update("UPDATE usuarios set estaLogin = 1 WHERE id = '".$data[0]['id']."' ");
				$_SESSION['idUsuario'] = $data[0]['id'];
				$_SESSION['idNivel'] = $data[0]['nivel'];
				$run->insert('INSERT INTO log_login (IdUsuario, Usuario, Fecha, Proceso) VALUES ("'.$data[0]['id'].'", "'.$_POST['usuario'].'", "'.date("Y-m-d H:i:s").'", "CORRECTO");');
				$array = array(true,'bienvenida/bienvenida.php');
			}

		}else{
			$run->insert('INSERT INTO log_login (IdUsuario, Usuario, Fecha, Proceso) VALUES (0, "'.$_POST['usuario'].'", "'.date("Y-m-d H:i:s").'", "INCORRECTO");');
			$array = array(false,null);
		}
	}else{
		$array = array(false,null);
	}
	echo json_encode($array);
 ?>