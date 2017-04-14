<?php 
$id_gestores=$_POST['id_gestores'];
$host_name = 'localhost';
$user_name = 'root';
$pass_word = 'M9a7r5s3A';
$database_name = 'foco';
$conn = mysql_connect($host_name, $user_name, $pass_word) or die ('Error connecting to mysql');
mysql_select_db($database_name);
$query=mysql_query("SELECT nombre FROM SIS_Gestores WHERE id=$id_gestores");
while($row=mysql_fetch_array($query)){

$nombre=$row[0];
$id=$row[1];
}
echo "<tr><td><input type='text' class='asignacion' placeholder='100%' value='$nombre'></td><td><center><input type='text' class='asignacion validate[required]' placeholder='100%'   name='prod[]' id='porcentaje_asignacion$id_gestores'></center></td><td><center><input type='date' class='asignacion' placeholder='07-07-2016' name='fecha_asignacion$id_gestores' id='fecha_asignacion$id_gestores'></center></td><td><center><input type='date' class='asignacion' placeholder='07-07-2016' name='fecha_desasignacion$id_gestores' id='fecha_desasignacion$id_gestores'></center></td><td><center><input type='checkbox' id='uno'/></center></td><td><center><input type='text' class='asignacion validate[required]' placeholder='100%' name='ch[]'  ></center></td><td><center><a href='#' class='acciones'><i class='fa fa-plus-circle icon-lg' > </i></a></center></td></tr>";

?>

	




