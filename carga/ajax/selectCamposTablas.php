<?php
	require_once('../../db/db.php');
	$sql=mysql_query("SHOW COLUMNS FROM ".$_POST['tabla']);
	$option = '<option value="">Seleccione...</option>';
	while($row=mysql_fetch_array($sql)){
		$option.= ' <option>'.$row[0].'</option>';
	}
	echo $option;
 ?>