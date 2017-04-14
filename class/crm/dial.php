<?php
/** 
*
* @Clase Dial para muestra de pantalla
* @versión: 1.0     @modificado: 6 de Septiembre del 2016
* @autor: Luis Ponce
*
*/

class Dial
{
	public $id_personal;
	public $usuario;
	

	/* Metodo Setter para asignacion de atributos que vienen del Dial por metodo GET */
	public function setDial($fono,$record,$rut,$campana,$user,$cedente,$hora)
	{
		$this->fono=$fono;
		$this->record=$record;
		$this->rut=$rut;
		$this->campana=$campana;
		$this->user=$user;
		$this->cedente=$cedente;
		$this->hora=$hora;
	}
	/* Metodo Get que devuelve atributos para ser mostrados mediante una instancia de clase */
	public function getDial()
	{
		if(isset($this->rut) && $this->rut!='')
		{
			$conexion = new Conexion();
			$mysqli= $conexion->Conectar();	

			$query1 = $mysqli->query("SELECT Persona.Rut,Persona.Digito_Verificador,Persona.Nombres,Direcciones.Direccion,Direcciones.Id_Comuna ,Persona.Apellido_Paterno,Persona.Apellido_Materno,Deuda.Monto_Mora,Deuda.Sucursal,Deuda.Numero_Operacion,Deuda.Fecha_Vencimiento,Mejor_Gestion.Respuesta_N1,Mejor_Gestion.Observacion , Mejor_Gestion.Fecha_Gestion , Mejor_Gestion.Fono_Gestion , Mejor_Gestion.Monto_Compromiso,Deuda.Deuda_Oferta  FROM Persona , Direcciones , Deuda , Mejor_Gestion  WHERE Persona.Rut = $this->rut  AND Persona.Rut = Direcciones.Rut AND Persona.Rut = Deuda.Rut AND Persona.Rut = Mejor_Gestion.Rut  LIMIT 1");

			$query2 = $mysqli->query("SELECT  Ultima_Gestion.Fecha_Gestion,Persona.Rut ,Ultima_Gestion.Respuesta_N1 , Ultima_Gestion.Fono_Gestion ,Ultima_Gestion.Monto_Compromiso,Ultima_Gestion.Observacion , Cantidad_Gestiones.Dias_Sin_gestion,Cantidad_Gestiones.Dias_Desde_Ult_Contacto FROM Persona , Ultima_Gestion,Cantidad_Gestiones WHERE Persona.Rut = $this->rut  AND Persona.Rut = Ultima_Gestion.Rut AND Persona.Rut = Cantidad_Gestiones.Rut  LIMIT 1");

			$query3 = $mysqli->query("SELECT  Id_Personal FROM Personal  WHERE Nombre_Usuario='$this->user'");

			while($row = $query1->fetch_assoc())
			{
			    $rut = $row['Rut'];
			    $dv = $row['Digito_Verificador'];
			    $this->rut_format=$rutformat = $rut."-".$dv;
			    $nombre = $row['Nombres'];
			    $paterno = $row['Apellido_Paterno'];
			    $materno = $row['Apellido_Materno'];
			    $this->nombrefull=$nombrefull = $nombre." ".$paterno." ".$materno;
			    $this->dir=$dir = $row['Direccion'];
			    $this->monto=$monto = $row['Monto_Mora'];
			    $id_comuna = $row['Id_Comuna'];
			    $id_sucursal = $row['Sucursal'];
			    $this->num_operacion=$num_operacion = $row['Numero_Operacion'];
			    $this->fecha_ven=$fecha_ven = $row['Fecha_Vencimiento'];
			    $this->mejor_gestion=$mejor_gestion = $row['Respuesta_N1'];
			    $this->fecha_mejor_gestion=$fecha_mejor_gestion = $row['Fecha_Gestion'];
			    $this->obs_mejor_gestion=$obs_mejor_gestion = $row['Observacion'];
			    $this->fono_mejor_gestion=$fono_mejor_gestion = $row['Fono_Gestion'];
			    $this->castigo=$castigo = date("Y", strtotime($fecha_ven));

			    
			    if ($obs_mejor_gestion==NULL)
			    {
			    	$this->obs_mejor_gestion=$obs_mejor_gestion = "Sin Observacion";
			    }

			    else
			    {
			    	$this->obs_mejor_gestion=$obs_mejor_gestion = $obs_mejor_gestion;
			    }	

			    $monto_compromiso = $row['Monto_Compromiso'];

			    if ($monto_compromiso==NULL)
			    {
			    	$this->monto_compromiso=$monto_compromiso = "Sin Monto";
			    }

			    else
			    {
			    	$this->monto_compromiso=$monto_compromiso = $monto_compromiso;
			    }	

			    $deuda_oferta = $row['Deuda_Oferta'];

			    if ($deuda_oferta==NULL)
			    {
			    	$this->deuda_oferta=$deuda_oferta = "Sin Oferta";
			    }

			    else
			    {
			    	$this->deuda_oferta=$deuda_oferta= $deuda_oferta;
			    }

			    $query_comuna= $mysqli->query("SELECT Nombre FROM Comuna WHERE Id_Comuna = $id_comuna LIMIT 1");
			    while($row = $query_comuna->fetch_assoc())
			    {
					$this->comuna=$comuna = $row['Nombre'];
				}

				$query_sucursal= $mysqli->query("SELECT Nombre_Sucursal FROM Sucursal WHERE Sucursal = $id_sucursal LIMIT 1");
			    while($row = $query_sucursal->fetch_assoc())
			    {
					$this->sucursal=$sucursal = $row['Nombre_Sucursal'];
				}

				$query_personal= $mysqli->query("SELECT Nombre FROM Personal WHERE Nombre_Usuario = '$this->user' LIMIT 1");
			    while($row = $query_personal->fetch_assoc())
			    {
					$this->usuario=$usuario = $row['Nombre'];
				}			
			}
			while($row = $query2->fetch_assoc())
			{
			    $this->fecha_ultima_gestion=$fecha_ultima_gestion = $row['Fecha_Gestion'];
			    $this->ultima_gestion=$ultima_gestion = $row['Respuesta_N1'];
			    $this->fono_ultima_gestion=$fono_ultima_gestion = $row['Fono_Gestion'];
			    $this->ult_monto_compromiso=$ult_monto_compromiso = $row['Monto_Compromiso'];
			    if ($ult_monto_compromiso==NULL)
			    {
			    	$this->ult_monto_compromiso=$ult_monto_compromiso = "Sin Monto";
			    }
			    else
			    {
			    	$this->ult_monto_compromiso=$ult_monto_compromiso = $ult_monto_compromiso;
			    }
			    $ult_obs = $row['Observacion'];
			    if ($ult_obs==NULL)
			    {
			    	$this->ult_obs=$ult_obs = "Sin Observacion";
			    }
			    else
			    {
			    	$this->ult_obs=$ult_obs= $ult_obs;
			    }
			    $dias = $row['Dias_Sin_gestion'];
			    if ($dias==NULL)
			    {
			    	$this->dias=$dias = "Sin Gestion";
			    }
			    else
			    {
			    	$this->dias=$dias= $dias;
			    }	
			    $dias_contacto = $row['Dias_Desde_Ult_Contacto'];
			    if ($dias_contacto==NULL)
			    {
			    	$this->dias_contacto=$dias_contacto = "Sin Contacto";
			    }
			    else
			    {
			    	$this->dias_contacto=$dias_contacto= $dias_contacto;
			    }
			}	
			while($row = $query3->fetch_assoc())
			{
				$this->id_personal=$id_personal = $row['Id_Personal'];			
			}    
			$this->script=$script = "Buenos Dias. / Tardes mi nombre es <b>$usuario</b>, Llamo de Cobranding por encargo de <b>$this->cedente</b> El motivo de mi llamado es por la deuda que mantiene con xxxxxxxxxx por la suma de <b>$ $monto </b> la cual no registra una mora de xxxxx dias.";
		}
	}

