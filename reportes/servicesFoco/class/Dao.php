<?php
class Dao
{
	private $mysqli;
	
	public function Dao()
	{		
		$conexion = new Conexion();
		$this->mysqli= $conexion->conectar();
	}	
	
	//login
	public function validaCredenciales($usuario,$password)
	{
		$sql = $this->mysqli->query("SELECT * FROM Usuarios WHERE usuario =  '".$usuario."' AND PASSWORD =  '".$password."'");
		while ($row=$sql->fetch_assoc())
		{ 
			return "1";
		} 
		return "0";
	}
	
	/*********************   I DETALLE DE CUENTAS**************************************/
	
	//reporte 1 CUENTAS POR AÑO CASTIGO
	public function deudaPorAnio($usuario,$password)
	{
		if($this->validaCredenciales($usuario,$password)==1)
		{
			$sql = $this->mysqli->query("SELECT DISTINCT Ano_Deuda FROM Deuda where Ano_Deuda!=0 order by Ano_Deuda asc;");
			$res="";
			while ($row=$sql->fetch_assoc())
			{ 
				$res = $res.$row['Ano_Deuda'].";".$this->cantidadPorAnio($row['Ano_Deuda'])."/";
			} 	 	 	
		}	
		return $res;
	}
	
	//reporte 2 MONTO POR AÑO DE CASTIGO
	public function sumaDeudaPorAnio($usuario,$password)
	{
		if($this->validaCredenciales($usuario,$password)==1)
		{
			$sql = $this->mysqli->query("SELECT DISTINCT Ano_Deuda FROM Deuda where Ano_Deuda!=0 order by Ano_Deuda asc;");
			$res="";
			while ($row=$sql->fetch_assoc())
			{ 
				$res = $res.$row['Ano_Deuda'].";".$this->sumaPorAnio($row['Ano_Deuda'])."/";
			} 	 	 	
		}	
		return $res;
	}
	
	//reporte 3 PROMEDIO DEUDA POR AÑO DE CASTIGO
	public function promedioDeudaPorAnio($usuario,$password)
	{
		if($this->validaCredenciales($usuario,$password)==1)
		{
			$sql = $this->mysqli->query("SELECT DISTINCT Ano_Deuda FROM Deuda where Ano_Deuda!=0 order by Ano_Deuda asc;");
			$res="";    
			while ($row=$sql->fetch_assoc())
			{ 
				$res = $res.$row['Ano_Deuda'].";".$this->sumaPorAnio($row['Ano_Deuda'])."/";
			} 	 	 	
		}	
		return $res;
	} 
	  
	//reporte 4 Estadistica Fono ingresados
	public function estadisticaFono($usuario,$password)
	{
		 if($this->validaCredenciales($usuario,$password)==1)
		 {
			 $sql = $this->mysqli->query("select totalConFono,totalSinFono from EstadisticasCargas order by id desc;");
			 $res="";
			 while ($row=$sql->fetch_assoc())
			 { 
				 $res=$row['totalConFono'].";".$row['totalSinFono'];
			 } 	 	 	
		 }	
		return $res; 
	}
	
	//reporte 5 Estadistica Mails ingresados 
	public function estadisticaMail($usuario,$password)
	{
		 if($this->validaCredenciales($usuario,$password)==1)
		 {
			 $sql = $this->mysqli->query("select totalConMail,totalSinMail from EstadisticasCargas order by id desc;");
			 $res="";
			 while ($row=$sql->fetch_assoc())
			 { 
				 $res=$row['totalConMail'].";".$row['totalSinMail'];
			 } 	 	 	
		 }	
		return $res; 
	}
	
	/***************************   II AVANCE GESTION***************************/

	//REPORTE 6 GESTION  DE LA CARTERA
	public function estadisticaRuts($usuario,$password)
	{
		 if($this->validaCredenciales($usuario,$password)==1)
		 {
			 $sql = $this->mysqli->query("select rutAsignados,rutGestionados,rutNoGestionados from EstadisticasCargas order by id desc;");
			 $res="";
			 while ($row=$sql->fetch_assoc())
			 { 
				 $res=$row['rutAsignados'].";".$row['rutGestionados'].";".$row['rutNoGestionados'];
			 } 	 	 	
		 }	
		return $res; 
	}
	
