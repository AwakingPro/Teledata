<?php 
header("Content-Type: text/html;charset=utf-8");
$host_name = 'localhost';
$user_name = 'root';
$pass_word = 'M9a7r5s3A';
$database_name = 'foco';
$conn = mysql_connect($host_name, $user_name, $pass_word) or die ('Error connecting to mysql');
mysql_select_db($database_name);
$a= $_POST['id_columna'];

//Persona.Rut Deuda.Monto_Mora.Saldo_Insoluto.Dias_Mora
if ($a==1 OR $a==17 OR $a==18 OR $a==19 OR $a==32 OR $a==33 OR $a==34 OR $a==35 OR $a==36 OR $a==37 OR $a==38 OR $a==39 OR $a==40 OR $a==41 OR $a==43 OR $a==44 OR $a==45 OR $a==46 OR $a==47 OR $a==48 OR $a==49 OR $a==50 OR $a==51 OR $a==53 OR $a==57 OR $a==58 OR $a==81 OR $a==80)	{
	echo '<input type="number" name="valor" placeholder="  Ingrese Valor" id="valor" class="text1" required>';

}
//Persona.Digito_Verificador
elseif ($a==2)	{
	echo  '<select name="valor" id="valor"  class="select1"><option value="1"><center>1</center></option><option value="2"><center>2</center></option></option><option value="3"><center>3</center></option></option><option value="4"><center>4</center></option></option><option value="5"><center>5</center></option></option><option value="6"><center>6</center></option></option><option value="7"><center>7</center></option></option><option value="8"><center>8</center></option></option><option value="9"><center>9</center></option></option><option value="k"><center>k</center></option></select>';

}
//Persona.Sexo
elseif ($a==6)	{
	echo  '<select name="valor" id="valor"  class="select1"><option value="Hombre"><center>Hombre</center></option><option value="Mujer"><center>Mujer</center></option></select>';
}
//Email
elseif ($a==59)	{
	echo '<input type="text" name="valor"  placeholder="  Ingrese Valor" id="valor" class="text1" >';
}
//Persona.Fecha_Ingreso
elseif ($a==8 OR  $a==7 OR  $a==42 OR $a==52 OR $a==16 OR $a==62 OR $a==64 OR $a==66 OR $a==68 OR $a==71 OR $a==73 OR $a==75 OR $a==77 OR $a==78)	{
	echo '<input type="date" name="valor" required placeholder="  Ingrese Valor" id="valor" class="text1" >';

}
//Persona.Comuna 
elseif ($a==29){?>

	<select name="valor" id="valor"  class="select1">
    <?php $result=mysql_query("SELECT * FROM Comuna ORDER BY Nombre ASC");
    while($row=mysql_fetch_array($result)){ ?>
    <option value="<?php echo $row[0];?>"><?php echo utf8_encode($row[1]);?></option>
    <?php }?>
	</select>

<?php
}
//Provincia
elseif ($a==30){?>

	<select name="valor" id="valor"  class="select1">
    <?php $result=mysql_query("SELECT * FROM Provincia ORDER BY Nombre ASC");
    while($row=mysql_fetch_array($result)){ ?>
    <option value="<?php echo $row[0];?>"><?php echo utf8_encode($row[1]);?></option>
    <?php }?>
	</select>

<?php
}
//Ejecutivo
elseif ($a==61){?>

	<select name="valor" id="valor"  class="select1">
    <?php $result=mysql_query("SELECT DISTINCT Ejecutivo FROM Mejor_Gestion ORDER BY Ejecutivo ASC");
    while($row=mysql_fetch_array($result)){ ?>
    <option value="<?php echo $row[0];?>"><?php echo utf8_encode($row[0]);?></option>
    <?php }?>
	</select>

<?php
}
//Region
elseif ($a==31){?>

	<select name="valor" id="valor"  class="select1">
    <?php $result=mysql_query("SELECT * FROM Region ORDER BY Nombre ASC");
    while($row=mysql_fetch_array($result)){ ?>
    <option value="<?php echo $row[0];?>"><?php echo utf8_encode($row[1]);?></option>
    <?php }?>
	</select>

<?php
}
//Desconocido
else{
echo '<input type="text" required name="valor" placeholder="  Ingrese Valor" id="valor" class="text1" >';
}
		

?>

	
