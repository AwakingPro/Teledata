<?php

//==================================================================================================================
// Luis Ponce
// Desarrollador
// lponce1405@gmail.com
// Creacion      10-08-2016
// Actualizacion 11-08-2018
//==================================================================================================================

//==================================================================================================================
// Conexion a la Base de Datos
//==================================================================================================================

$conexion = mysql_connect("localhost" , "root" , "M9a7r5s3A");
mysql_select_db("foco",$conexion);

//==================================================================================================================
// Captura de Variables desde metodo Ajax
//==================================================================================================================

$tablas=$_POST['tablas'];
$contar=$_POST['contar'];
$id_clase=$_POST['id_clase'];
$id_estrategia=$_POST['id_estrategia'];
$columnas=$_POST['columnas'];
$logica=addslashes($_POST['logica']);
$valor=$_POST['valor'];
$siguiente_nivel=$_POST['siguiente_nivel'];
$nombre_nivel=$_POST['nombre_nivel'];
$error=0;
$id_subquery=$siguiente_nivel;

//==================================================================================================================
// Consulta Nombre de Tabla y Columna a traves del id
//==================================================================================================================

$sql=mysql_query("SELECT  * FROM SIS_Tablas WHERE id='$tablas'");
while($row=mysql_fetch_array($sql))
  {
    $tablas=$row[1];
  }

$sqlColumnas=mysql_query("SELECT columna,tipo FROM SIS_Columnas WHERE id='$columnas'");
while($row=mysql_fetch_array($sqlColumnas))
  {
    $columnasQuery=$row[0];
    $tipo=$row[1];    
  }   

//==================================================================================================================
// Si Tipo == 0 es un INT y si es 1 es de tipo STRING
//==================================================================================================================

if ($tipo==0)
  {     
    $valor=$valor;
  }
else 
  {
    $valor = '"'.$valor.'"';
  } 

//==================================================================================================================
// Colsulta Condicion NOT o en blanco  al principio de la Query Estrategia
//==================================================================================================================

$queryCondicion=mysql_query("SELECT condicion,matriz,matriz_deuda FROM SIS_Querys WHERE id=$id_subquery AND id_estrategia=$id_estrategia");
while($row3=mysql_fetch_array($queryCondicion))
  {
    $condicionFinal = $row3[0];   
    $constante= $row3[1];  
    $constanteDeuda= $row3[2];  
  }  

//==================================================================================================================
// Creacion de Querys Dinamicas QUERY 1
//==================================================================================================================

    
  
$count=0;
$condicion_x='';
$columnas3 = "(SELECT Rut FROM $tablas WHERE $columnasQuery $logica $valor)";
$condicion=" AND ".$condicion_x." Persona.Rut IN ".$columnas3;
$array_central = array();
array_push($array_central, $condicion);
$querya=mysql_query("SELECT id_subquery,condicion ,columna FROM SIS_Querys WHERE id=$id_subquery AND id_estrategia=$id_estrategia");
while($row=mysql_fetch_array($querya))
  {
    $id_subquery = $row[0]; 
    $count++;
    if ($id_subquery==0)
      {
        $condicion=$row[2];
        array_push($array_central, $condicion);
      }
    else
      {
        $condicion=" AND ".$row[1]." Persona.Rut IN ".$row[2];
        array_push($array_central, $condicion);
      }
    while($id_subquery!=0)
      {
        $queryb=mysql_query("SELECT id_subquery,condicion ,columna FROM SIS_Querys WHERE id=$id_subquery AND id_estrategia=$id_estrategia");    
        while($row=mysql_fetch_array($queryb))
          {
            $id_subquery = $row[0]; 
            $count++;
            if ($id_subquery==0)
              {
                $condicion=$row[2];
                array_push($array_central, $condicion);
              }
            else
              { 
                $condicion=" AND ".$row[1]." Persona.Rut IN ".$row[2];
                array_push($array_central, $condicion);
              }
          }
      }
  }

$count = count($array_central);
$i=0;
$k=$count-1;
$subQuery='';
while($i<$count)
  {
    $subQuery = $subQuery.$array_central[$k];
    $i++; 
    $k--;
  }

//==================================================================================================================
// Calcula Cantidad de Registros de  QUERY 1
//==================================================================================================================

$query1 = $constante.$subQuery;
$query_1=mysql_query($query1);
while($row2=mysql_fetch_array($query_1))
  {
    $a=$row2['Rut'];
  }
$numero = mysql_num_rows($query_1);
$numero = number_format($numero, 0, "", ".");

//==================================================================================================================
// Calcula Monto Mora de QUERY 1
//==================================================================================================================

$queryDeuda = $constanteDeuda.$subQuery." AND Persona.Rut = Deuda.Rut";
$monto1 = mysql_query($queryDeuda);     
while($row=mysql_fetch_assoc($monto1))
  {
    $monto_1= $monto_1 + $row['Monto_Mora'];
  }
$monto_1 = '$  '.number_format($monto_1, 0, "", ".");

//==================================================================================================================
// Creacion de Querys Dinamicas QUERY 2
//==================================================================================================================

