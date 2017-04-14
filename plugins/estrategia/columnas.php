<?php 

$host_name = 'localhost';
$user_name = 'root';
$pass_word = 'M9a7r5s3A';
$database_name = 'foco';
$id_tabla=$_POST['id_tabla'];
$conn = mysql_connect($host_name, $user_name, $pass_word) or die ('Error connecting to mysql');
mysql_select_db($database_name);
		$sql="select * from SIS_Columnas where id_tabla=".$_POST['id_tabla']." AND view=1";
		$res2=mysql_query($sql);
	?>
<?php 
//Direcciones
if($id_tabla==3){?>	

	<select name="columnas" id="columnas" class="select1" >
	<option value="0">Seleccione Columna</option>
	<?php while ($fila2=mysql_fetch_array($res2)){ ?>
	<option value="<?php echo $id_columna=$fila2['id'];?>"><?php echo $fila2['alias'];?></option> 
    <?php } ?>
    </select>
  
<?php } 
//Otros
else {?>
	<select name="columnas" id="columnas" class="select1" >
	<option value="0">Seleccione Columna</option>
	<?php while ($fila2=mysql_fetch_array($res2)){ ?>
	<option value="<?php echo $id_columna=$fila2['id'];?>"><?php echo $fila2['columna'];?></option> 
    <?php } ?>
    </select>
<?php } ?>    