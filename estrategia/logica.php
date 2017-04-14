<?php 
include("../db/db.php");
$id=$_POST['id_columna'];
$columnas=mysql_query("SELECT columna,logica FROM SIS_Columnas where id=$id");
while ($row = mysql_fetch_row($columnas))
{
	$columna=$row[0];	
	$logica=$row[1];
    if($logica==0)
	{ 
  		echo '<select name="logica" class="select1" id="logica"><option value="0">Seleccione Lógica</option><option value="<">Menor</option><option value=">">Mayor</option><option value="=">Igual</option><option value="<=">Menor o Igual</option><option value=">=">Mayor o Igual</option><option value="!=">Distinto</option></select>';
	}
	else
	{
  		echo "<select name='logica' class='select1' id='logica'><option value='0'>Seleccione Lógica</option><option value='='>Igual</option><option value='!=''>Distinto</option></select>";
	}
}
?>

