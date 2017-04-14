<?php
include("../../db/db.php");
class Asignacion
{
	public function asignarTipo($id)
	{
		$this->id=$id;
	}
	public function mostrarTipo()
	{
		$sql_estrategia = mysql_query("SELECT * FROM SIS_Estrategias WHERE  tipo=$this->id");
		if(mysql_num_rows($sql_estrategia)>0)
		{
			echo '<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead><tr>';
            echo '<th>ID Estrategia</th>';
           	echo '<th>Nombre de la Estrategia</th>';
			echo '<th class="min-desktop"><center>Creador</center></th>';
			echo '<th class="min-desktop"><center>Hora</center></th>';
			echo '<th class="min-desktop"><center>Fecha</center></th>';
			echo '<th class="min-desktop"><center>Seleccionar</center></th></tr>';                               
            echo '</thead><tbody>';
			$j = 1;
            $sql_estrategia2 = mysql_query("SELECT * FROM SIS_Estrategias WHERE  tipo=$this->id");
            while($row=mysql_fetch_array($sql_estrategia2))
			{ 
            	echo "<tr id='$row[0]' class='$j'>";
             	echo "<td>$row[0]</td>";
			    echo "<td>$row[1]</td>";
			    echo "<td>$row[2]</td>";
			    echo "<td>$row[3]</td>";
			    echo "<td>$row[4]</td>";
                echo "<td><center><input type='checkbox' class='seleccione_estrategia' id='dos$j' />";
				echo "</center></td></td></tr>";
			    $j++;
             }
		echo "</tbody></table>";
        } 
		else 
		{
			echo "No hay estrategias creadas en el Tipo seleccionado.";
        }
	}
	public function asignarEstrategia($ide)
	{
		$this->ide=$ide;
	}
	public function mostrarEstrategia()
	{	
		echo '<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">';
        echo '<thead><tr><th>ID Cola</th><th>Cola</th><th class="min-desktop"><center>Cantidad de Registros</center></th>';
		echo '<th class="min-desktop"><center>Monto</center></th><th class="min-desktop"><center>Prioridad</center></th>';
		echo '<th class="min-desktop"><center>Seleccionar</center></th>';
		echo '</tr></thead><tbody>';
        $k = 1;
        $sql_estrategia = mysql_query("SELECT id,cola,cantidad,monto,prioridad FROM SIS_Querys WHERE  id_estrategia=$this->ide");
        while($row=mysql_fetch_array($sql_estrategia))
		{ 
			$prioridad = $row[4];
			if($prioridad==1){$pr = "Sin Prioridad";}
			elseif($prioridad==2){$pr = "Baja+";}
			elseif($prioridad==3){$pr = "Baja++";}
			elseif($prioridad==4){$pr = "Media+";}
			elseif($prioridad==5){$pr = "Media++";}
			elseif($prioridad==6){$pr = "ALta+";}
			elseif($prioridad==7){$pr = "Alta++";}
			
			echo "<tr id='$row[0]' class='$k'>";
			echo "<td>$row[0]</td>";
			echo "<td>$row[1]</td>";
			echo "<td><center>$row[2]</center></td>";
			echo "<td><center>$row[3]</center></td>";
			echo "<td><center>$pr</center></td>";
			echo "<td><center><input type='checkbox' class='seleccione_cola' id='tres$k'/></center></td></td>";
			echo "</tr>";
			$k++;
    	}
		echo "</tbody></table>";
                                                 
	}
	public function asignarGestor($idg)
	{
		$this->idg=$idg;
	}
	public function mostrarGestor()
	{
		 echo '<select id="gestores"  class="select1" name="gestores" data-width="100%">';
         echo '<option>Seleccionar</option>';
         $sql_gestor=mysql_query("SELECT * FROM SIS_Gestores WHERE id_gestor=$this->idg");
         while($row=mysql_fetch_array($sql_gestor))
		 {
         	echo "<option value='$row[2]'>$row[1]</option>";
		 } 
    	 echo '</select>';	
	}
	
	public function asignarInsertar($accion,$gestores,$gestores_sel,$cant,$exito,$id_nuevo)
	{
		$this->accion=$accion;
		$this->gestores=$gestores;
		$this->gestores_sel=$gestores_sel;
		$this->cant=$cant;
		$this->exito=$exito;
		$this->id_nuevo=$id_nuevo;
		$insert = ("INSERT INTO SIS_Acciones(accion, gestor, gestores, cantidad, exito,id_query) VALUES ($this->accion,$this->gestores,$this->gestores_sel,$this->cant,$this->exito,$this->id_nuevo)");
		mysql_query($insert);
		
	}
	public function mostrarInsertar()
	{
        echo '<table id="demo-dt-basic10" class="table table-striped table-bordered" cellspacing="0" width="100%">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>ID Gestor</th>';
        echo '<th>Nombre Gestor</th>';
        echo '<th><center>Eliminar</center></th>';
        echo '</tr></thead><tbody>';
		$sql = mysql_query("SELECT id_query,accion,gestor FROM SIS_Acciones");
        while($row=mysql_fetch_array($sql))
		{ 
			echo "<tr id='$row[0]'>";
            echo "<td>$row[0]</td>";
			echo "<td>$row[1]</td>";
			echo "<td><center><a href='#' class='eliminar_gestores' id='$row[0]'><i class='fa fa-close icon-lg2'> </i></a></center>";
			echo "</td></tr>";
		}
		echo '</tbody></table>';
	}		
}
?>