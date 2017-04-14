<?php
include("../../db/db.php");
include("../../mail/class.phpmailer.php");
include("../../mail/class.smtp.php");

include("template.php");
class crm
{

	public function Pantalla($id,$rut,$cedente,$fono,$usuario)
	{
		$this->id=$id;
		$this->rut=$rut;
		$this->cedente=$cedente;
		$this->fono=$fono;
		$this->usuario=$usuario;
		session_start();
		$_SESSION['id_dial'] = $this->id;
		$_SESSION['MM_UserGroup'] = '4';
		$_SESSION['rut_dial'] = $this->rut;
		$_SESSION['cedente_dial'] = $this->cedente;
		$_SESSION['fono_dial'] = $this->fono;
		$_SESSION['MM_Username'] = $this->usuario;
		header('Location: index.php');

		session_start();

	}
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
	public function mostrarCedente2()
	{
		echo "<select class='select1' id='seleccione_cedente2' name='seleccione_cedente2'>";
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
        $sql = mysql_query("SELECT id,cola FROM SIS_Querys_Estrategias WHERE id_estrategia = $this->id  AND terminal = 1 AND discador=1");
        echo "<select  id='seleccione_cola' class='select1' name='seleccione_cola' >";
        echo "<option value='0'>Seleccione</option>";
        while($row = mysql_fetch_array($sql))
        {
        	echo "<option value='$row[0]'>$row[1]</option>";

        }
        echo "</select>";
    }
    public function mostrarRut($Prefijo)
	{
		$this->Prefijo=$Prefijo;

        $q2 = mysql_query("SELECT Rut FROM $this->Prefijo LIMIT 1");
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
        $array = array('uno' => $uno, 'dos' => $rut, 'tres' => $nombre, 'cuatro' => $this->Prefijo, 'cinco' => $cinco);
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
	public function marcarFactura($rut,$cedente,$id_deuda,$id)
	{
		$this->rut=$rut;
		$this->cedente=$cedente;
		$this->id_deuda=$id_deuda;
		$this->id=$id;
		if($this->id ==1)
		{

			session_start();
			$_SESSION['mfacturas'][] = $this->id_deuda;
			$mfacturas = $_SESSION['mfacturas'];
			echo "Factura Adjunta".print_r($mfacturas);
			session_start();
		}
		else
		{
			session_start();
			$clavem = array_search($this->id_deuda, $_SESSION['mfacturas']);
			unset($_SESSION['mfacturas'][$clavem]);
			echo "Factura Removida".$clavem;
			session_start();
		}


	}
	public function marcarMail($id_mail,$id)
	{
		$this->id_mail=$id_mail;
		$this->id=$id;
		if($this->id ==1)
		{

				session_start();
				$_SESSION['correos'][] = $this->id_mail;
				$correos = $_SESSION['correos'];
				echo "Email Activado".print_r($correos);
				session_start();
		}
		else
		{
				session_start();
				$clave = array_search($this->id_mail, $_SESSION['correos']);
				unset($_SESSION['correos'][$clave]);
				echo "Email Desactivado".$clave;
				session_start();
		}
	}

	public function marcarMailcc($id_mail,$id)
	{
		$this->id_mail=$id_mail;
		$this->id=$id;
		if($this->id ==1)
		{

				session_start();
				$_SESSION['correos_cc'][] = $this->id_mail;
				$correos_cc = $_SESSION['correos_cc'];
				echo "Email Activado".print_r($correos_cc);
				session_start();
		}
		else
		{
				session_start();
				$clave_cc = array_search($this->id_mail, $_SESSION['correos_cc']);
				unset($_SESSION['correos_cc'][$clave_cc]);
				echo "Email Desactivado".$clave_cc;
				session_start();
		}
	}

	public function actualizarCorreo($id_mail,$mail,$nombre,$cargo,$obs)
	{
		$this->id_mail=$id_mail;
		$this->mail=$mail;
		$this->nombre=$nombre;
		$this->cargo=$cargo;
		$this->obs=$obs;

		$q = "UPDATE Mail SET correo_electronico='$this->mail',Nombre='$this->nombre',Cargo='$this->cargo',Observacion ='$this->obs'  WHERE id_mail = $this->id_mail";
			mysql_query($q);


	}


	public function enviarMail($cedente,$rut)
	{
		session_start();
		$mailArray = $_SESSION['correos'];
		$mailArraycc = $_SESSION['correos_cc'];
		$facturaArray = $_SESSION['mfacturas'];
		$contarf = count($facturaArray);
		$contarm = count($mailArray);
		if($contarm == 0)
		{
			echo 2;
		}
		else if($contarf == 0)
		{
			echo 3;
		}
		else
		{


			$this->cedente=$cedente;
			$this->rut=$rut;
			if($this->cedente == 48)
			{
				$template = new Template();
				$template->Claro($this->rut,$this->cedente,$mailArray,$facturaArray,$mailArraycc);
			}
			else
			{
				echo 1;
			}
			session_start();
		}

	}
	public function mostrarFonos($rut,$prefijo)
	{
		$this->rut=$rut;
		$this->prefijo=$prefijo;
		$this->mostrandoFonos($this->rut);
	}
	public function mostrarGestionRut($rut)
	{
		$this->rut=$rut;
		$q = mysql_query("SELECT rut_cliente,fecha_gestion,resultado,fono_discado,nombre_ejecutivo,cedente,fec_compromiso,monto_comp,Id_TipoGestion,observacion FROM  gestion_ult_semestre WHERE rut_cliente = $this->rut");
		if(mysql_num_rows($q)==0)
		{
			echo "Rut no registra Gestiones !";
		}
		else
		{
			echo '<div class="table-responsive">';
	        echo '<table id="demo-dt-selection" class="table table-striped table-bordered" cellspacing="0" width="100%">';
	        echo '<thead>';
	        echo '<tr><tr>';
	        echo '<th class="text-sm">Fecha Gestión</th>';
	        echo '<th class="text-sm">Fono Discado</th>';
	        //echo '<th class="text-sm">Nombre Ejecutivo</th>';
	        echo '<th class="text-sm">Respuesta</th>';
	        echo '<th class="text-sm">Sub Respuesta</th>';
	        echo '<th class="text-sm">Sub Respuesta</th>';
	        //echo '<th class="text-sm">Cedente</th>';
	        echo '<th class="text-sm">Fecha Compromiso</th>';
	        echo '<th class="text-sm">Monto Compromiso</th>';
	        echo '<th class="text-sm">Observación</th>';
	        //echo '<th class="text-sm">Tipo Gestión</th></tr>';
	        echo '</thead><tbody>';
		    $q1 = mysql_query("SELECT rut_cliente,fecha_gestion,resultado,fono_discado,nombre_ejecutivo,cedente,fec_compromiso,monto_comp,Id_TipoGestion,Origen,resultado,resultado_n2,resultado_n3 FROM  gestion_ult_semestre WHERE rut_cliente = $this->rut  AND Id_TipoGestion IN (1 ,2 ,5) ORDER BY fecha_gestion DESC LIMIT 20");
		    while($row = mysql_fetch_array($q1))
	        {
	        	$v1 = $row[0];
	        	$v2 = $row[1];
	        	$v3 = $row[2];
	        	$v4 = $row[3];
	        	$v5 = $row[4];
	        	$v6 = $row[5];
	        	$v7 = $row[6];
	        	$v8 = $row[7];
	        	$v9 = $row[8];
	        	$v10 = $row[13];
	        	$origen = $row[9];
	        	$r1 = $row[10];
	        	$r2 = $row[11];
	        	$r3= $row[12];
	        	if($origen==1)
	        	{
		        	if($v7=='' OR $v7=='0000-00-00')
		        	{
		        		$v7 = '---';
		        		$v8 = '---';
		        	}
		        	else
		        	{
		        		$v7 = $v7;
		        		$v8 = $v8;
		        	}

		        	$q2 = mysql_query("SELECT Nombre_Cedente FROM  Cedente WHERE Id_Cedente = $v6");
				    while($row = mysql_fetch_array($q2))
			        {
			        	$va1 = $row[0];
			        }
			        $q3 = mysql_query("SELECT Gestion_Nivel_1 FROM  respuesta_gestion WHERE Id_Respuesta = $v3");
				    while($row = mysql_fetch_array($q3))
			        {
			        	$va2 = $row[0];
			        }
			        $q4 = mysql_query("SELECT Nombre FROM  Tipo_Contacto WHERE Id_TipoContacto = $v9");
				    while($row = mysql_fetch_array($q4))
			        {
			        	$va3 = $row[0];
			        }
		        	$qr1 = mysql_query("SELECT Gestion_Nivel_1 FROM  respuesta_gestion WHERE Id_Respuesta = $r1");
				    while($row = mysql_fetch_array($qr1))
			        {
			        	$res1 = $row[0];
			        }


		        	echo "<tr id='$i'>";
				    echo "<td class='text-sm'>$v2</td>";
				    echo "<td class='text-sm'><center> $v4</center></td>";
				    //echo "<td class='text-sm'><center> $v5</center></td>";
				    echo "<td class='text-sm'><center> $res1</center></td>";
				    echo "<td class='text-sm'><center>---</center></td>";
				    echo "<td class='text-sm'><center>---</center></td>";
				    //echo "<td class='text-sm'><center>$va1</center></td>";
				    echo "<td class='text-sm'><center>$v7</center></td>";
				    echo "<td class='text-sm'><center>$v8</center></td>";
				    echo "<td class='text-sm'><center>$v10</center></td>";
				    //echo "<td class='text-sm'><center>$va3</center></td>";
				    echo '</tr>';
				}
				else
				{

		        	if($v7=='' OR $v7=='0000-00-00')
		        	{
		        		$v7 = '---';
		        		$v8 = '---';
		        	}
		        	else
		        	{
		        		$v7 = $v7;
		        		$v8 = $v8;
		        	}

		        	$q2 = mysql_query("SELECT Nombre_Cedente FROM  Cedente WHERE Id_Cedente = $v6");
				    while($row = mysql_fetch_array($q2))
			        {
			        	$va1 = $row[0];
			        }
			        $q3 = mysql_query("SELECT Respuesta_N1 FROM  Nivel1 WHERE id = $r1");
				    while($row = mysql_fetch_array($q3))
			        {
			        	$re1 = utf8_encode($row[0]);
			        }
			        $q5 = mysql_query("SELECT Respuesta_N2 FROM  Nivel2 WHERE id = $r2");
				    while($row = mysql_fetch_array($q5))
			        {
			        	$re2 = utf8_encode($row[0]);
			        }
			        $q6 = mysql_query("SELECT Respuesta_N3 FROM  Nivel3 WHERE id = $r3");
				    while($row = mysql_fetch_array($q6))
			        {
			        	$re3 = utf8_encode($row[0]);
			        }
			        $q4 = mysql_query("SELECT Nombre FROM  Tipo_Contacto WHERE Id_TipoContacto = $v9");
				    while($row = mysql_fetch_array($q4))
			        {
			        	$va3 = $row[0];
			        }
				    echo "<tr id='$i'>";
				    echo "<td class='text-sm'>$v2</td>";
				    echo "<td class='text-sm'><center> $v4</center></td>";
				    //echo "<td class='text-sm'><center> $v5</center></td>";
				    echo "<td class='text-sm'><center> $re1</center></td>";
				    echo "<td class='text-sm'><center> $re2</center></td>";
				    echo "<td class='text-sm'><center> $re3</center></td>";
				    //echo "<td class='text-sm'><center> $va1</center></td>";
				    echo "<td class='text-sm'><center>$v7 </center></td>";
				    echo "<td class='text-sm'><center>$v8 </center></td>";
				    //echo "<td class='text-sm'><center>$va3 </center></td>";
				    echo "<td class='text-sm'><center>$v10</center></td>";
				    echo '</tr>';
				}

	    	}
	    	echo '</tbody></table></div>';
    	}

	}
	public function mostrarGestionTotal($rut)
	{
		$this->rut=$rut;
		$q = mysql_query("SELECT rut_cliente,fecha_gestion,resultado,fono_discado,nombre_ejecutivo,cedente,fec_compromiso,monto_comp,Id_TipoGestion FROM  gestion_ult_semestre WHERE rut_cliente = $this->rut");
		if(mysql_num_rows($q)==0)
		{
			echo "Rut no registra Gestiones !";
		}
		else
		{
			echo '<div class="table-responsive">';
	        echo '<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">';
	        echo '<thead>';
	        echo '<tr><tr>';
	        echo '<th class="text-sm">Fecha Gestión</th>';
	        echo '<th class="text-sm">Fono Discado</th>';
	       // echo '<th class="text-sm">Nombre Ejecutivo</th>';
	        echo '<th class="text-sm">Respuesta</th>';
	        echo '<th class="text-sm">Sub Respuesta</th>';
	        echo '<th class="text-sm">Sub Respuesta</th>';
	        //echo '<th class="text-sm">Cedente</th>';
	        echo '<th class="text-sm">Fecha Compromiso</th>';
	        echo '<th class="text-sm">Monto Compromiso</th>';
	        //echo '<th class="text-sm">Tipo Gestión</th></tr>';
	         echo '<th class="text-sm">Observación</th>';
	        echo '</thead><tbody>';
		    $q1 = mysql_query("SELECT rut_cliente,fecha_gestion,resultado,fono_discado,nombre_ejecutivo,cedente,fec_compromiso,monto_comp,Id_TipoGestion,Origen,resultado,resultado_n2,resultado_n3,observacion FROM  gestion_ult_semestre WHERE rut_cliente = $this->rut   ORDER BY fecha_gestion DESC LIMIT 20");
		    while($row = mysql_fetch_array($q1))
	        {
	        	$v1 = $row[0];
	        	$v2 = $row[1];
	        	$v3 = $row[2];
	        	$v4 = $row[3];
	        	$v5 = $row[4];
	        	$v6 = $row[5];
	        	$v7 = $row[6];
	        	$v8 = $row[7];
	        	$v9 = $row[8];
	        	$v10 = $row[13];
	        	$origen = $row[9];
	        	$r1 = $row[10];
	        	$r2 = $row[11];
	        	$r3= $row[12];
	        	if($origen==1)
	        	{
		        	if($v7=='' OR $v7=='0000-00-00')
		        	{
		        		$v7 = '---';
		        		$v8 = '---';
		        	}
		        	else
		        	{
		        		$v7 = $v7;
		        		$v8 = $v8;
		        	}

		        	$q2 = mysql_query("SELECT Nombre_Cedente FROM  Cedente WHERE Id_Cedente = $v6");
				    while($row = mysql_fetch_array($q2))
			        {
			        	$va1 = $row[0];
			        }
			        $q3 = mysql_query("SELECT Gestion_Nivel_1 FROM  respuesta_gestion WHERE Id_Respuesta = $v3");
				    while($row = mysql_fetch_array($q3))
			        {
			        	$va2 = $row[0];
			        }
			        $q4 = mysql_query("SELECT Nombre FROM  Tipo_Contacto WHERE Id_TipoContacto = $v9");
				    while($row = mysql_fetch_array($q4))
			        {
			        	$va3 = $row[0];
			        }
		        	$qr1 = mysql_query("SELECT Gestion_Nivel_1 FROM  respuesta_gestion WHERE Id_Respuesta = $r1");
				    while($row = mysql_fetch_array($qr1))
			        {
			        	$res1 = $row[0];
			        }


		        	echo "<tr id='$i'>";
				    echo "<td class='text-sm'>$v2</td>";
				    echo "<td class='text-sm'><center> $v4</center></td>";
				    //echo "<td class='text-sm'><center> $v5</center></td>";
				    echo "<td class='text-sm'><center> $res1</center></td>";
				    echo "<td class='text-sm'><center>---</center></td>";
				    echo "<td class='text-sm'><center>---</center></td>";
				    //echo "<td class='text-sm'><center>$va1</center></td>";
				    echo "<td class='text-sm'><center>$v7</center></td>";
				    echo "<td class='text-sm'><center>$v8</center></td>";
				    //echo "<td class='text-sm'><center>$va3</center></td>";
				    echo "<td class='text-sm'><center>$v10</center></td>";
				    echo '</tr>';
				}
				else
				{

		        	if($v7=='' OR $v7=='0000-00-00')
		        	{
		        		$v7 = '---';
		        		$v8 = '---';
		        	}
		        	else
		        	{
		        		$v7 = $v7;
		        		$v8 = $v8;
		        	}

		        	$q2 = mysql_query("SELECT Nombre_Cedente FROM  Cedente WHERE Id_Cedente = $v6");
				    while($row = mysql_fetch_array($q2))
			        {
			        	$va1 = $row[0];
			        }
			        $q3 = mysql_query("SELECT Respuesta_N1 FROM  Nivel1 WHERE id = $r1");
				    while($row = mysql_fetch_array($q3))
			        {
			        	$re1 = utf8_encode($row[0]);
			        }
			        $q5 = mysql_query("SELECT Respuesta_N2 FROM  Nivel2 WHERE id = $r2");
				    while($row = mysql_fetch_array($q5))
			        {
			        	$re2 = utf8_encode($row[0]);
			        }
			        $q6 = mysql_query("SELECT Respuesta_N3 FROM  Nivel3 WHERE id = $r3");
				    while($row = mysql_fetch_array($q6))
			        {
			        	$re3 = utf8_encode($row[0]);
			        }
			        $q4 = mysql_query("SELECT Nombre FROM  Tipo_Contacto WHERE Id_TipoContacto = $v9");
				    while($row = mysql_fetch_array($q4))
			        {
			        	$va3 = $row[0];
			        }
				    echo "<tr id='$i'>";
				    echo "<td class='text-sm'>$v2</td>";
				    echo "<td class='text-sm'><center> $v4</center></td>";
				    //echo "<td class='text-sm'><center> $v5</center></td>";
				    echo "<td class='text-sm'><center> $re1</center></td>";
				    echo "<td class='text-sm'><center> $re2</center></td>";
				    echo "<td class='text-sm'><center> $re3</center></td>";
				    //echo "<td class='text-sm'><center> $va1</center></td>";
				    echo "<td class='text-sm'><center>$v7 </center></td>";
				    echo "<td class='text-sm'><center>$v8 </center></td>";
				    //echo "<td class='text-sm'><center>$va3 </center></td>";
				    echo "<td class='text-sm'><center>$v10</center></td>";
				    echo '</tr>';
				}

	    	}
	    	echo '</tbody></table></div>';
    	}

	}
	public function mostrarGestionDiaria($rut)
	{
		$this->rut=$rut;
		$q = mysql_query("SELECT rut_cliente,fecha_gestion,resultado,fono_discado,nombre_ejecutivo,cedente,fec_compromiso,monto_comp,Id_TipoGestion FROM  gestion_ult_semestre WHERE rut_cliente = $this->rut");
		if(mysql_num_rows($q)==0)
		{
			echo "Rut no registra Gestiones !";
		}
		else
		{
			echo '<div class="table-responsive">';
	        echo '<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">';
	        echo '<thead>';
	        echo '<tr><tr>';
	        echo '<th class="text-sm">Fecha Gestión</th>';
	        echo '<th class="text-sm">Fono Discado</th>';
	       // echo '<th class="text-sm">Nombre Ejecutivo</th>';
	        echo '<th class="text-sm">Respuesta</th>';
	        echo '<th class="text-sm">Sub Respuesta</th>';
	        echo '<th class="text-sm">Sub Respuesta</th>';
	        //echo '<th class="text-sm">Cedente</th>';
	        echo '<th class="text-sm">Fecha Compromiso</th>';
	        echo '<th class="text-sm">Monto Compromiso</th>';
	        //echo '<th class="text-sm">Tipo Gestión</th></tr>';
	         echo '<th class="text-sm">Observación</th>';
	        echo '</thead><tbody>';
		    $q1 = mysql_query("SELECT rut_cliente,fecha_gestion,resultado,fono_discado,nombre_ejecutivo,cedente,fec_compromiso,monto_comp,Id_TipoGestion,Origen,resultado,resultado_n2,resultado_n3,observacion FROM  gestion_ult_semestre WHERE rut_cliente = $this->rut   ORDER BY fecha_gestion DESC LIMIT 20");
		    while($row = mysql_fetch_array($q1))
	        {
	        	$v1 = $row[0];
	        	$v2 = $row[1];
	        	$v3 = $row[2];
	        	$v4 = $row[3];
	        	$v5 = $row[4];
	        	$v6 = $row[5];
	        	$v7 = $row[6];
	        	$v8 = $row[7];
	        	$v9 = $row[8];
	        	$v10 = $row[13];
	        	$origen = $row[9];
	        	$r1 = $row[10];
	        	$r2 = $row[11];
	        	$r3= $row[12];
	        	if($origen==1)
	        	{
		        	if($v7=='' OR $v7=='0000-00-00')
		        	{
		        		$v7 = '---';
		        		$v8 = '---';
		        	}
		        	else
		        	{
		        		$v7 = $v7;
		        		$v8 = $v8;
		        	}

		        	$q2 = mysql_query("SELECT Nombre_Cedente FROM  Cedente WHERE Id_Cedente = $v6");
				    while($row = mysql_fetch_array($q2))
			        {
			        	$va1 = $row[0];
			        }
			        $q3 = mysql_query("SELECT Gestion_Nivel_1 FROM  respuesta_gestion WHERE Id_Respuesta = $v3");
				    while($row = mysql_fetch_array($q3))
			        {
			        	$va2 = $row[0];
			        }
			        $q4 = mysql_query("SELECT Nombre FROM  Tipo_Contacto WHERE Id_TipoContacto = $v9");
				    while($row = mysql_fetch_array($q4))
			        {
			        	$va3 = $row[0];
			        }
		        	$qr1 = mysql_query("SELECT Gestion_Nivel_1 FROM  respuesta_gestion WHERE Id_Respuesta = $r1");
				    while($row = mysql_fetch_array($qr1))
			        {
			        	$res1 = $row[0];
			        }


		        	echo "<tr id='$i'>";
				    echo "<td class='text-sm'>$v2</td>";
				    echo "<td class='text-sm'><center> $v4</center></td>";
				    //echo "<td class='text-sm'><center> $v5</center></td>";
				    echo "<td class='text-sm'><center> $res1</center></td>";
				    echo "<td class='text-sm'><center>---</center></td>";
				    echo "<td class='text-sm'><center>---</center></td>";
				    //echo "<td class='text-sm'><center>$va1</center></td>";
				    echo "<td class='text-sm'><center>$v7</center></td>";
				    echo "<td class='text-sm'><center>$v8</center></td>";
				    //echo "<td class='text-sm'><center>$va3</center></td>";
				    echo "<td class='text-sm'><center>$v10</center></td>";
				    echo '</tr>';
				}
				else
				{

		        	if($v7=='' OR $v7=='0000-00-00')
		        	{
		        		$v7 = '---';
		        		$v8 = '---';
		        	}
		        	else
		        	{
		        		$v7 = $v7;
		        		$v8 = $v8;
		        	}

		        	$q2 = mysql_query("SELECT Nombre_Cedente FROM  Cedente WHERE Id_Cedente = $v6");
				    while($row = mysql_fetch_array($q2))
			        {
			        	$va1 = $row[0];
			        }
			        $q3 = mysql_query("SELECT Respuesta_N1 FROM  Nivel1 WHERE id = $r1");
				    while($row = mysql_fetch_array($q3))
			        {
			        	$re1 = utf8_encode($row[0]);
			        }
			        $q5 = mysql_query("SELECT Respuesta_N2 FROM  Nivel2 WHERE id = $r2");
				    while($row = mysql_fetch_array($q5))
			        {
			        	$re2 = utf8_encode($row[0]);
			        }
			        $q6 = mysql_query("SELECT Respuesta_N2 FROM  Nivel3 WHERE id = $r3");
				    while($row = mysql_fetch_array($q6))
			        {
			        	$re3 = utf8_encode($row[0]);
			        }
			        $q4 = mysql_query("SELECT Nombre FROM  Tipo_Contacto WHERE Id_TipoContacto = $v9");
				    while($row = mysql_fetch_array($q4))
			        {
			        	$va3 = $row[0];
			        }
				    echo "<tr id='$i'>";
				    echo "<td class='text-sm'>$v2</td>";
				    echo "<td class='text-sm'><center> $v4</center></td>";
				    //echo "<td class='text-sm'><center> $v5</center></td>";
				    echo "<td class='text-sm'><center> $re1</center></td>";
				    echo "<td class='text-sm'><center> $re2</center></td>";
				    echo "<td class='text-sm'><center> $re3</center></td>";
				    //echo "<td class='text-sm'><center> $va1</center></td>";
				    echo "<td class='text-sm'><center>$v7 </center></td>";
				    echo "<td class='text-sm'><center>$v8 </center></td>";
				    //echo "<td class='text-sm'><center>$va3 </center></td>";
				    echo "<td class='text-sm'><center>$v10</center></td>";
				    echo '</tr>';
				}

	    	}
	    	echo '</tbody></table></div>';
    	}

	}
	public function mostrarPagosRut($rut)
	{
		$this->rut=$rut;
		$q = mysql_query("SELECT Rut, Fecha_Pago,Monto_Pago,Id_Cedente FROM  Pagos WHERE Rut = $this->rut");
		if(mysql_num_rows($q)==0)
		{
			echo "Rut no registra Pagos !";
		}
		else
		{
			echo '<div class="table-responsive">';
		    echo '<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">';
		    echo '<thead>';
		    echo '<tr><tr>';
		    echo '<th class="text-sm"><center>Rut</center></th>';
		    echo '<th class="text-sm">Fecha Pago</th>';
		    echo '<th class="text-sm">Monto Pago</th>';
		    echo '<th class="text-sm">Numero Factura</th></tr>';
		    echo '</thead><tbody>';
		    $q1 = mysql_query("SELECT Rut, Fecha_Pago,Monto_Pago,Numero_Operacion FROM  Pagos WHERE Rut = $this->rut ");
		    while($row = mysql_fetch_array($q1))
		    {
		    	$v1 = $row[0];
		    	$v2 = $row[1];
		    	$v3 = $row[2];
		    	$v4 = $row[3];
			    echo "<tr id='$i'>";
			    echo "<td class='text-sm'>$v1</td>";
			    echo "<td class='text-sm'>$v2</td>";
			    echo "<td class='text-sm'>$v3</td>";
			    echo "<td class='text-sm'>$v4</td>";
			    echo '</tr>';
			}
			echo '</tbody></table></div>';
    	}

	}

	public function mostrandoFonos($rut)
	{
		$this->rut=$rut;
		echo '<div class="table-responsive">';
        echo '<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">';
        echo '<thead>';
        echo '<tr><tr>';
        echo '<th class="text-sm"><center>Color</center></th>';
        echo '<th class="text-sm">Comentario</th>';
        echo '<th class="text-sm">Numero</th>';
        echo '<th class="text-sm">Fecha Carga</th>';
        echo '<th class="text-sm">Origen</th>';
        echo '<th class="text-sm"><center>Fono Gestión</center></th>';
        echo '<th class="text-sm"><center>Llamar</center></th></tr>';
        echo '</thead><tbody>';

        $qc = mysql_query("SELECT formato_subtel,color,fecha_carga,cedente  FROM  fono_cob WHERE Rut = $this->rut order by color DESC LIMIT 10");
   		$i=1;
   		while($row = mysql_fetch_array($qc))
    	{
    		$f1 = $row[0];
    		$c = $row[1];
    		$g1 = $row[2];
    		$g2 = $row[3];
    		if($g2=='')
    		{
    			$g2 = "Cobranding";
    		}
    		else
    		{
    			$g2 = $g2;
    		}
    		$qc1 = mysql_query("SELECT color,comentario  FROM SIS_Colores WHERE id = $c  ");

       		while($row = mysql_fetch_array($qc1))
        	{

			   	$color1 = $row[0];
			   	$comentario = $row[1];
			    echo "<tr id='$i'>";
			    echo "<td class='text-sm'><center><i class='fa fa-flag fa-lg icon-lg' style='color:$color1'></i> </center></td>";
			    echo "<td class='text-sm'>$comentario</td>";
			    echo "<td class='text-sm'><input type='hidden' id='telefono$i' value='$f1' name='telefono$i'>$f1</td>";
			    echo "<td class='text-sm'>$g1</td>";
			    echo "<td class='text-sm'>$g2</td>";
			    echo "<td class='text-sm'><center><input type='checkbox' class='fono_gestion' name='fg$i' value='fg$i' id='fg$i' ></center></td>";
			    echo "<td class='text-sm'><center><button disabled='disabled' class='btn btn-dark btn-icon icon-lg fa fa-phone llamar_api' id='call$i' value='1'> Llamar</button> </center></td>";

			    echo '</tr>';
			    $i++;
			}
	    }
        echo '</tbody></table></div>';
	}

	public function insertarFonos($rut,$fono_discado_nuevo)
	{
		$this->rut=$rut;
		$this->fono_discado_nuevo=$fono_discado_nuevo;
		$fecha_carga = date("Y-m-d");
		mysql_query("INSERT INTO fono_cob(Rut,formato_subtel,color,formato_dial,numero_telefono,fecha_carga,cedente) VALUES ('$this->rut','$this->fono_discado_nuevo',100,'$this->fono_discado_nuevo','$this->fono_discado_nuevo','$fecha_carga','foco' ) ON DUPLICATE KEY UPDATE color = 100, fecha_carga = '$fecha_carga', cedente = 'foco'");
		$this->mostrandoFonos($this->rut);
	}
	public function insertarDireccion($rut,$direccion_nuevo)
	{
		$this->rut=$rut;
		$this->direccion_nuevo=$direccion_nuevo;
		mysql_query("INSERT INTO Direcciones(Rut,Direccion) VALUES ('$this->rut','$this->direccion_nuevo')");
		echo '<div class="table-responsive">';
        echo '<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">';
        echo '<thead>';
        echo '<tr><tr>';
        echo '<th class="text-sm"><center>Direccion</center></th></tr>';
        echo '</thead><tbody>';
        $q1 = mysql_query("SELECT Direccion  FROM  Direcciones WHERE Rut = $this->rut ");
   		while($row = mysql_fetch_array($q1))
    	{
    		$d1 = $row[0];
		    echo "<tr id='$i'>";
		    echo "<td class='text-sm'>$d1</td>";
		    echo '</tr>';
	    }
        echo '</tbody></table></div>';

	}
	public function validarRut($rut,$cedente)
	{
		$this->rut=$rut;
		$this->cedente=$cedente;
		$q = mysql_query("SELECT Rut,Id_Cedente FROM Persona WHERE Rut = $this->rut AND  FIND_IN_SET('$this->cedente',Id_Cedente)");
		$q2 = mysql_query("SELECT Nombre_Completo FROM Persona WHERE Rut = $this->rut");
		while($row = mysql_fetch_array($q2))
		{
			$nombre = $row['0'];
		}
		if(mysql_num_rows($q)==0)
		{
			$array = array('uno' => 0, 'dos' => $nombre);

		}
		else
		{
			$array = array('uno' => 1, 'dos' => $nombre);
		}
		echo json_encode($array);

	}
	public function verCargo()
	{
		echo '<div class="row">';
		echo '<div class="col-md-12">';
		echo '<form class="form-horizontal">';
		echo '<div class="form-group">';
		echo '<label class="col-md-4 control-label" for="name">Nombre</label>';
		echo '<div class="col-md-4" lateral>';
		echo '<input id="nombre" name="nombre" type="text" class="form-control input-md lateral2"/>';
		echo '</div>';
		echo '</div>';
		echo '<div class="form-group">';
		echo '<label class="col-md-4 control-label" for="name">Nuevo Correo</label>';
		echo '<div class="col-md-4">';
		echo '<input id="correo_nuevo" name="name" type="text" placeholder="" class="form-control input-md" >';
		echo '</div>';
		echo '</div>';
		echo '<div class="form-group">';
		echo '<label class="col-md-4 control-label" for="name">Cargo</label>';
		echo '<div class="col-md-4 ">';
		echo "<select class='select1 col-md-4 lateral' id='cargo' name='cargo' >";
        $q=mysql_query("SELECT id,Cargo FROM Mail_Cargo");
       	echo "<option value='0'>Seleccione</option>";
        while($row=mysql_fetch_array($q))
        {
        	echo "<option value='$row[0]'>"; echo utf8_encode($row[1]); echo "</option>";
        }
        echo "</select>";
		echo '</div>';
		echo '</div>';
		echo '<div class="form-group">';
		echo '<label class="col-md-4 control-label" for="name">Tipo Uso</label>';
		echo '<div class="col-md-4">';
		echo '<select class="selectpicker" multiple title="Seleccione los items..."  name="uso" id="uso" data-width="80%">';
        $q2=mysql_query("SELECT id,Uso FROM Mail_Uso");
        while($row=mysql_fetch_array($q2))
        {

           echo "<option value='$row[0]'>"; echo utf8_encode($row[1]); echo "</option>";

        }
        echo '</select>';
		echo '</div>';
		echo '</div>';
		echo '</form>';
		echo '</div>';
		echo '</div>';
	}
	public function verCargo2()
	{
		echo '<div class="row">';
		echo '<div class="col-md-12">';
		echo '<form class="form-horizontal">';
		echo '<div class="form-group">';
		echo '<label class="col-md-4 control-label" for="name">Nombre</label>';
		echo '<div class="col-md-4" lateral>';
		echo '<input id="nombre_cc" name="nombre_cc" type="text" class="form-control input-md lateral2"/>';
		echo '</div>';
		echo '</div>';
		echo '<div class="form-group">';
		echo '<label class="col-md-4 control-label" for="name">Nuevo Correo</label>';
		echo '<div class="col-md-4">';
		echo '<input id="correo_nuevo_cc" name="name" type="text" placeholder="" class="form-control input-md" >';
		echo '</div>';
		echo '</div>';
		echo '<div class="form-group">';
		echo '<label class="col-md-4 control-label" for="name">Cargo</label>';
		echo '<div class="col-md-4 ">';
		echo "<select class='select1 col-md-4 lateral' id='cargo_cc' name='cargo' >";
        $q=mysql_query("SELECT id,Cargo FROM Mail_Cargo");
       	echo "<option value='0'>Seleccione</option>";
        while($row=mysql_fetch_array($q))
        {
        	echo "<option value='$row[0]'>"; echo utf8_encode($row[1]); echo "</option>";
        }
        echo "</select>";
		echo '</div>';
		echo '</div>';
		echo '<div class="form-group">';
		echo '<label class="col-md-4 control-label" for="name">Tipo Uso</label>';
		echo '<div class="col-md-4">';
		echo '<select class="selectpicker" multiple title="Seleccione los items..."  name="uso" id="uso_cc" data-width="80%">';
        $q2=mysql_query("SELECT id,Uso FROM Mail_Uso");
        while($row=mysql_fetch_array($q2))
        {

           echo "<option value='$row[0]'>"; echo utf8_encode($row[1]); echo "</option>";

        }
        echo '</select>';
		echo '</div>';
		echo '</div>';
		echo '</form>';
		echo '</div>';
		echo '</div>';
	}
	public function insertarCorreo($rut,$correo_nuevo,$cargo,$uso,$nombre)
	{
		$this->rut=$rut;
		$this->correo_nuevo=$correo_nuevo;
		$this->cargo=$cargo;
		$this->uso=$uso;
		$this->nombre=$nombre;

		mysql_query("INSERT INTO Mail(rut,correo_electronico,Cargo,Tipo_Uso,Nombre) VALUES ('$this->rut','$this->correo_nuevo','$this->cargo','$this->uso','$this->nombre')");
		$this->mostrarCorreoRut($this->rut);

	}
		public function insertarCorreocc($rut,$correo_nuevo,$cargo,$uso,$nombre)
	{
		$this->rut=$rut;
		$this->correo_nuevo=$correo_nuevo;
		$this->cargo=$cargo;
		$this->uso=$uso;
		$this->nombre=$nombre;

		mysql_query("INSERT INTO Mail_CC(rut,correo_electronico,Cargo,Tipo_Uso,Nombre) VALUES ('$this->rut','$this->correo_nuevo','$this->cargo','$this->uso','$this->nombre')");
		$this->mostrarCorreoRutcc($this->rut);

	}
	public function mostrarDireccionRut($rut)
	{
		$this->rut=$rut;
		$q = mysql_query("SELECT Direccion FROM  Direcciones WHERE Rut = $this->rut ");
		if(mysql_num_rows($q)==0)
		{
			echo "Rut no registra Direcciones , Haga Click en el Boton <b>+ </b>Para Agregar una.";
		}
		else
		{
			echo '<div class="table-responsive">';
	        echo '<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">';
	        echo '<thead>';
	        echo '<tr><tr>';

	        echo '<th class="text-sm">Direccion</th></tr>';
	        echo '</thead><tbody>';
		    $q1 = mysql_query("SELECT Direccion FROM  Direcciones WHERE Rut = $this->rut ");
		    while($row = mysql_fetch_array($q1))
	        {
	        	$v1 = $row[0];

			    echo "<tr id='$i'>";
			    echo "<td class='text-sm'>$v1</td>";
			    echo '</tr>';
	    	}
	    	echo '</tbody></table></div>';
    	}

	}

	public function mostrarCorreoRut($rut)
	{
		$this->rut=$rut;
		$q = mysql_query("SELECT correo_electronico FROM  Mail WHERE rut = $this->rut ");
		if(mysql_num_rows($q)==0)
		{
			echo "Rut no registra Correos Electrónicos , Haga Click en el Boton <b>+ </b>Para Agregar uno nuevo.";
		}
		else
		{
			echo '<div class="table-responsive">';
	        echo '<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">';
	        echo '<thead>';
	        echo '<tr><tr>';
	        echo '<th class="text-sm">Correo</th>';
	        echo '<th class="text-sm">Nombre</th>';
	        echo '<th class="text-sm">Observación</th>';
	        echo '<th class="text-sm"><center>Cargo</center></th>';
	        echo '<th class="text-sm"><center>Tipo Uso</center></th>';
	        echo '<th class="text-sm"><center>Enviar</center></th>';
	        echo '</tr>';
	        echo '</thead><tbody>';
	        $i=1;
	        $q1 = mysql_query("SELECT correo_electronico,Cargo,Tipo_Uso,id_mail,Nombre,Observacion FROM  Mail WHERE rut = $this->rut ");
	   		while($row = mysql_fetch_array($q1))
	    	{
	    		$d1 = $row[0];
	    		$d2 = $row[1];
	    		$d3 = $row[2];
	    		$d4 = $row[3];
	    		$d5 = $row[4];
	    		$d6 = $row[5];
			    echo "<tr id='$i' class='$d4'>";
			    echo "<td class='text-sm'><input type='text' class='correo_cambiar text6' value='$d1' id='correo$i'></td>";
			    $q2 = mysql_query("SELECT Cargo FROM  Mail_Cargo WHERE id = $d2");
				while($row = mysql_fetch_array($q2))
			    {
			       	$c1 = $row[0];
			    }
			    $q3 = mysql_query("SELECT Uso FROM  Mail_Uso WHERE id = $d3");
				while($row = mysql_fetch_array($q3))
			    {
			       	$c2 = $row[0];

			    }
			    echo "<td class='text-sm'><center><input type='text' class='correo_cambiar text6' value='$d5' id='nombre$i'></center></td>";
			    echo "<td class='text-sm'><center><input type='text' class='correo_cambiar text6' value='$d6' id='obs$i'></center></td>";
			    echo "<td class='text-sm'><center>$c1</center></td>";
			    echo "<td class='text-sm'><center>$c2</center></td>";
			    echo "<td class='text-sm'><center><input type='checkbox' class='adjuntar' name='l$i' value='l$i' id='l$i' ></center></td>";
			    echo '</tr>';
			    $i++;
		    }
	        echo '</tbody></table></div><button class="btn btn-primary adjuntar_boton" disabled = "disabled"  id="enviar_factura">Enviar</button>';
    	}

	}
	public function mostrarCorreoRutcc($rut)
	{
		$this->rut=$rut;
		$q = mysql_query("SELECT correo_electronico FROM  Mail_CC ");
		if(mysql_num_rows($q)==0)
		{
			echo "Rut no registra Correos Electrónicos , Haga Click en el Boton <b>+ </b>Para Agregar uno nuevo.";
		}
		else
		{
			echo '<div class="table-responsive">';
	        echo '<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">';
	        echo '<thead>';
	        echo '<tr><tr>';
	        echo '<th class="text-sm">Correo</th>';
	        echo '<th class="text-sm">Nombre</th>';
	        echo '<th class="text-sm">Observación</th>';
	        echo '<th class="text-sm"><center>Cargo</center></th>';
	        echo '<th class="text-sm"><center>Tipo Uso</center></th>';
	        echo '<th class="text-sm"><center>Enviar</center></th>';
	        echo '</tr>';
	        echo '</thead><tbody>';
	        $k=1;
	        $q1 = mysql_query("SELECT correo_electronico,Cargo,Tipo_Uso,id_mail,Nombre,Observacion FROM  Mail_CC ");
	   		while($row = mysql_fetch_array($q1))
	    	{
	    		$d1 = $row[0];
	    		$d2 = $row[1];
	    		$d3 = $row[2];
	    		$d4 = $row[3];
	    		$d5 = $row[4];
	    		$d6 = $row[5];
			    echo "<tr id='$k' class='$d4'>";
			    echo "<td class='text-sm'><input type='text' class='correo_cambiar_cc text6' value='$d1' id='correo_cc$k'></td>";
			    $q2 = mysql_query("SELECT Cargo FROM  Mail_Cargo WHERE id = $d2");
				while($row = mysql_fetch_array($q2))
			    {
			       	$c1 = $row[0];
			    }
			    $q3 = mysql_query("SELECT Uso FROM  Mail_Uso WHERE id = $d3");
				while($row = mysql_fetch_array($q3))
			    {
			       	$c2 = $row[0];

			    }
			    echo "<td class='text-sm'><center><input type='text' class='correo_cambiar_cc text6' value='$d5' id='nombre_cc$k'></center></td>";
			    echo "<td class='text-sm'><center><input type='text' class='correo_cambiar_cc text6' value='$d6' id='obs_cc$k'></center></td>";
			    echo "<td class='text-sm'><center>$c1</center></td>";
			    echo "<td class='text-sm'><center>$c2</center></td>";
			    echo "<td class='text-sm'><center><input type='checkbox' class='adjuntar_cc' name='l_cc$k' value='l_cc$k' id='l_cc$k' ></center></td>";
			    echo '</tr>';
			    $k++;
		    }
	        echo '</tbody></table></div>';
    	}

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
	public function nivel_rapido($cedente)
	{
		$this->cedente=$cedente;
		echo "<select class='select1' id='respuesta' name='respuesta'>";
        $result=mysql_query("SELECT n3.Respuesta_N3 as Respuesta_Rapida, n3.id as respuesta_n3
							 FROM Nivel3 n3, Respuesta_Rapida r
							 WHERE r.Respuesta_Nivel3 = n3.id and FIND_IN_SET($this->cedente,r.Id_Cedente)");
       	echo "<option value='0'>Seleccione</option>";
        while($row=mysql_fetch_array($result))
        {
        	echo "<option value='$row[1]'>"; echo utf8_encode($row[0]); echo "</option>";
        }
        echo "</select>";
	}
	public function nivel1($cedente)
	{
		$this->cedente=$cedente;
		echo "<select class='select1' id='seleccione_nivel1' name='seleccione_nivel1'>";
        $result=mysql_query("SELECT Id,Respuesta_N1 FROM Nivel1 WHERE FIND_IN_SET($this->cedente,Id_Cedente) ");
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
        $result=mysql_query("SELECT Id,Respuesta_N2 FROM Nivel2 WHERE $this->nivel2 = Id_Nivel1 ");
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
        $result=mysql_query("SELECT id,Respuesta_N3 FROM Nivel3 WHERE $this->nivel3 = Id_Nivel2 ");
       	echo '<option value="0">Seleccione</option>';
        while($row=mysql_fetch_array($result))
        {
        	echo "<option value='$row[0]'>"; echo utf8_encode($row[1]); echo "</option>";
        }
        echo "</select>";

        $result2=mysql_query("SELECT id,Id_TipoGestion FROM Nivel3 WHERE  $this->nivel3 = Id_Nivel2 ");
        while($row=mysql_fetch_array($result2))
        {
        	echo "<input type='hidden' id='tipo_gestion' name='tipo_gestion' value='$row[0]'>";
        	echo "<input type='hidden' id='tipo_gestion_final' name='tipo_gestion_final' value='$row[1]'>";
        }
	}
	public function nivel4($id_tipo,$cortar_valor)
	{
		$this->id_tipo=$id_tipo;
		$this->cortar_valor=$cortar_valor;
		if($this->id_tipo == 37)
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
	        echo '<label class="control-label">Observación</label>';
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
	        	echo '<input type="submit" class="btn btn-primary btn-block" value="Guardar"  id="guardar">';
	        }
	        echo '</div>';
	        echo '</div>';

		}
		else if($this->id_tipo == 136)
		{

	        echo '<div class="col-sm-4">';
            echo '<div class="form-group">';
            echo '<label class="control-label">Fecha Retiro</label>';
            echo '<div id="demo-dp-txtinput">';
            echo '<div class="input-group date">';
            echo '<input type="date" class="form-control" name="fecha_compromiso" id="fecha_compromiso">';
            echo '<span class="input-group-addon"><i class="fa fa-calendar "></i></span>';
            echo '</div>';
            echo '</div>';
	        echo '</div>';
	        echo '</div>';
	        echo '<div class="col-sm-12">';
	        echo '<div class="form-group">';
	        echo '<label class="control-label">Observación</label>';
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
	        	echo '<input type="submit" class="btn btn-primary btn-block" value="Guardar"  id="guardar">';
	        }
	        echo '</div>';
	        echo '</div>';
		}
		else
		{

	        echo '<div class="col-sm-8">';
	        echo '<div class="form-group">';
	        echo '<label class="control-label">Observación</label>';
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
	        	echo '<input type="submit" class="btn btn-primary btn-block" value="Guardar"  id="guardar">';
	        }
	        echo '</div>';
	        echo '</div>';
		}

	}
	public function insertar1($nivel1,$nivel2,$nivel3,$comentario,$fecha_gestion,$hora_gestion,$rut,$fono_discado,$tipo_gestion,$cedente,$usuario_foco,$lista)
	{
		$this->usuario_foco=$usuario_foco;
		$new_user = "Foco - ".$this->usuario_foco;
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
		$this->lista=$lista;
		$fechahora = $this->fecha_gestion." ".$this->hora_gestion;

		mysql_query("INSERT INTO gestion_ult_semestre(resultado, resultado_n2, resultado_n3, observacion,fecha_gestion,hora_gestion,rut_cliente,fechahora,fono_discado,lista,nombre_ejecutivo,Id_TipoGestion,cedente) VALUES ('$this->nivel1','$this->nivel2','$this->nivel3','$this->comentario','$this->fecha_gestion','$this->hora_gestion','$this->rut','$fechahora','$this->fono_discado','$this->lista','$new_user','$this->tipo_gestion','$this->cedente')");
		echo "ok";
	}
	public function insertar2($nivel1,$nivel2,$nivel3,$comentario,$fecha_gestion,$hora_gestion,$rut,$fono_discado,$tipo_gestion,$cedente,$fecha_compromiso,$monto_compromiso,$usuario_foco,$lista)
	{
		$this->usuario_foco=$usuario_foco;
		$new_user = "Foco - ".$this->usuario_foco;
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
		$this->lista=$lista;
		$fechahora = $this->fecha_gestion." ".$this->hora_gestion;

		mysql_query("INSERT INTO gestion_ult_semestre(resultado, resultado_n2, resultado_n3, observacion,fecha_gestion,hora_gestion,rut_cliente,fechahora,fono_discado,lista,nombre_ejecutivo,Id_TipoGestion,cedente,fec_compromiso,monto_comp) VALUES ('$this->nivel1','$this->nivel2','$this->nivel3','$this->comentario','$this->fecha_gestion','$this->hora_gestion','$this->rut','$fechahora','$this->fono_discado','$this->lista','$new_user','$this->tipo_gestion','$this->cedente','$this->fecha_compromiso','$this->monto_compromiso')");
		echo "ok";

		//Coloreo al vuelo



	}
	public function insertar3($nivel1,$fecha_gestion,$hora_gestion,$rut,$fono_discado,$tipo_gestion,$cedente,$duracion_llamada,$usuario_foco,$lista)
	{
		$this->usuario_foco=$usuario_foco;
		$new_user = "Foco - ".$this->usuario_foco;
		$this->nivel1=$nivel1;
		$this->fecha_gestion=$fecha_gestion;
		$this->hora_gestion=$hora_gestion;
		$this->rut=$rut;
		$this->fono_discado=$fono_discado;
		$this->tipo_gestion=$tipo_gestion;
		$this->cedente=$cedente;
		$this->duracion_llamada=$duracion_llamada;
		$this->user_dial=$user_dial;
		$this->lista=$lista;
		list($horas, $minutos, $segundos) = explode(':', $this->duracion_llamada);
		$duracion_llamada = ($horas * 3600 ) + ($minutos * 60 ) + $segundos;
		$fechahora = $this->fecha_gestion." ".$this->hora_gestion;

		$result = mysql_query("SELECT n1.Id as respuesta_n1, n2.id respuesta_n2, n3.id as respuesta_n3
					 FROM Nivel3 n3, Nivel2 n2, Nivel1 n1, Respuesta_Rapida r
					 WHERE FIND_IN_SET(44,r.Id_Cedente) and n3.Id_Nivel2 = n2.id and n2.Id_Nivel1 = n1.Id and r.Respuesta_Nivel3 = n3.id and r.Respuesta_Nivel3 = '$this->nivel1'");
        $row=mysql_fetch_array($result);
        $n1 = $row[0];
        $n2 = $row[1];
        $n3 = $row[2];
		mysql_query("INSERT INTO gestion_ult_semestre(resultado, resultado_n2, resultado_n3,fecha_gestion,hora_gestion,rut_cliente,fechahora,fono_discado,lista,nombre_ejecutivo,Id_TipoGestion,cedente,duracion,Origen) VALUES ('$n1','$n2','$n3','$this->fecha_gestion','$this->hora_gestion','$this->rut','$fechahora','$this->fono_discado','$this->lista','$new_user','$this->tipo_gestion','$this->cedente','$duracion_llamada','0')");
		echo "ok";
	}
	public function limpiarSeleccion()
	{
		mysql_query("UPDATE Deuda SET Marca_Factura=0 WHERE Marca_Factura=1");
		mysql_query("UPDATE Mail SET Marca=0 WHERE Marca=1");
	}


	public function mostrarDeudas($rut,$cedente)
	{
		$idTableDeuda = 2;
		$db = new Db(); 
        $Sql = "SELECT * FROM SIS_Columnas_Estrategias WHERE id_tabla='".$idTableDeuda."' and FIND_IN_SET('$cedente',Id_Cedente) order by columna";
		$columnas = $db -> select($Sql);
		//echo $Columnas;
		echo '<div class="table-responsive">';
        echo '<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">';
        echo '<thead>';
        echo '<tr>';
		$columnasDeuda = "";
		$ArrayColumnas = array();
		foreach($columnas as $columna){        	
        echo '<th>'.$columna["columna"].'</th>'; 
		array_push($ArrayColumnas,$columna["columna"]);
		 
       	}  
		   $columnasDeuda = implode(",",$ArrayColumnas);
        echo '</tr>';        	

		$SqlDeuda = "SELECT ".$columnasDeuda." FROM Deuda WHERE Rut ='".$rut."' and Id_Cedente = '".$cedente."'";
		$deudas = $db -> select($SqlDeuda);
        echo '<tr>';
		$ContadorDeColumnas = 0;
		foreach($deudas as $deuda){ 
		for($i=0;$i<=count($ArrayColumnas);$i++){
		echo '<td>'.$deuda[$ArrayColumnas[$ContadorDeColumnas]].'</td>'; 
		$ContadorDeColumnas++;
		}
        
		}
		echo '</tr>';
        echo '</thead>';
		echo '</table>';
		echo '</div>';  

	}


	public function mostrarDeudasviejo($rut,$cedente)
	{
		$this->rut=$rut;
		$this->cedente=$cedente;
		$qry1 = mysql_query("SELECT Id_Conf	, Nombre_Conf,Id_Cedente,Nombre_Tabla,Descripcion_Consulta,Nombre_Campos,Nombre_Columnas FROM Conf_Pantalla_Cedente WHERE Nombre_Tabla = 'Deuda' and Id_Cedente = $this->cedente ORDER BY Id_Conf DESC LIMIT 1  ");
		$Nombre_Campos = "";
		$Nombre_Columnas = "";
		$strConsuta = "";
		$sw1 = 0;
		while($row = mysql_fetch_array($qry1))
	   	{
	   		$Nombre_Campos = $row['Nombre_Campos'];
	   		$Nombre_Columnas = $row['Nombre_Columnas'];
	   		$strConsuta = $row['Descripcion_Consulta'] . " WHERE Rut = '$this->rut=$rut'  AND Id_Cedente = $this->cedente ";
	   		$sw1 = 1;
		}
		if ($sw1 == 0) // Campos por defecto cuando no tiene configuracion creada
		{
			$Nombre_Campos = "Rut,Monto_Mora";
	   		$Nombre_Columnas = "Rut,Monto_Mora";
	   		$strConsuta = " SELECT Rut,Monto_Mora FROM Deuda WHERE Rut = '$this->rut=$rut' AND Id_Cedente = $this->cedente ";
		}
		$arrSele = explode ( "FROM" , $strConsuta );
		$strConsuta = $arrSele[0] . ", Id_deuda as Id_D FROM " . $arrSele[1];
		$arrNomColum = explode ( ',' , $Nombre_Campos );
		$arrheadColum = explode ( ',' , $Nombre_Columnas );
		$totalColum = count($arrheadColum);
		echo '<div class="table-responsive">';
        echo '<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">';
        echo '<thead>';
        echo '<tr>';
		foreach($arrheadColum as $itemHead):
		echo "<th> $itemHead </th>";
		endforeach;
		echo "<th style='text-align:center'>Factura</th>";
		echo "<th style='text-align:center'>Adjuntar</th>";
        echo '</tr>';
        echo '</thead>';
		echo '<tbody>';
		$query2 = mysql_query($strConsuta);
		$j = 1;
		$varCK = "";
		 while($row2 = mysql_fetch_array($query2))
	   {
	       $varCK = "chk".$j;
            echo "<tr id='$row2[Id_D]' class='$j' >";
            for ($i=0; $i < $totalColum; $i++) {
				$valtem = trim($arrNomColum[$i]);
				echo "<td class='text-sm'>$row2[$valtem]</td>";
			 }

			$fac = $row2[3];
			$ruta = "/home/foco/ftp/".$this->cedente;

			$resp = $this->BuscarEnDirectorio($ruta,$fac);
			$ruta_pdf = $ruta."/".$resp;

			if($resp=='0')
			{
			    echo "<td style='text-align:center'>";
				echo "Sin Factura Fisica";
				echo "</td>";
				echo "<td style='text-align:center'>";
				echo " <input type='checkbox' class='ckhsel'  disabled='disabled' name='$varCK' value='$varCK' id='$varCK' >";
				echo "</td>";
			}
			else
			{
			    echo "<td style='text-align:center'>";
				echo "<a href='factura.php?factura=$ruta_pdf'><i class='fa fa-file-pdf-o' aria-hidden='true'></i> - $resp </a>";
				echo "</td>";
				echo "<td style='text-align:center'>";
				echo " <input type='checkbox' class='ckhsel' name='$varCK' value='$varCK' id='$varCK' >";
				echo "</td>";
			}
            echo '</tr>';
		    $j = $j + 1;
		}
		echo '</tbody></table></div>';


	}

	public function BuscarEnDirectorio($path,$num_factura)
	{
	    $this->path=$path;
	    $this->num_factura=$num_factura;

	    $dir = opendir($this->path);
	    $files = array();
	    $nombreArchivo = "";
	    while ($current = readdir($dir)){
	        if( $current != "." && $current != "..") {
	            if(is_dir($this->path.$current)) {
	                //showFiles($path.$current.'/');
	            }
	            else {
	                $files[] = $current;
	                $pos = strpos($current, $this->num_factura);
	                if ($pos !== false) {
					     return $current;
					}
	            }
	        }
	    }
	    return "0";

	}
	public function mostrarAsignacion($Cola){
		$this->Cola=$Cola;
		$Cola2 = $this->Cola."_";
		
		echo "<select class='select1' id='seleccione_asignacion' name='seleccione_cedente'>";
        $result=mysql_query("SHOW TABLES LIKE '%$this->Cola%'");
       	echo '<option value="0">Seleccione</option>';
        while($row=mysql_fetch_array($result))
        {
        	$Cola = $row[0];
			$ParteA = explode("_", $Cola);
			if($ParteA[7]==1){
				switch ($ParteA[3]) {
			case 'E':
				$Tipo = 'Ejecutivo';
				$Query  = mysql_query("SELECT Nombre FROM Personal WHERE Id_Personal = $ParteA[4] LIMIT 1");
				while($row=mysql_fetch_array($Query)){
					$Nombre = $row[0];
				}

				echo "<option value='$Cola'>"."Asignacion " . $Tipo . " " . $Nombre . "</option>";

				break;
			case 'S':
				$Tipo = 'Supervisor';
				$Query  = mysql_query("SELECT Nombre FROM Personal WHERE Id_Personal = $ParteA[4] LIMIT 1");
				while($row=mysql_fetch_array($Query)){
					$Nombre = $row[0];
				}

				echo "<option value='$Cola'>"."Asignacion " . $Tipo . " " . $Nombre . "</option>";

				break;
			case 'G':
				$Tipo = 'Grupo';
				$Query  = mysql_query("SELECT Nombre FROM Personal WHERE Id_Personal = $ParteA[4] LIMIT 1");
				while($row=mysql_fetch_array($Query)){
					$Nombre = $row[0];
				}

				echo "<option value='$Cola'>"."Asignacion " . $Tipo . " " . $Nombre . "</option>";

				break;
			case 'EE':
				$Tipo = 'EMPRESA EXTERNA';
				$Query  = mysql_query("SELECT Nombre FROM Personal WHERE Id_Personal = $ParteA[4] LIMIT 1");
				while($row=mysql_fetch_array($Query)){
					$Nombre = $row[0];
				}

				echo "<option value='$Cola'>"."Asignacion " . $Tipo . " " . $Nombre . "</option>";
				break;
				}
			}else{
			}
			
        }	
			
        echo "</select>";

	}

}
?>
