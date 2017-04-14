<?php 
$host_name = 'localhost';
$user_name = 'lponce';
$pass_word = 'asd123';
$database_name = 'ajax';
$conn = mysql_connect($host_name, $user_name, $pass_word) or die ('Error connecting to mysql');
mysql_select_db($database_name);
		$sql="select * from columnas where tabla_id=".$_POST['id_tabla']." AND view=1";
		$res2=mysql_query($sql);
	
	?>
    <br />
    <span class="titulo_LP">Condición</span><br>
    <select id="condiciomal"  name="condicional" class="LP" >
	<option value="0">Y</option>
    <option value="0">O</option>
    </select>
    <br />
    <br />

    <span class="titulo_LP">Columna </span><br>
    <select id="columnas2"  name="columnas2" class="LP" >
	<option value="0">---Seleccione---</option>
	<?php while ($fila2=mysql_fetch_array($res2)){ ?>
	<option value="<?php echo $id_columna=$fila2['id'];?>"><?php echo $fila2['columna'];?></option> 
    <?php } ?>
    </select>
    <br />
    <br />

    <span class="titulo_LP">Lógica </span><br>
    <select   disabled="disabled" name="logica" class="LP2" ><option value="0">---Seleccione---</option></select>
  

   