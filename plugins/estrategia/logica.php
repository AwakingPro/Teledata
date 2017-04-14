<?php 
$id=$_POST['id_columna'];
$host_name = 'localhost';
$user_name = 'root';
$pass_word = 'M9a7r5s3A';
$database_name = 'foco';
$conn = mysql_connect($host_name, $user_name, $pass_word) or die ('Error connecting to mysql');
mysql_select_db($database_name);

$sql="select columna from SIS_Columnas where id=".$id;
		$columnas=mysql_query($sql);

while ($row = mysql_fetch_row($columnas)){
	
	 $columna=$row[0];
	
}
//Persona.Rut
if($id==1){ 
    echo '<select name="logica" class="select1" id="logica"><option value="0">Seleccione Lógica</option><option value="<"><</option><option value=">">></option><option value="=">=</option><option value="<="><=</option><option value=">=">>=</option><option value="!=">!=</option></select>';
          }
//Persona.Sexo   Direcciones.Region.Provincia.Comuna
elseif($id==6 OR $id==29 OR $id==30 OR $id==31 OR $id==2 OR $id==61)
          {
    echo "<select name='logica' class='select1' id='logica'><option value='0'>Seleccione Lógica</option><option value='='>=</option><option value='!=''>!=</option></select>";
          }
//
elseif($id==6)
          {
    echo "<select name='logica' class='select1' id='logica'><option value='0'>Seleccione Lógica</option><option value='='>=</option><option value='!=''>!=</option></select>";
          }
elseif($id==59)
          {
    echo "<select name='logica' class='select1' id='logica'><option value='0'>Seleccione Lógica</option><option value='='>=</option><option value='!=''>!=</option></select>";
          }
 else{ 
    echo '<select name="logica" class="select1" id="logica"><option value="0">Seleccione Lógica</option><option value="<"><</option><option value=">">></option><option value="=">=</option><option value="<="><=</option><option value=">=">>=</option><option value="!=">!=</option></select>';
    }
?>

