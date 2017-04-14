<?php 
$host_name = 'localhost';
$user_name = 'root';
$pass_word = 'M9a7r5s3A';
$database_name = 'foco';
$conn = mysql_connect($host_name, $user_name, $pass_word) or die ('Error connecting to mysql');
mysql_select_db($database_name);
		$sql="select * from SIS_Columnas where id_tabla=".$_POST['id_tabla'];
		$res2=mysql_query($sql);
	?>
    <select id="columnas"  name="columnas" class="LP" >
	<option value="0">---Seleccione---</option>
	<?php while ($fila2=mysql_fetch_array($res2)){ ?>
	<option value="<?php echo $id_columna=$fila2['id'];?>"><?php echo $fila2['columna'];?></option> 
    <?php } ?>
    </select>