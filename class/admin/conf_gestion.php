<?php 
include("../db/db2.php");
/**
* Clase para configuracion de la pantalla de gestion por Cedente
*/
class ConfGestion extends Conexion
{
    function ConfGestion()
    {
        parent::__construct();
    }

	
	public function configGuardadas()
	{
        //$cedente = $this->cedente=$cedente;
        $sql_num = mysql_query("SELECT * FROM Conf_Pantalla_Cedente ");
        if(mysql_num_rows($sql_num)>0)
        {
    		echo '<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">';
    		echo '<thead>';
    		echo '<tr>';
            echo '<th>Nombre Config</th>';
            echo '<th class="min-desktop"><center>Cedente</center></th>';
            echo '<th class="min-desktop"><center>Tabla</center></th>';
            echo '<th class="min-desktop"><center>Campos</center></th>';
            echo '<th class="min-desktop"><center>Columnas</center></th>';
    		echo '</tr>';
    		echo '</thead>';
    		echo '<tbody>';
    									     
            $sql = mysql_query("SELECT * FROM Conf_Pantalla_Cedente ");
            while($row4=mysql_fetch_array($sql))
            {
                  
                echo "<td>$row4[1]</td>";
                
                echo '<td><center>';
                                                           
                $idCedente = $row4[2];
                $sql_ced = mysql_query("SELECT Nombre_Cedente FROM Cedente WHERE Id_Cedente = '$idCedente'");
                while($row = mysql_fetch_array($sql_ced))
                {
                    echo $row[0];
                }

                echo '</center></td>';                

                echo "<td><center>$row4[3]</center></td>";
				echo "<td><center>$row4[5]</center></td>";
				echo "<td><center>$row4[6]</center></td>";

                
echo "<td><center><button type='button' class='btn ' data-toggle='modal' data-target='#dataDelete' data-id='$row4[0]'><i class='fa fa-trash'></i> </button></center></td>";
                echo '</tr>';
            } 
            echo '</tbody>';
    		echo '</table>';   
    	}
        else 
        {
            echo "No hay Configuraciones creadas en la BD ";
        }    
	}


	public function listarCamposTablaold($tabla)
	{
        
        $this->nomTabla = $tabla;

        $sql_num = mysql_query("SHOW COLUMNS FROM " . $this->nomTabla );
        
        echo "<select class='selectpicker' id='campo'  name='campo'>";
        while($row = mysql_fetch_array($sql_num))
        {
        	echo "<option value='".$row['Field']."'>" .$row['Field']."</option>";
        }
        echo "</select>";

	}

    public function listarCamposTabla($tabla)
    {
        
        $this->nomTabla = $tabla;
        //$sql_num = mysql_query("SHOW COLUMNS FROM " . $this->nomTabla );
        
       $sql_num = $this->conexion_db->query("SHOW COLUMNS FROM " . $this->nomTabla );
       $registros = $sql_num-> fetch_All(MYSQLI_ASSOC);
       echo "<select class='selectpicker' id='campo'  name='campo'>";
       foreach($registros as $row): 
            echo "<option value='".$row['Field']."'>" .$row['Field']."</option>";
       endforeach;
        echo "</select>";

    }

    public function guardarConfigGestion($campos1)
    {
        
        $campos = json_decode($campos1);
        //$campos2 = json_decode($_POST['data']);

        $total = count($campos);

        $esID = 0;
        $resp = 0;
        $sw1 = 0;
        $Nombre_Conf = "";
        $Id_Cedente = "";
        $Nombre_Tabla = "";
        $Descripcion_Consulta= "";
        $Nombre_Campos = "";
        $Nombre_Columnas = "";

        foreach($campos as $obj){
            //Para campos fijos 
            if($sw1 == 0 ) 
            {
                $Nombre_Conf = $obj->NomConfig;
                $Id_Cedente = $obj->idCedente;;
                $Nombre_Tabla = $obj->nomTabla;                
                $sw1 = 1;
            }

            $Nombre_Campos .= $obj->campo . ",";
            $Nombre_Columnas .= $obj->nombreE . ",";
            
        }
        //Armar consulta
        $Nombre_Campos = trim($Nombre_Campos, ',');
        $Nombre_Columnas = trim($Nombre_Columnas, ',');
        $Descripcion_Consulta = "SELECT ". $Nombre_Campos . " FROM ". $Nombre_Tabla; 

        $strSql = "INSERT INTO Conf_Pantalla_Cedente (Nombre_Conf,Id_Cedente,Nombre_Tabla,Descripcion_Consulta,Nombre_Campos,Nombre_Columnas) values ('$Nombre_Conf','$Id_Cedente','$Nombre_Tabla','$Descripcion_Consulta','$Nombre_Campos','$Nombre_Columnas' )";
        //$strSql = addslashes($strSql);
        
        try 
        {    
            if ($this->conexion_db->query($strSql) === TRUE) {
                $resp = 0;
            } else {
                echo "Error creating table: " . $conexion_db->error;
                $resp = 1;
            }

            $resp = 0;
         

        } catch (Exception $e) {
            $mensj = "Caught exception: ".  $e->getMessage() ;
            $resp = 1;
        }
        
        return $resp;
            


    }

    public function eliminarConfig($id){

        $resultado = $this->conexion_db->query("DELETE FROM Conf_Pantalla_Cedente WHERE Id_Conf = '$id' ");
        return 0;
    }




}





 ?>