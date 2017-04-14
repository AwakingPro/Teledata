<?php

function TraeCantidadSemanas()
{
	$time = time();
	$hoy = date("Y-m-d");
	//$hoy = date("2016-11-29");

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

echo ejecutakuerys(); 

 function ejecutakuerys()
{
	for ($i = 1; $i <= TraeCantidadSemanas(); $i++) 
	{
		echo devuelveCadenas($i);
	}
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
	return "SELECT COUNT(*) FROM gestion WHERE fecha_gestion >=  '".$desde."' AND fecha_gestion <=  '".$hasta."'"; 
} 
?>