<?php
include("../../db/db.php");
class crm
{
	public function mostrarCedente()
	{
		echo "<select class='select1' id='seleccione_cedente' name='seleccione_cedente'>";
        $result=mysql_query("SELECT Id_Cedente,Nombre_Cedente FROM Cedente");
       	echo '<option value="0">Seleccione</option>';
        while($row=mysql_fetch_array($result))
        {                                         
        	echo "<option value='$row[0]'>$row[1]</option>";
        }
        echo "</select>";
	}
	public function mostrarEstrategia($id)
	{
		$this->id=$id;
        $sql = mysql_query("SELECT id,nombre FROM SIS_Estrategias WHERE Id_Cedente = $this->id ");
        echo "<select  id='seleccione_estrategia' class='select1' name='seleccione_estrategia' >";
        echo "<option value='0'>Seleccione</option>";
        while($row = mysql_fetch_array($sql))
        {
        	echo "<option value='$row[0]'>$row[1]</option>";

        }
        echo "</select>";
    }
    public function mostrarCola($id)
	{
		$this->id=$id;
        $sql = mysql_query("SELECT id,cola FROM SIS_Querys WHERE id_estrategia = $this->id  AND terminal = 1 AND discador=1");
        echo "<select  id='seleccione_cola' class='select1' name='seleccione_cola' >";
        echo "<option value='0'>Seleccione</option>";
        while($row = mysql_fetch_array($sql))
        {
        	echo "<option value='$row[0]'>$row[1]</option>";

        }
        echo "</select>";
    } 
    public function mostrarRut($id)
	{
		$this->id=$id;
        $sql = mysql_query("SELECT id,Id_Cedente FROM SIS_Querys WHERE id= $this->id ");
        while($row = mysql_fetch_array($sql))
        {
        	$id=$row[0];
        	$cedente=$row[1];

        }
        $prefijo = "QR_".$cedente."_".$id;
        $q2 = mysql_query("SELECT Rut FROM $prefijo LIMIT 1");
        while($row = mysql_fetch_array($q2))
        {
        	$rut = $row[0];
        	
        	$qn = mysql_query("SELECT Nombre_Completo FROM Persona WHERE Rut = $rut LIMIT 1");
        	while($row = mysql_fetch_array($qn))
        	{
        		$nombre = $row[0];
        	}	
        }
        $uno =  "<input type='text' value='$rut' class='form-control' readonly='readonly'>";
        $cinco= "Rut : ".$rut;
        $array = array('uno' => $uno, 'dos' => $rut, 'tres' => $nombre, 'cuatro' => $prefijo, 'cinco' => $cinco);
		echo json_encode($array);
        	

    } 
    public function nextRut($rut,$prefijo)
	{
		$this->rut=$rut;
		$this->prefijo=$prefijo;
		$cr = mysql_query("SELECT id FROM $prefijo ");
		$cant = mysql_num_rows($cr);
		$nr = mysql_query("SELECT id FROM $prefijo WHERE Rut = $this->rut LIMIT 1");
		while($row = mysql_fetch_array($nr))
		{
			$id_rutp = $row[0]+1;
			if($id_rutp>$cant)
			{
				$id_rut = 1;
			}	
			else
			{
				$id_rut = $row[0]+1;
			}	
			
		}	
		$nrn = mysql_query("SELECT Rut FROM  $prefijo WHERE id = $id_rut LIMIT 1");
		while($row = mysql_fetch_array($nrn))
		{
			$nuevo_rut = $row[0];
			$qn = mysql_query("SELECT Nombre_Completo FROM Persona WHERE Rut = $nuevo_rut LIMIT 1");
        	while($row = mysql_fetch_array($qn))
        	{
        		$nuevo_nombre = $row[0];
        	}	
		}
		$uno =  "<input type='text' value='$nuevo_rut' class='form-control' readonly='readonly'>";
		$cinco= "Rut : ".$nuevo_rut;
        $array = array('uno' => $uno, 'dos' => $nuevo_rut, 'tres' => $nuevo_nombre, 'cuatro' => $prefijo, 'cinco' => $cinco);
		echo json_encode($array);	
		
	} 
	public function prevRut($rut,$prefijo)
	{
		$this->rut=$rut;
		$this->prefijo=$prefijo;
		$cr = mysql_query("SELECT id FROM $prefijo ");
		$cant = mysql_num_rows($cr);
		$nr = mysql_query("SELECT id FROM $prefijo WHERE Rut = $this->rut LIMIT 1");
		while($row = mysql_fetch_array($nr))
		{
			
			$id_rutp = $row[0]-1;
			if($id_rutp==0)
			{
				$id_rut = $cant;
			}
			else
			{
				$id_rut = $row[0]-1;
			}	
		}	
		$nrn = mysql_query("SELECT Rut FROM  $prefijo WHERE id = $id_rut LIMIT 1");
		while($row = mysql_fetch_array($nrn))
		{
			$nuevo_rut = $row[0];
			$qn = mysql_query("SELECT Nombre_Completo FROM Persona WHERE Rut = $nuevo_rut LIMIT 1");
        	while($row = mysql_fetch_array($qn))
        	{
        		$nuevo_nombre = $row[0];
        	}	
		}
		$uno =  "<input type='text' value='$nuevo_rut' class='form-control' readonly='readonly'>";
		$cinco= "Rut : ".$nuevo_rut;
        $array = array('uno' => $uno, 'dos' => $nuevo_rut, 'tres' => $nuevo_nombre, 'cuatro' => $prefijo, 'cinco' => $cinco);
		echo json_encode($array);	
		
	} 
    public function deudaRut($rut)
	{
		$this->rut=$rut;
		echo "<select class='select1' id='seleccione_cedente' name='seleccione_cedente'";
        $result=mysql_query("SELECT Producto FROM Deuda WHERE Rut = $rut");
        while($row=mysql_fetch_array($result))
        {                                         
        	echo "<option value='$row[0]'>$row[1]</option>";
        }
        echo "</select>";
	} 
	public function cantRegistros($rut,$prefijo)
	{
		$this->rut=$rut;
		$this->prefijo=$prefijo;
		$qn = mysql_query("SELECT Rut FROM  $this->prefijo ");
		$num = mysql_num_rows($qn);
		$q = mysql_query("SELECT id FROM  $this->prefijo WHERE Rut = $this->rut");
	    while($row = mysql_fetch_array($q))
        { 
        	$id = $row[0];
        }
        $valor = $id." de ".$num;
        echo "<input type='text' value='$valor' disabled='disabled'  class='form-control'>";	

	}	 
	public function mostrarFonos($rut,$prefijo)
	{
		$this->rut=$rut;
		$this->prefijo=$prefijo;
		echo '<div class="table-responsive">';
        echo '<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">';
        echo '<thead>';
        echo '<tr><tr>';
        echo '<th class="text-sm"><center>Color</center></th>';
        echo '<th class="text-sm">Comentario</th>';
        echo '<th class="text-sm">Numero</th>';
        echo '<th class="text-sm"><center>Llamar</center></th></tr>';
        echo '</thead><tbody>';
	    $q = mysql_query("SELECT Rut FROM  $this->prefijo WHERE Rut = $this->rut");
	    while($row = mysql_fetch_array($q))
        { 
        	$r = $row[0];
            $qc = mysql_query("SELECT formato_subtel,color  FROM  fono_cob WHERE Rut = $r  order by color DESC");
       		$i=1;
       		while($row = mysql_fetch_array($qc))
        	{
        		$f1 = $row[0];
        		$c = $row[1];
        		$qc1 = mysql_query("SELECT color,comentario  FROM SIS_Colores WHERE id = $c  ");
	       		
	       		while($row = mysql_fetch_array($qc1))
	        	{

				   	$color1 = $row[0];
				   	$comentario = $row[1];
				    echo "<tr id='$i'>"; 
				    echo "<td class='text-sm'><center><i class='fa fa-flag fa-lg icon-lg' style='color:$color1'></i> </center></td>"; 
				    echo "<td class='text-sm'>$comentario</td>"; 
				    echo "<td class='text-sm'><input type='hidden' id='telefono$i' value='$f1' name='telefono$i'>$f1</td>";             	              
				    echo "<td class='text-sm'><center><button class='btn btn-success btn-icon icon-lg fa fa-phone llamar_api' id='call$i' value='1'> Llamar</button> </center></td>";
				           
				    echo '</tr>'; 
				    $i++;  
				}     
		    }      	                                  	
		
		}	
        echo '</tbody></table></div>'; 
		                                                                                   
	}
	public function insertarFonos($rut,$fono_discado_nuevo)
	{
		$this->rut=$rut;
		$this->fono_discado_nuevo=$fono_discado_nuevo;
		mysql_query("INSERT INTO fono_cob(Rut,formato_subtel,color) VALUES ('$this->rut','$this->fono_discado_nuevo',100)");
		echo '<div class="table-responsive">';
        echo '<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">';
        echo '<thead>';
        echo '<tr><tr>';
        echo '<th class="text-sm"><center>Color</center></th>';
        echo '<th class="text-sm">Comentario</th>';
        echo '<th class="text-sm">Numero</th>';
        echo '<th class="text-sm"><center>Llamar</center></th></tr>';
        echo '</thead><tbody>';
	    
        $qc = mysql_query("SELECT formato_subtel,color  FROM  fono_cob WHERE Rut = $this->rut order by color DESC");
   		$i=1;
   		while($row = mysql_fetch_array($qc))
    	{
    		$f1 = $row[0];
    		$c = $row[1];
    		$qc1 = mysql_query("SELECT color,comentario  FROM SIS_Colores WHERE id = $c  ");
       		
       		while($row = mysql_fetch_array($qc1))
        	{

			   	$color1 = $row[0];
			   	$comentario = $row[1];
			    echo "<tr id='$i'>"; 
			    echo "<td class='text-sm'><center><i class='fa fa-flag fa-lg icon-lg' style='color:$color1'></i> </center></td>"; 
			    echo "<td class='text-sm'>$comentario</td>"; 
			    echo "<td class='text-sm'><input type='hidden' id='telefono$i' value='$f1' name='telefono$i'>$f1</td>";             	              
			    echo "<td class='text-sm'><center><button class='btn btn-success btn-icon icon-lg fa fa-phone llamar_api' id='call$i' value='1'> Llamar</button> </center></td>";
			           
			    echo '</tr>'; 
			    $i++;  
			}     
	    }      	                                  	
        echo '</tbody></table></div>'; 
		                                                                                   
	}
	public function mostrarDirecciones($rut)
	{
		$this->rut=$rut;
		echo '<div class="table-responsive">';
        echo '<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">';
        echo '<thead>';
        echo '<tr><tr>';
        echo '<th class="text-sm">Direccion</th>';
        echo '<th class="text-sm"><center></center></th>';
        echo '<th class="text-sm"><center></center></th></tr>';
        echo '</thead><tbody>';
	    $q = mysql_query("SELECT Direccion FROM Direcciones  WHERE Rut = $this->rut");
	    while($row = mysql_fetch_array($q))
	   { 
	        $d = $row[0];
            echo "<tr id='$i'>";                                                 
            echo "<td class='text-sm'>$d</td>";             	              
            echo "<td class='text-sm'><center></center></td>";
            echo "<td class='text-sm'><center></center></td></td>";
            echo '</tr>';  
		                                                      
		}	
        echo '</tbody></table></div>'; 
		                                                                                   
	}
	public function nivel1($cedente)
	{
		echo "<select class='select1' id='seleccione_nivel1' name='seleccione_nivel1'>";
        $result=mysql_query("SELECT Id,Nombre FROM Nivel1 WHERE Id_Cedente  = 44");
       	echo "<option value='0'>Seleccione</option>";
        while($row=mysql_fetch_array($result))
        {                                         
        	echo "<option value='$row[0]'>"; echo utf8_encode($row[1]); echo "</option>";
        }
        echo "</select>";
	}	
	public function nivel2($nivel2)
	{
		$this->nivel2=$nivel2;
		echo "<select class='select1' id='seleccione_nivel2' name='seleccione_nivel2'>";
        $result=mysql_query("SELECT Id,Nombre FROM Nivel2 WHERE $this->nivel2 = Id_Nivel1 ");
       	echo '<option value="0">Seleccione</option>';
        while($row=mysql_fetch_array($result))
        {                                         
        	echo "<option value='$row[0]'>"; echo utf8_encode($row[1]); echo  "</option>";

        }
        echo "</select>";

	}
	public function nivel3($nivel3)
	{
		$this->nivel3=$nivel3;

		echo "<select class='select1' id='seleccione_nivel3' name='seleccione_nivel3'>";
        $result=mysql_query("SELECT Id_TipoGestion,Nombre FROM Nivel3 WHERE $this->nivel3 = Id_Nivel2 ");
       	echo '<option value="0">Seleccione</option>';
        while($row=mysql_fetch_array($result))
        {                                         
        	echo "<option value='$row[0]'>"; echo utf8_encode($row[1]); echo "</option>";
        }
        echo "</select>";
        $result2=mysql_query("SELECT Id_TipoGestion FROM Nivel2 WHERE id = $this->nivel3 ");
        while($row=mysql_fetch_array($result2))
        {                                         
        	echo "<input type='hidden' id='tipo_gestion' name='tipo_gestion' value='$row[0]'>";
        }
	}
	public function nivel4($id_tipo,$cortar_valor)
	{
		$this->id_tipo=$id_tipo;
		$this->cortar_valor=$cortar_valor;
		if($this->id_tipo == 5)
		{	
			
			echo '<div class="col-sm-4">';
            echo '<div class="form-group">';
            echo '<label class="control-label">Fecha Compromiso</label>';
            echo '<input type="date" id="fecha_compromiso" name="fecha_compromiso" class="select1">';                  
	        echo '</div>';
	        echo '</div>';
	        echo '<div class="col-sm-4">';
	        echo '<div class="form-group">';
	        echo '<label class="control-label">Monto Compromiso</label>';
	        echo '<input type="number" class="select1" id="monto_compromiso" name="monto_compromiso" >';
	        echo '</div>';
	        echo '</div>'; 
	        echo '<div class="col-sm-4">';
	        echo '<div class="form-group">';
	        echo '</div>';
	        echo '</div>';
	        echo '<div class="col-sm-8">';
	        echo '<div class="form-group">';
	        echo '<label class="control-label">Comentario</label>';
	        echo '<textarea id="comentario" name="comentario" class="select1" ></textarea>';
	        echo '</div>';
	        echo '</div>'; 
	        echo '<div class="col-sm-4">';
	        echo '<div class="form-group">';
	        echo '<label class="control-label">Guardar Gestión</label>';
	        if($this->cortar_valor == 1)
	        {
	        	echo '<input type="submit" class="btn btn-primary btn-block" value="Guardar"  id="guardar">';
	        }
	        else
	        {
	        	echo '<input type="submit" class="btn btn-primary btn-block" value="Guardar" disabled="disabled" id="guardar">';
	        }	
	        echo '</div>';
	        echo '</div>';     
			
		}
		else
		{
		
	        echo '<div class="col-sm-8">';
	        echo '<div class="form-group">';
	        echo '<label class="control-label">Comentario</label>';
	        echo '<textarea id="comentario" name="comentario" class="select1" ></textarea>';
	        echo '</div>';
	        echo '</div>'; 
	        echo '<div class="col-sm-4">';
	        echo '<div class="form-group">';
	        echo '<label class="control-label">Guardar Gestión</label>';
	        if($this->cortar_valor == 1)
	        {
	        	echo '<input type="submit" class="btn btn-primary btn-block" value="Guardar"  id="guardar">';
	        }
	        else
	        {
	        	echo '<input type="submit" class="btn btn-primary btn-block" value="Guardar" disabled="disabled" id="guardar">';
	        }	
	        echo '</div>';
	        echo '</div>';     
		}	
        
	}
	public function insertar1($nivel1,$nivel2,$nivel3,$comentario,$fecha_gestion,$hora_gestion,$rut,$fono_discado,$tipo_gestion,$cedente)
	{
		$this->nivel1=$nivel1;
		$this->nivel2=$nivel2;
		$this->nivel3=$nivel3;
		$this->comentario=$comentario;
		$this->fecha_gestion=$fecha_gestion;
		$this->hora_gestion=$hora_gestion;
		$this->rut=$rut;
		$this->fono_discado=$fono_discado;
		$this->tipo_gestion=$tipo_gestion;
		$this->cedente=$cedente;
		$fechahora = $this->fecha_gestion." ".$this->hora_gestion;

		mysql_query("INSERT INTO gestion(resultado, resultado_n2, resultado_n3, observacion,fecha_gestion,hora_gestion,rut_cliente,fechahora,fono_discado,lista,nombre_ejecutivo,Id_TipoGestion,cedente) VALUES ('$this->nivel1','$this->nivel2','$this->nivel3','$this->comentario','$this->fecha_gestion','$this->hora_gestion','$this->rut','$fechahora','$this->fono_discado','piloto','piloto','$this->tipo_gestion','$this->cedente')");
		echo "ok";
	}
	public function insertar2($nivel1,$nivel2,$nivel3,$comentario,$fecha_gestion,$hora_gestion,$rut,$fono_discado,$tipo_gestion,$cedente,$fecha_compromiso,$monto_compromiso)
	{
		$this->nivel1=$nivel1;
		$this->nivel2=$nivel2;
		$this->nivel3=$nivel3;
		$this->comentario=$comentario;
		$this->fecha_gestion=$fecha_gestion;
		$this->hora_gestion=$hora_gestion;
		$this->rut=$rut;
		$this->fono_discado=$fono_discado;
		$this->tipo_gestion=$tipo_gestion;
		$this->cedente=$cedente;
		$this->fecha_compromiso=$fecha_compromiso;
		$this->monto_compromiso=$monto_compromiso;
		$fechahora = $this->fecha_gestion." ".$this->hora_gestion;

		mysql_query("INSERT INTO gestion(resultado, resultado_n2, resultado_n3, observacion,fecha_gestion,hora_gestion,rut_cliente,fechahora,fono_discado,lista,nombre_ejecutivo,Id_TipoGestion,cedente,fec_compromiso,monto_comp) VALUES ('$this->nivel1','$this->nivel2','$this->nivel3','$this->comentario','$this->fecha_gestion','$this->hora_gestion','$this->rut','$fechahora','$this->fono_discado','piloto','piloto','$this->tipo_gestion','$this->cedente','$this->fecha_compromiso','$this->monto_compromiso')");
		echo "ok";
	}
	public function insertar3($nivel1,$nivel2,$nivel3,$fecha_gestion,$hora_gestion,$rut,$fono_discado,$tipo_gestion,$cedente,$duracion_llamada,$user_dial)
	{
		$this->nivel1=$nivel1;
		$this->nivel2=$nivel2;
		$this->nivel3=$nivel3;
		$this->fecha_gestion=$fecha_gestion;
		$this->hora_gestion=$hora_gestion;
		$this->rut=$rut;
		$this->fono_discado=$fono_discado;
		$this->tipo_gestion=$tipo_gestion;
		$this->cedente=$cedente;
		$this->duracion_llamada=$duracion_llamada;
		$this->user_dial=$user_dial;
		list($horas, $minutos, $segundos) = explode(':', $this->duracion_llamada);
		$duracion_llamada = ($horas * 3600 ) + ($minutos * 60 ) + $segundos;
		$fechahora = $this->fecha_gestion." ".$this->hora_gestion;

		mysql_query("INSERT INTO gestion(resultado, resultado_n2, resultado_n3,fecha_gestion,hora_gestion,rut_cliente,fechahora,fono_discado,lista,nombre_ejecutivo,Id_TipoGestion,cedente,duracion) VALUES ('$this->nivel1','$this->nivel2','$this->nivel3','$this->fecha_gestion','$this->hora_gestion','$this->rut','$fechahora','$this->fono_discado','piloto','$this->user_dial','$this->tipo_gestion','$this->cedente','$duracion_llamada')");
		echo "ok";
	}
	public function mostrarDeudas($rut,$cedente)
	{
		$this->rut=$rut;
		$this->cedente=$cedente;
		echo '<div class="table-responsive">';
        echo '<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">';
        echo '<thead>';
        echo '<tr><tr>';
        echo '<th class="text-sm">Monto Mora</th>';
        echo '<th class="text-sm"><center>Fecha Vencimiento</center></th>';
        echo '<th class="text-sm"><center>Tipo Deudor</center></th>';
        echo '<th class="text-sm"><center>Cuotas Morosas</center></th>';
         echo '<th class="text-sm"><center>Cuotas Convenio</center></th></tr>';
        echo '</thead><tbody>';
	    $qd = mysql_query("SELECT Monto_Mora,Saldo_Mora,Fecha_Vencimiento,Tipo_Deudor,Producto,Numero_Operacion,Segmento,Tramo_Dias_Mora,Ano_Deuda,Cuotas_Morosas,Personalizado2 FROM Deuda  WHERE Rut = $this->rut AND Id_Cedente = $this->cedente");
	    while($row = mysql_fetch_array($qd))
	   { 
	       
            echo "<tr >";                                                 
            echo "<td class='text-sm'>$row[0]</td>";             	              
            echo "<td class='text-sm'><center>$row[2]</center></td>";
            echo "<td class='text-sm'><center></center>$row[3]</td></td>";
            echo "<td class='text-sm'><center></center>$row[9]</td></td>";
            echo "<td class='text-sm'><center></center>$row[10]</td></td>";
            echo '</tr>';  
		                                                      
		}	
        echo '</tbody></table></div>'; 
		                                                                                   
	}		
}
?>