<?php 
require_once('libs/nusoap-0.9.5/lib/nusoap.php');
require_once('class/Dao.php');
require_once('db/ClaseConexion.php');

// Configurando el web service
$server = new soap_server();
$server->configureWSDL("FocoXML", "urn:FocoXMLwsdl");
$server->wsdl->schemaTargetNamespace = "urn:FocoXMLwsdl";
/********************************************************************************/
// login
function login($usuario,$password)
{
	$miDao = new Dao;
	$result = $miDao->validaCredenciales($usuario,$password);    
    return $result;
}
/*********************   I DETALLE DE CUENTAS**************************************/
 // REPORTE UNO. deudaPorAnio
function deudaPorAnio($usuario,$password,$parametro3) {
    $miDao = new Dao;
	$result = $miDao->deudaPorAnio($usuario,$password);    
    return $result;
}

// REPORTE DOS suma deudaPorAnio
function sumaDeudaPorAnio($usuario,$password) {
    $miDao = new Dao;
	$result = $miDao->sumaDeudaPorAnio($usuario,$password);    
    return $result;
} 

// REPORTE TRES promedio deuda por anio
function promedioDeudaPorAnio($usuario,$password) {
    $miDao = new Dao;
	$result = $miDao->promedioDeudaPorAnio($usuario,$password);    
    return $result;
} 

// REPORTE CUATRO Torta telefónica
function estadisticaFono($usuario,$password) {
    $miDao = new Dao;
	$result = $miDao->estadisticaFono($usuario,$password);    
    return $result;
} 

// REPORTE CINCO Torta mails
function estadisticaMail($usuario,$password) {
    $miDao = new Dao;
	$result = $miDao->estadisticaMail($usuario,$password);    
    return $result; 
} 

/***************************   II AVANCE GESTION***************************/

// REPORTE SEIS reporte de estadisticas de ruts 
function estadisticaRuts($usuario,$password) {
    $miDao = new Dao;
	$result = $miDao->estadisticaRuts($usuario,$password);    
    return $result; 
} 

// REPORTE SIETE de estadisticas de gestiones 
function estadisticaGestion($usuario,$password) {
    $miDao = new Dao;
	$result = $miDao->estadisticaGestion($usuario,$password);    
    return $result; 
} 

//
/* //  REPORTE OCHO  avanceGestionPorSemana/**/
function avanceGestionPorSemana($usuario,$password) {
    $miDao = new Dao;
	$result = $miDao->avanceGestionPorSemana($usuario,$password);    
    return $result; 
}

/*************************** III CALIDAD DE LA GESTION***************************/

// REPORTE NUEVE calidadGestion 
function calidadGestion($usuario,$password) {
    $miDao = new Dao;
	$result = $miDao->calidadGestion($usuario,$password);    
    return $result; 
} 

// REPORTE DIES de detalleContactados
function detalleContactados($usuario,$password) {
    $miDao = new Dao;
	$result = $miDao->detalleContactados($usuario,$password);    
    return $result; 
}

// REPORTE ONCE de reporteOnce
function reporteOnce($usuario,$password) {
    $miDao = new Dao;
	$result = $miDao->reporteOnce($usuario,$password);    
    return $result; 
}


/*************************** IV PROYECCION DE RECUPERO***************************/

// REPORTE ONCE de proyeccionRecuperoGestion
function proyeccionRecuperoGestion($usuario,$password) {
    $miDao = new Dao;
	$result = $miDao->proyeccionRecuperoGestion($usuario,$password);    
    return $result; 
} 















/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/***************************************************************************************************************************/
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Registrando nuestra función de login
$server->register(
        'login', // Nombre del método
        array('usuario' => 'xsd:string','password' => 'xsd:string'), // Parámetros de entrada
        array('return' => 'xsd:string'), // Parámetros de salida
        'urn:loginXMLwsdl', // Nombre del workspace
        'urn:FocoXMLwsdl#login', // Acción soap
        'rpc', // Estilo 
        'encoded', // Uso
        'Iniciar Sesion' // Documentación
);

 // Registrando nuestra función de deudaPorAnio
$server->register(
        'deudaPorAnio', // Nombre del método
        array('usuario' => 'xsd:string','password' => 'xsd:string','parametro3' => 'xsd:string'), // Parámetros de entrada
        array('return' => 'xsd:string'), // Parámetros de salida
        'urn:deudaPorAnioXMLwsdl', // Nombre del workspace
        'urn:FocoXMLwsdl#deudaPorAnio', // Acción soap
        'rpc', // Estilo
        'encoded', // Uso
        'Devuelve cantidad de deudas por año' // Documentación
);     

// Registrando nuestra función de sumaDeudaPorAnio
$server->register(
        'sumaDeudaPorAnio', // Nombre del método
        array('usuario' => 'xsd:string','password' => 'xsd:string'), // Parámetros de entrada
        array('return' => 'xsd:string'), // Parámetros de salida
        'urn:sumaDeudaPorAnio', // Nombre del workspace
        'urn:FocoXMLwsdl#sumaDeudaPorAnio', // Acción soap
        'rpc', // Estilo
        'encoded', // Uso
        'Devuelve cantidad de deudas por año' // Documentación
); 

