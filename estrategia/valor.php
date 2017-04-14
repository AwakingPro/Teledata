<?php 
include("../db/db.php");
$id= $_POST['id_columna'];
$columnas=mysql_query("SELECT tipo_dato,columna,relacion,orden,id_tabla,nombre_nulo FROM SIS_Columnas where id=$id");
while ($row = mysql_fetch_row($columnas))
{
    $tipo_dato=$row[0];
    $columna=$row[1];
    $relacion=$row[2];
    $orden=$row[3];
    $tabla=$row[4];
    $nombre_nulo=$row[5];
    $sql_tablas=mysql_query("SELECT Nombre FROM SIS_Tablas where id=$tabla");
    while ($row = mysql_fetch_row($sql_tablas))
    {
        $tablas=$row[0];
    }
    //============================================================================================================
    //Valor Entero
    //============================================================================================================
    if($tipo_dato==0)
    { 
        echo '<input type="number" name="valor" placeholder="  Ingrese Valor" id="valor" class="text1" required>';
    }
    //============================================================================================================
    //Valor Fecha
    //============================================================================================================
    elseif($tipo_dato==1)
    {
        echo '<input type="date" name="valor" required placeholder="  Ingrese Valor" id="valor" class="text1" >';
    }
    //============================================================================================================
    //Valor Varchar
    //============================================================================================================
    elseif ($tipo_dato==3) 
    {
        echo '<input type="text" name="valor" placeholder="  Ingrese Valor" id="valor" class="text1" >';
    }
    //============================================================================================================
    //Valor Distinto
    //============================================================================================================
    elseif ($tipo_dato==4) 
    {    
        echo '<select name="valor" id="valor"  class="select1">';
        $result=mysql_query("SELECT $columna FROM $tablas GROUP BY $columna");
        while($row=mysql_fetch_array($result))
        { 
            $valor=$row[0];
            if($valor==NULL)
            {
                echo "<option value='$valor'>$nombre_nulo</option>";

            }
            else 
            {
                echo "<option value='$valor'>$valor</option>";                
            }    
        }
        echo '</select>';
    }
    //============================================================================================================
    //Relacion con Otra Tabla
    //============================================================================================================
    elseif ($tipo_dato==5) 
    {    
        echo '<select name="valor" id="valor"  class="select1">';
        $result=mysql_query("SELECT * FROM $relacion ORDER BY $orden ASC");
        while($row=mysql_fetch_array($result))
        { 
            echo "<option value='$row[0]'>$row[1]</option>";
        }
        echo '</select>';
    }
}
?>

	