	public function nivelA()
	{
		$conexion = new Conexion();
		$mysqli= $conexion->Conectar();	
		$sql = $mysqli->query("SELECT Id_ResultadoN1,Gestion_Nivel_1 FROM Respuesta_Gestion GROUP BY Gestion_Nivel_1");
		echo "<select class='select1' id='nivel1' name='nivel1'  data-width='100%''>";
		echo "<option value='0'>Seleccione Respuesta</option>";
		while ($row=$sql->fetch_assoc())
		{ 
			$id=$row['Id_ResultadoN1'];
			$gestion = utf8_decode($row['Gestion_Nivel_1']);
			echo "<option value='$id'>$gestion</option>";
		} 
		echo "</select>";  
	}

	public function nivelB($id)
	{
		$this->id=$id;
		$conexion = new Conexion();
		$mysqli= $conexion->Conectar();	
		$sql = $mysqli->query("SELECT Id_ResultadoN2 , Gestion_Nivel_2 FROM Respuesta_Gestion WHERE Id_ResultadoN1=$this->id GROUP BY Id_ResultadoN2");
		echo "<select class='select1' id='nivel2' name='nivel2'  name='tipo_estrategia' data-live-search='true' data-width='100%'>";
		echo "<option value='0'>Seleccione Respuesta</option>";
		while ($row=$sql->fetch_assoc())
		{ 
			$id=$row['Id_ResultadoN2'];
			$gestion = utf8_decode($row['Gestion_Nivel_2']);
			echo "<option value='$id'>$gestion</option>";
		} 
		echo "</select>";  
	}
	public function nivelC($id)
	{
		$this->id=$id;
		$conexion = new Conexion();
		$mysqli= $conexion->Conectar();	
		$sql = $mysqli->query("SELECT Id_ResultadoN3 , Gestion_Nivel_3 FROM Respuesta_Gestion WHERE Id_ResultadoN2=$this->id GROUP BY Id_ResultadoN3");
		echo "<select class='select1' id='nivel3' name='nivel3' name='tipo_estrategia' data-live-search='true' data-width='100%'>";
		echo "<option value='0'>Seleccione Respuesta</option>";
		while ($row=$sql->fetch_assoc())
		{ 
			$id=$row['Id_ResultadoN3'];
			$gestion = utf8_decode($row['Gestion_Nivel_3']);
			echo "<option value='$id'>$gestion</option>";
		} 
		echo "</select>";  
	}
	public function insertarGestion($nivel1,$record,$monto,$id_pers,$observacion,$hora,$rut,$fono,$fecha_compromiso)
	{
		$this->nivel1=$nivel1;
		$this->record=$record;
		$this->monto=$monto;
		$this->id_pers=$id_pers;
		$this->observacion=$observacion;
		$this->hora=$hora;
		$this->rut=$rut;
		$this->fono=$fono;
		$this->fecha_compromiso=$fecha_compromiso;
		$fecha_gestion = date('Y-m-d');
		$hora_gestion = date('H:i:s');
		$time_diff = time() - strtotime($this->hora);
		$time = strtotime($this->fecha_compromiso);
		$date_format = date('Y-m-d', $time);
		$conexion = new Conexion();
		$mysqli= $conexion->Conectar();
		if (!$mysqli->query("INSERT INTO Gestion (Id_ResultadoN1,Duracion_Llamada,Fec_Compromiso,Fecha_Gestion,Hora_Gestion,Fono_Gestion,Rut,Observacion,Monto_Compromiso,Id_Cedente,Nombre_Grabacion,Id_Origen,Id_Ejecutivo) VALUES ($this->nivel1,$time_diff,'$date_format','$fecha_gestion','$hora_gestion','$this->fono','$this->rut','$this->observacion',$this->monto,2,'$this->record',1,'$this->id_pers')")) 
		{
    		echo "Falló la creación de la tabla: (" . $mysqli->errno . ") " . $mysqli->error;
		}	
	}					
}
?>