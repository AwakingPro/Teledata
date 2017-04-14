<?php 
$id=$_POST['id_columna'];
$host_name = 'localhost';
$user_name = 'lponce';
$pass_word = 'asd123';
$database_name = 'ajax';
$conn = mysql_connect($host_name, $user_name, $pass_word) or die ('Error connecting to mysql');
mysql_select_db($database_name);

$sql="select columna from columnas where id=".$id;
		$columnas=mysql_query($sql);

while ($row = mysql_fetch_row($columnas)){
	
	 $columna=$row[0];
	
}


	?>

<?php if($id==7){ ?>

<select name="logica" class="LP" id="logica">
    <option >---Seleccione---</option>
    <option value="=">=</option>
    <option value="!=">!=</option>

    </select>
<?php } 
elseif($id==8){ ?>

<select name="logica" class="LP" id="logica">
    <option >---Seleccione---</option>
    <option value="=">=</option>
    <option value="!=">!=</option>

    </select>
<?php } 

else if($id==9){ ?>
	<select name="logica" class="LP" id="logica">
    <option >---Seleccione---</option>
    <option value="=">=</option>
    <option value="!=">!=</option>

    </select>
	
	
	<?php } else if($id==11){ ?>
	<select name="logica" class="LP" id="logica">
    <option >---Seleccione---</option>
    <option value="=">=</option>
    <option value="!=">!=</option>

    </select>
	
	
	<?php } else if($id==10){ ?>
	<select name="logica" class="LP" id="logica">
    <option >---Seleccione---</option>
    <option value="=">=</option>
    <option value="!=">!=</option>

    </select>
	
	
	<?php } 
	
	else if($id==12){ ?>
	<select name="logica" class="LP" id="logica">
    <option >---Seleccione---</option>
    <option value="=">=</option>
    <option value="!=">!=</option>

    </select>
	
	
	<?php } 
		else if($id==13){ ?>
	<select name="logica" class="LP" id="logica">
    <option >---Seleccione---</option>
    <option value="=">=</option>
    <option value="!=">!=</option>

    </select>
	
	
	<?php } 
	else if($id==18){ ?>
	<select name="logica" class="LP" id="logica">
    <option >---Seleccione---</option>
    <option value="=">=</option>
    <option value="!=">!=</option>

    </select>
	<?php } 
	else if($id==19){ ?>
	<select name="logica" class="LP" id="logica">
    <option >---Seleccione---</option>
    <option value="=">=</option>
    <option value="!=">!=</option>

    </select>
    <?php } 
	else if($id==20){ ?>
	<select name="logica" class="LP" id="logica">
    <option >---Seleccione---</option>
    <option value="=">=</option>
    <option value="!=">!=</option>

    </select>
	<?php } 
	else if($id==21){ ?>
	<select name="logica" class="LP" id="logica">
    <option >---Seleccione---</option>
    <option value="=">=</option>
    <option value="!=">!=</option>

    </select>
    <?php } 
	else if($id==22){ ?>
	<select name="logica" class="LP" id="logica">
    <option >---Seleccione---</option>
    <option value="=">=</option>
    <option value="!=">!=</option>

    </select>
    <?php } 
	else if($id==23){ ?>
	<select name="logica" class="LP" id="logica">
    <option >---Seleccione---</option>
    <option value="=">=</option>
    <option value="!=">!=</option>

    </select>
    <?php } 
    else if($id==24){ ?>
	<select name="logica" class="LP" id="logica">
    <option >---Seleccione---</option>
    <option value="=">=</option>
    <option value="!=">!=</option>

    </select>
    <?php } 
    else if($id==25){ ?>
	<select name="logica" class="LP" id="logica">
    <option >---Seleccione---</option>
    <option value="=">=</option>
    <option value="!=">!=</option>

    </select>
	<?php } 
	else { ?><select name="logica" class="LP" id="logica">
    <option >---Seleccione---</option>
    <option value="<"><</option>
    <option value=">">></option>
    <option value="=">=</option>
    <option value="<="><=</option>
    <option value=">=">>=</option>
    <option value="!=">!=</option>
    </select><?php }?>