	//REPORTE 7 CANTIDAD DE GESTIÓN ES ASOCIADAS A LA CARTERA
	public function estadisticaGestion($usuario,$password)
	{
		 if($this->validaCredenciales($usuario,$password)==1)
		 {
			 $sql = $this->mysqli->query("select rutAsignados,totalGestiones from EstadisticasCargas order by id desc;");
			 $res="";
			 while ($row=$sql->fetch_assoc())
			 { 
				 $res=$row['rutAsignados'].";".$row['totalGestiones'];
			 } 	 	 	
		 }	
		return $res;
	}
	
	//REPORTE 8
	public function avanceGestionPorSemana($usuario,$password)
	{
		$res="algo";
		 if($this->validaCredenciales($usuario,$password)==1)
		{
			
			for ($i = 1; $i <= $this->TraeCantidadSemanas(); $i++) 
			{
				$sql = $this->mysqli->query($this->devuelveCadenas($i));				
				while ($row=$sql->fetch_assoc())
				{ 
					$res=$row['result'].";";
				}	
			} 	 	
		}	  
		return $res;
	}

	/*************************** III CALIDAD DE LA GESTION***************************/
	
	
	// REPORTE 9 gestion
	public function calidadGestion($usuario,$password)
	{
		 if($this->validaCredenciales($usuario,$password)==1)
		 {
			 $sql = $this->mysqli->query("SELECT contactados, noContactados, rutNoGestionados FROM EstadisticasCargas ORDER BY id DESC;");
			 $res="";
			 while ($row=$sql->fetch_assoc())
			 { 
				$contactados=$row['contactados'];
				$noContactados=$row['noContactados'];
				$sinGestion=$row['rutNoGestionados'];
				$total=$contactados+$noContactados;
			 } 	 	 	
		 }	 
		return $contactados.";".$noContactados.";".$sinGestion.";".$total;
	}
	
	
	// REPORTE 10 detalleContactados
	public function detalleContactados($usuario,$password)
	{
		 if($this->validaCredenciales($usuario,$password)==1)
		 {
			 $sql = $this->mysqli->query("SELECT COUNT(*) as result FROM gestion WHERE id_TipoGestion='1' or id_TipoGestion='2' GROUP BY id_TipoGestion ORDER BY id_TipoGestion ASC ;");
			 $res="";
			 while ($row=$sql->fetch_assoc())
			 { 
				 $res=$res.$row['result'].";";
			 } 	 	 	
		 }	 
		return $res;
	}
	
	//reporteOnce
	public function reporteOnce($usuario,$password) 
	{
		$res="algo";
		 if($this->validaCredenciales($usuario,$password)==1)
		{
			$sql = $this->mysqli->query("SELECT sinGestion, noContactados, contactados FROM reportesSemanales WHERE fechaRegistro >=  '2016-11-06'");				
			while ($row=$sql->fetch_assoc())
			{ 
				$res=$row['sinGestion'].";".$row['noContactados'].";".$row['contactados'].";";
			}	
		}	  
		return $res;
	}
	/*************************** IV PROYECCION DE RECUPERO***************************/

	 
	
	
	//reporte 11 proyeccionRecuperoGestion
	public function proyeccionRecuperoGestion($usuario,$password)
	{
		if($this->validaCredenciales($usuario,$password)==1)
		{
			
			$res = $this->traeCompromisos().";".$this->traeCumplimientoEsperado().";".$this->traeMetaRecupero()."/";
				 	 	
		}	
		return $res;
	}

	
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//funciones complementarias	
	
	private function cantidadPorAnio($anio)
	{
		$result = $this->mysqli->query("SELECT COUNT(*) as TOTALFOUND from Deuda WHERE Ano_Deuda = '".$anio."';");
		$row_array=$result->fetch_array(MYSQLI_ASSOC);
		return $row_array['TOTALFOUND'];
	}
	
