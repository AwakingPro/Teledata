<?php 
$host_name = 'localhost';
$user_name = 'lponce';
$pass_word = 'asd123';
$database_name = 'ajax';
$conn = mysql_connect($host_name, $user_name, $pass_word) or die ('Error connecting to mysql');
mysql_select_db($database_name);


		$comunas="select comuna_particular from comunas order by comuna_particular ASC";
		$res2=mysql_query($comunas);
		$ejecutivos="select ejecutivo_mejor_gestion from ejecutivo_mejor_gestion order by ejecutivo_mejor_gestion ASC";
		$res3=mysql_query($ejecutivos);
		$sucursal="select sucursal from sucursal order by sucursal ASC";
		$res4=mysql_query($sucursal);
		$cartera="select cartera from cartera order by cartera ASC";
		$res5=mysql_query($cartera);
		$mejor_gestion="select mejor_gestion from mejor_gestion order by mejor_gestion ASC";
		$res6=mysql_query($mejor_gestion);
		$tramo="select tramo from tramos order by tramo ASC";
		$res7=mysql_query($tramo);
		$mejor_gestion_agrupada="select mejor_gestion_agrupada from mejor_gestion_agrupada order by mejor_gestion_agrupada ASC";
		$res8=mysql_query($mejor_gestion_agrupada);
		
		
$id= $_GET['id'];	?>

<span class="titulo_LP">Ingrese Valor</span><br>

<?php if($id==7){?>
<select name="valor"  class="LP">	
	<option value="0">---Seleccione---</option>
	<?php while ($fila=mysql_fetch_array($res2)){ ?>
	<option value="<?php echo $columna=$fila['comuna_particular']?>"><?php echo $fila['comuna_particular']?></option>
    
<?php 
} 
}
 elseif($id==13){?>
<select name="valor"  class="LP">	
	<option value="0">---Seleccione---</option>
	<?php while ($fila=mysql_fetch_array($res7)){ ?>
	<option value="<?php echo $columna=$fila['tramo']?>"><?php echo $fila['tramo']?></option>
    
<?php 
} 
}
elseif($id==18){?>
<select name="valor"  class="LP">	
	<option value="0">---Seleccione---</option>
	<?php while ($fila=mysql_fetch_array($res8)){ ?>
	<option value="<?php echo $columna=$fila['mejor_gestion_agrupada']?>"><?php echo $fila['mejor_gestion_agrupada']?></option>
    
<?php 
	}}
	elseif($id==26){?>
<select name="valor"  class="LP">	
	<option value="0">---Seleccione---</option>
	<?php while ($fila=mysql_fetch_array($res8)){ ?>
	<option value="<?php echo $columna=$fila['mejor_gestion_agrupada']?>"><?php echo $fila['mejor_gestion_agrupada']?></option>
    
<?php 
} 

}
elseif($id==23){?>
<select name="valor"  class="LP">	
	<option value="0">---Seleccione---</option>
	<?php while ($fila=mysql_fetch_array($res3)){ ?>
	<option value="<?php echo $columna=$fila['ejecutivo_mejor_gestion']?>"><?php echo $fila['ejecutivo_mejor_gestion']?></option>
    
<?php 
} 
}
 elseif($id==12){?>
<select name="valor"  class="LP">	
	<option value="0">---Seleccione---</option>
	<?php while ($fila=mysql_fetch_array($res5)){ ?>
	<option value="<?php echo $columna=$fila['cartera']?>"><?php echo $fila['cartera']?></option>
    
<?php 
} 
}
 elseif($id==8){?>
<select name="valor"  class="LP">	
	<option value="0">---Seleccione---</option>
	<?php while ($fila=mysql_fetch_array($res4)){ ?>
	<option value="<?php echo $columna=$fila['sucursal']?>"><?php echo $fila['sucursal']?></option>
    
<?php 
} 
}
 elseif($id==19){?>
<select name="valor"  class="LP">	
	<option value="0">---Seleccione---</option>
	<?php while ($fila=mysql_fetch_array($res6)){ ?>
	<option value="<?php echo $columna=$fila['mejor_gestion']?>"><?php echo $fila['mejor_gestion']?></option>
    
<?php 
} 
}
 elseif($id==1){?>
<input type="text" name="valor" placeholder='02-02-2016' class="LP"/>
<?php 

}

 elseif($id==2){?>
<input type="text" name="valor" placeholder='02-02-2016' class="LP"/>
<?php 

}
else {?>
	
	<input type="text" name="valor" class="LP"/>
	
<?php	}?>
