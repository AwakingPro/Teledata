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

// REPORTE CUATRO Torta telef�nica
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

// Registrando nuestra funci�n de login
$server->register(
        'login', // Nombre del m�todo
        array('usuario' => 'xsd:string','password' => 'xsd:string'), // Par�metros de entrada
        array('return' => 'xsd:string'), // Par�metros de salida
        'urn:loginXMLwsdl', // Nombre del workspace
        'urn:FocoXMLwsdl#login', // Acci�n soap
        'rpc', // Estilo 
        'encoded', // Uso
        'Iniciar Sesion' // Documentaci�n
);

 // Registrando nuestra funci�n de deudaPorAnio
$server->register(
        'deudaPorAnio', // Nombre del m�todo
        array('usuario' => 'xsd:string','password' => 'xsd:string','parametro3' => 'xsd:string'), // Par�metros de entrada
        array('return' => 'xsd:string'), // Par�metros de salida
        'urn:deudaPorAnioXMLwsdl', // Nombre del workspace
        'urn:FocoXMLwsdl#deudaPorAnio', // Acci�n soap
        'rpc', // Estilo
        'encoded', // Uso
        'Devuelve cantidad de deudas por a�o' // Documentaci�n
);     

// Registrando nuestra funci�n de sumaDeudaPorAnio
$server->register(
        'sumaDeudaPorAnio', // Nombre del m�todo
        array('usuario' => 'xsd:string','password' => 'xsd:string'), // Par�metros de entrada
        array('return' => 'xsd:string'), // Par�metros de salida
        'urn:sumaDeudaPorAnio', // Nombre del workspace
        'urn:FocoXMLwsdl#sumaDeudaPorAnio', // Acci�n soap
        'rpc', // Estilo
        'encoded', // Uso
        'Devuelve cantidad de deudas por a�o' // Documentaci�n
); 

// Registrando nuestra funci�n de promedioDeudaPorAnio
$server->register(
        'promedioDeudaPorAnio', // Nombre del m�todo
        array('usuario' => 'xsd:string','password' => 'xsd:string'), // Par�metros de entrada
        array('return' => 'xsd:string'), // Par�metros de salida
        'urn:promedioDeudaPorAnio', // Nombre del workspace
        'urn:FocoXMLwsdl#promedioDeudaPorAnio', // Acci�n soap
        'rpc', // Estilo
        'encoded', // Uso
        'Devuelve cantidad de deudas por a�o' // Documentaci�n
);


// Registrando nuestra funci�n de estadisticaFono
$server->register(
        'estadisticaFono', // Nombre del m�todo
        array('usuario' => 'xsd:string','password' => 'xsd:string'), // Par�metros de entrada
        array('return' => 'xsd:string'), // Par�metros de salida
        'urn:estadisticaFono', // Nombre del workspace
        'urn:FocoXMLwsdl#estadisticaFono', // Acci�n soap
        'rpc', // Estilo
        'encoded', // Uso
        'Devuelve cantidad de deudas por a�o' // Documentaci�n
);
 
 
 // Registrando nuestra funci�n de estadisticaMail
$server->register(
        'estadisticaMail', // Nombre del m�todo
        array('usuario' => 'xsd:string','password' => 'xsd:string'), // Par�metros de entrada
        array('return' => 'xsd:string'), // Par�metros de salida
        'urn:estadisticaMail', // Nombre del workspace
        'urn:FocoXMLwsdl#estadisticaMail', // Acci�n soap
        'rpc', // Estilo
        'encoded', // Uso
        'Devuelve cantidad de deudas por a�o' // Documentaci�n
);

  // Registrando nuestra funci�n de estadisticaRuts
$server->register(
        'estadisticaRuts', // Nombre del m�todo
        array('usuario' => 'xsd:string','password' => 'xsd:string'), // Par�metros de entrada
        array('return' => 'xsd:string'), // Par�metros de salida
        'urn:estadisticaRuts', // Nombre del workspace
        'urn:FocoXMLwsdl#estadisticaRuts', // Acci�n soap
        'rpc', // Estilo
        'encoded', // Uso
        'Devuelve cantidad de deudas por a�o' // Documentaci�n
); 


// Registrando nuestra funci�n de estadisticaGestion
$server->register(
        'estadisticaGestion', // Nombre del m�todo
        array('usuario' => 'xsd:string','password' => 'xsd:string'), // Par�metros de entrada
        array('return' => 'xsd:string'), // Par�metros de salida
        'urn:estadisticaGestion', // Nombre del workspace
        'urn:FocoXMLwsdl#estadisticaGestion', // Acci�n soap
        'rpc', // Estilo
        'encoded', // Uso
        'Devuelve cantidad de deudas por a�o' // Documentaci�n
);

 // Registrando nuestra funci�n de calidadGestion
$server->register(
        'calidadGestion', // Nombre del m�todo
        array('usuario' => 'xsd:string','password' => 'xsd:string'), // Par�metros de entrada
        array('return' => 'xsd:string'), // Par�metros de salida
        'urn:calidadGestion', // Nombre del workspace
        'urn:FocoXMLwsdl#calidadGestion', // Acci�n soap
        'rpc', // Estilo
        'encoded', // Uso
        'Devuelve cantidad de deudas por a�o' // Documentaci�n
);
 
  // Registrando nuestra funci�n de detalleContactados
$server->register(
        'detalleContactados', // Nombre del m�todo
        array('usuario' => 'xsd:string','password' => 'xsd:string'), // Par�metros de entrada
        array('return' => 'xsd:string'), // Par�metros de salida
        'urn:detalleContactados', // Nombre del workspace
        'urn:FocoXMLwsdl#detalleContactados', // Acci�n soap
        'rpc', // Estilo
        'encoded', // Uso
        'Devuelve cantidad de deudas por a�o' // Documentaci�n
);    
  
//// Registrando nuestra funci�n de avanceGestionPorSemana
$server->register(
        'avanceGestionPorSemana', // Nombre del m�todo
        array('usuario' => 'xsd:string','password' => 'xsd:string'), // Par�metros de entrada
        array('return' => 'xsd:string'), // Par�metros de salida
        'urn:avanceGestionPorSemana', // Nombre del workspace
        'urn:FocoXMLwsdl#avanceGestionPorSemana', // Acci�n soap
        'rpc', // Estilo
        'encoded', // Uso 
        'Devuelve cantidad de deudas por a�o' // Documentaci�n
);

  // Registrando nuestra funci�n de proyeccionRecuperoGestion
$server->register(
        'proyeccionRecuperoGestion', // Nombre del m�todo
        array('usuario' => 'xsd:string','password' => 'xsd:string'), // Par�metros de entrada
        array('return' => 'xsd:string'), // Par�metros de salida
        'urn:proyeccionRecuperoGestion', // Nombre del workspace
        'urn:FocoXMLwsdl#proyeccionRecuperoGestion', // Acci�n soap
        'rpc', // Estilo
        'encoded', // Uso 
        'Devuelve cantidad de deudas por a�o' // Documentaci�n
);

//reporteOnce
$server->register(
        'reporteOnce', // Nombre del m�todo
        array('usuario' => 'xsd:string','password' => 'xsd:string'), // Par�metros de entrada
        array('return' => 'xsd:string'), // Par�metros de salida
        'urn:reporteOnce', // Nombre del workspace
        'urn:FocoXMLwsdl#reporteOnce', // Acci�n soap
        'rpc', // Estilo
        'encoded', // Uso 
        'Devuelve cantidad de deudas por a�o' // Documentaci�n
);

$HTTP_RAW_POST_DATA = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';
 
$server->service($HTTP_RAW_POST_DATA);
?>