<?php
	
	if (isset ($_FILES['file'])) {
		$imagen_p = imagecreatetruecolor(400, 400);
		$imagen = imagecreatefromjpeg($_FILES['file']['tmp_name']);
		list($height2, $width2) = getimagesize($_FILES['file']['tmp_name']);
		$df_w = ($width2 / $_POST['w2']);
		$df_h = ($height2 / $_POST['h2']);
		$nuevo_w = $_POST['w1'] * $df_w;
		$nuevo_h = $_POST['h1'] * $df_h;
		$nuevo_x1 = $_POST['x1'] * $df_w;
		$nuevo_y1 = $_POST['y1'] * $df_h;
		$nuevo_w = ceil($nuevo_w);
		$nuevo_h = ceil($nuevo_h);
		$nuevo_x1 = ceil($nuevo_x1);
		$nuevo_y1 = ceil($nuevo_y1);
		imagecopyresampled($imagen_p,$imagen,0,0,$nuevo_x1,$nuevo_y1,400,400,$nuevo_w,$nuevo_h);
		imagejpeg($imagen_p,'img-profile/'.$_SESSION['idUsuario'].'.jpg', 100);
		clearstatcache();
	}

	require_once('../../class/methods_global/methods.php');
	$query = "UPDATE usuarios SET usuario='".$_POST['Usuario']."', nombre='".$_POST['Nombre']."', email='".$_POST['Correo']."' WHERE id=".$_SESSION['idUsuario'];
	$run = new Method;
	$data = $run->update($query);
	echo $data;
 ?>