$id_subquery=$siguiente_nivel;
$count=0;
$condicion_x=' NOT ';
$columnas2 = "(SELECT Rut FROM $tablas WHERE $columnasQuery $logica $valor)";
$condicion=" AND ".$condicion_x." Persona.Rut IN ".$columnas2;
$array_central2 = array();
array_push($array_central2, $condicion);
$queryc=mysql_query("SELECT id_subquery,condicion ,columna FROM SIS_Querys WHERE id=$id_subquery AND id_estrategia=$id_estrategia");
while($row=mysql_fetch_array($queryc))
  {
    $id_subquery = $row[0]; 
    $count++;
    if ($id_subquery==0)
      {
        $condicion=$row[2];
        array_push($array_central2, $condicion);
      }
    else
      {
        $condicion=" AND ".$row[1]." Persona.Rut IN ".$row[2];
        array_push($array_central2, $condicion);
      }
    while($id_subquery!=0)
      {
        $queryd=mysql_query("SELECT id_subquery,condicion ,columna FROM SIS_Querys WHERE id=$id_subquery AND id_estrategia=$id_estrategia");    
        while($row=mysql_fetch_array($queryd))
          {
            $id_subquery = $row[0]; 
            $count++;
            if ($id_subquery==0)
              {
                $condicion=$row[2];
                array_push($array_central2, $condicion);
              }
            else
              { 
                $condicion=" AND ".$row[1]." Persona.Rut IN ".$row[2];
                array_push($array_central2, $condicion);
              }
          }
      }
  }

$count = count($array_central2);
$i=0;
$k=$count-1;
$subQuery2='';
while($i<$count)
  {
    $subQuery2 = $subQuery2.$array_central2[$k];
    $i++; 
    $k--;
  }

//==================================================================================================================
// Calcula Cantidad de Registros de  QUERY 2
//==================================================================================================================

$query2 = $constante.$subQuery2;
$query_2=mysql_query($query2);
while($row2=mysql_fetch_array($query_2))
  {
    $a=$row2['Rut'];
  }
$numero2 = mysql_num_rows($query_2);
$numero2 = number_format($numero2, 0, "", ".");

//==================================================================================================================
// Calcula Monto Mora de QUERY 2
//==================================================================================================================

$queryDeuda2 = $constanteDeuda.$subQuery2." AND Persona.Rut = Deuda.Rut";
$monto2 = mysql_query($queryDeuda2);     
  while($row=mysql_fetch_assoc($monto2))
    {
      $monto_2= $monto_2 + $row['Monto_Mora'];
    }
$monto_2 = '$  '.number_format($monto_2, 0, "", ".");

//==================================================================================================================
// Si Querys no devuelven resultados
//==================================================================================================================

if (empty($monto_1)){ $monto_1=0;}
if (empty($monto_2)){ $monto_2=0;}

//==================================================================================================================
// Algotimo de Generacion de Espacios
//==================================================================================================================

$query_espacios=mysql_query("SELECT DISTINCT id_subquery FROM SIS_Querys WHERE id<='$siguiente_nivel' AND id_estrategia='$id_estrategia'");
$numeroEspacios = mysql_num_rows($query_espacios);
$numeroEspacios = $numeroEspacios*5;
$f = 1;
$espacios = "&nbsp;";
while($f<$numeroEspacios)
  { 
      $espacios = $espacios."&nbsp;";
      $f++;
  }

//==================================================================================================================
// Guardar Querys
//==================================================================================================================

mysql_query("INSERT INTO SIS_Querys(query,id_estrategia,cantidad,id_subquery,monto,cola,columna,condicion,matriz,matriz_deuda) VALUES('$query1','$id_estrategia','$numero','$siguiente_nivel','$monto_1','$nombre_nivel','$columnas3','','$constante','$constanteDeuda')");
mysql_query("INSERT INTO SIS_Querys(query,id_estrategia,cantidad,id_subquery,monto,cola,columna,condicion,matriz,matriz_deuda) VALUES('$query2','$id_estrategia','$numero2','$siguiente_nivel','$monto_2','No Seleccionado','$columnas2','NOT','$constante','$constanteDeuda')");

//==================================================================================================================
// ID para Metodo AJAX
//==================================================================================================================

$query_id1=mysql_query("SELECT id FROM SIS_Querys WHERE query='$query1' AND id_estrategia='$id_estrategia'");
$query_id2=mysql_query("SELECT id FROM SIS_Querys WHERE query='$query2' AND id_estrategia='$id_estrategia'");
while($row=mysql_fetch_array($query_id1)){
	$id1=$row['id'];
}

while($row=mysql_fetch_array($query_id2)){

	$id2=$row['id'];
}


//==================================================================================================================
// Tablas para Metodo AJAX
//==================================================================================================================

$array = array('uno' => "<tr id='$id1'><td>$espacios <i class='psi-folder-open' id='b$id1'  style='display: none;'></i> $nombre_nivel</td><td><center>$numero</center></td><td><center>$monto_1</center></td><td><center><a href='#' class='subestrategia$id_clase' id='d$id1'><i class='fa fa-sitemap' id='e$id1'></i></a> &nbsp;&nbsp;<a href='#' class='link$id_clase'><i class='fa fa-trash'></i></a></center></td><td><center><input type='checkbox' class='checkeo$id_clase' id='c$id1' name='c$id1' value='$id1' /></center></td></tr><tr id='$id2'><td>$espacios <i class='psi-folder-open' id='b$id2'  style='display: none;'></i> No Seleccionado</td><td><center>$numero2</center></td><td><center>$monto_2</center></td><td><center><a href='#' class='subestrategia$id_clase' id='d$id2'><i class='fa fa-sitemap' id='e$id2'></i></a> &nbsp;&nbsp;<a href='#' class='link$id_clase'><i class='fa fa-trash'></i></a></center></td><td><center><input type='checkbox' class='checkeo$id_clase' id='c$id2' name='c$id2' value='$id2' /></center></td></tr>", 'dos' => "<input type='hidden' value='$id1' id='id_clase' name='id_clase'>", 'tres' => "$error");
echo json_encode($array);
?>