	private function sumaPorAnio($anio)
	{
		$result = $this->mysqli->query("SELECT SUM(Monto_Mora) as TOTALFOUND from Deuda WHERE Ano_Deuda = '".$anio."';");
		$row_array=$result->fetch_array(MYSQLI_ASSOC);
		return $row_array['TOTALFOUND'];
	}
	
	private function promedioPorAnio($anio)
	{
		$result = $this->mysqli->query("SELECT avg(Monto_Mora) as TOTALFOUND from Deuda WHERE Ano_Deuda = '".$anio."';");
		$row_array=$result->fetch_array(MYSQLI_ASSOC);
		return $row_array['TOTALFOUND'];
	}
	
	function TraeCantidadSemanas()
	{
		$time = time();
		$hoy = date("Y-m-d");

		$month = date('m');
		$year = date('Y');
		$dia1 = date('Y-m-d', mktime(0,0,0, $month, 1, $year));
      
		$datetime1 = new DateTime($dia1);
		$datetime2 = new DateTime($hoy);
		$interval = $datetime1->diff($datetime2); 

		$base=substr($dia1, 0, 8);

		$cantidadSemanas = floor(($interval->format('%a') / 7));

		return $cantidadSemanas; 
	}

	function devuelveCadenas($valor)
	{
		$month = date('m');
		$year = date('Y');
		$dia1 = date('Y-m-d', mktime(0,0,0, $month, 1, $year));
		
		$base=substr($dia1, 0, 8);
		$desde="";
		$hasta=""; 
	
		if ($valor==1)
		{
			$desde=$base."01";
			$hasta=$base."07";
		}
	
		if ($valor==2) 
		{
			$desde=$base."08";
			$hasta=$base."14";
		}

		if ($valor==3) 
		{
			$desde=$base."15";
			$hasta=$base."21";
		}

		if ($valor==4)
		{
			$desde=$base."22";
			$hasta=$base."29"; 
		}
		return "SELECT COUNT(*) as result FROM gestion WHERE fecha_gestion >=  '".$desde."' AND fecha_gestion <=  '".$hasta."'"; 
	}

	function devuelveCalidadGestionPorSemana($valor)
	{
		$month = date('m');
		$year = date('Y');
		$dia1 = date('Y-m-d', mktime(0,0,0, $month, 1, $year));
		
		$base=substr($dia1, 0, 8);
		$desde="";
		$hasta=""; 
	
		if ($valor==1)
		{
			$desde=$base."01";
			$hasta=$base."07";
		}
	
		if ($valor==2) 
		{
			$desde=$base."08";
			$hasta=$base."14";
		}

		if ($valor==3) 
		{
			$desde=$base."15";
			$hasta=$base."21";
		}

		if ($valor==4)
		{
			$desde=$base."22";
			$hasta=$base."29"; 
		}
		return "SELECT COUNT(*) as result FROM gestion WHERE fecha_gestion >=  '".$desde."' AND fecha_gestion <=  '".$hasta."'"; 
	}	
	
	private function traeCompromisos()
	{
		$result = $this->mysqli->query("SELECT COUNT(*) as TOTALCOM from gestion WHERE Id_TipoGestion=5;");
		$row_array=$result->fetch_array(MYSQLI_ASSOC);
		return $row_array['TOTALCOM'];
	} 
	
	private function traeCumplimientoEsperado()
	{
		$result = $this->mysqli->query("SELECT SUM(resultado) as MONTOCOMP from gestion WHERE Id_TipoGestion=5;");
		$row_array=$result->fetch_array(MYSQLI_ASSOC);
		return $row_array['MONTOCOMP'];
	}
	
	private function traeMetaRecupero()
	{
		//$result = $this->mysqli->query("SELECT SUM(resultado) as MONTOCOMP from gestion WHERE Id_TipoGestion=5;");
		//$row_array=$result->fetch_array(MYSQLI_ASSOC);
		//return $row_array['MONTOCOMP'];
		return "69";
	}
	
	
}
?>