// Registrando nuestra función de promedioDeudaPorAnio
$server->register(
        'promedioDeudaPorAnio', // Nombre del método
        array('usuario' => 'xsd:string','password' => 'xsd:string'), // Parámetros de entrada
        array('return' => 'xsd:string'), // Parámetros de salida
        'urn:promedioDeudaPorAnio', // Nombre del workspace
        'urn:FocoXMLwsdl#promedioDeudaPorAnio', // Acción soap
        'rpc', // Estilo
        'encoded', // Uso
        'Devuelve cantidad de deudas por año' // Documentación
);


// Registrando nuestra función de estadisticaFono
$server->register(
        'estadisticaFono', // Nombre del método
        array('usuario' => 'xsd:string','password' => 'xsd:string'), // Parámetros de entrada
        array('return' => 'xsd:string'), // Parámetros de salida
        'urn:estadisticaFono', // Nombre del workspace
        'urn:FocoXMLwsdl#estadisticaFono', // Acción soap
        'rpc', // Estilo
        'encoded', // Uso
        'Devuelve cantidad de deudas por año' // Documentación
);
 
 
 // Registrando nuestra función de estadisticaMail
$server->register(
        'estadisticaMail', // Nombre del método
        array('usuario' => 'xsd:string','password' => 'xsd:string'), // Parámetros de entrada
        array('return' => 'xsd:string'), // Parámetros de salida
        'urn:estadisticaMail', // Nombre del workspace
        'urn:FocoXMLwsdl#estadisticaMail', // Acción soap
        'rpc', // Estilo
        'encoded', // Uso
        'Devuelve cantidad de deudas por año' // Documentación
);

  // Registrando nuestra función de estadisticaRuts
$server->register(
        'estadisticaRuts', // Nombre del método
        array('usuario' => 'xsd:string','password' => 'xsd:string'), // Parámetros de entrada
        array('return' => 'xsd:string'), // Parámetros de salida
        'urn:estadisticaRuts', // Nombre del workspace
        'urn:FocoXMLwsdl#estadisticaRuts', // Acción soap
        'rpc', // Estilo
        'encoded', // Uso
        'Devuelve cantidad de deudas por año' // Documentación
); 


// Registrando nuestra función de estadisticaGestion
$server->register(
        'estadisticaGestion', // Nombre del método
        array('usuario' => 'xsd:string','password' => 'xsd:string'), // Parámetros de entrada
        array('return' => 'xsd:string'), // Parámetros de salida
        'urn:estadisticaGestion', // Nombre del workspace
        'urn:FocoXMLwsdl#estadisticaGestion', // Acción soap
        'rpc', // Estilo
        'encoded', // Uso
        'Devuelve cantidad de deudas por año' // Documentación
);

 // Registrando nuestra función de calidadGestion
$server->register(
        'calidadGestion', // Nombre del método
        array('usuario' => 'xsd:string','password' => 'xsd:string'), // Parámetros de entrada
        array('return' => 'xsd:string'), // Parámetros de salida
        'urn:calidadGestion', // Nombre del workspace
        'urn:FocoXMLwsdl#calidadGestion', // Acción soap
        'rpc', // Estilo
        'encoded', // Uso
        'Devuelve cantidad de deudas por año' // Documentación
);
 
  // Registrando nuestra función de detalleContactados
$server->register(
        'detalleContactados', // Nombre del método
        array('usuario' => 'xsd:string','password' => 'xsd:string'), // Parámetros de entrada
        array('return' => 'xsd:string'), // Parámetros de salida
        'urn:detalleContactados', // Nombre del workspace
        'urn:FocoXMLwsdl#detalleContactados', // Acción soap
        'rpc', // Estilo
        'encoded', // Uso
        'Devuelve cantidad de deudas por año' // Documentación
);    
  
//// Registrando nuestra función de avanceGestionPorSemana
$server->register(
        'avanceGestionPorSemana', // Nombre del método
        array('usuario' => 'xsd:string','password' => 'xsd:string'), // Parámetros de entrada
        array('return' => 'xsd:string'), // Parámetros de salida
        'urn:avanceGestionPorSemana', // Nombre del workspace
        'urn:FocoXMLwsdl#avanceGestionPorSemana', // Acción soap
        'rpc', // Estilo
        'encoded', // Uso 
        'Devuelve cantidad de deudas por año' // Documentación
);

  // Registrando nuestra función de proyeccionRecuperoGestion
$server->register(
        'proyeccionRecuperoGestion', // Nombre del método
        array('usuario' => 'xsd:string','password' => 'xsd:string'), // Parámetros de entrada
        array('return' => 'xsd:string'), // Parámetros de salida
        'urn:proyeccionRecuperoGestion', // Nombre del workspace
        'urn:FocoXMLwsdl#proyeccionRecuperoGestion', // Acción soap
        'rpc', // Estilo
        'encoded', // Uso 
        'Devuelve cantidad de deudas por año' // Documentación
);

//reporteOnce
$server->register(
        'reporteOnce', // Nombre del método
        array('usuario' => 'xsd:string','password' => 'xsd:string'), // Parámetros de entrada
        array('return' => 'xsd:string'), // Parámetros de salida
        'urn:reporteOnce', // Nombre del workspace
        'urn:FocoXMLwsdl#reporteOnce', // Acción soap
        'rpc', // Estilo
        'encoded', // Uso 
        'Devuelve cantidad de deudas por año' // Documentación
);

$HTTP_RAW_POST_DATA = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';
 
$server->service($HTTP_RAW_POST_DATA);
?>