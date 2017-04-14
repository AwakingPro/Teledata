<?php
include_once("class/db/db.php");
$db = new Db();
$idCedente = 45;

$idTrabajador = 47;
 $db = new Db();
    $Array = array();
    // datos generales del trabajador
    $SqlDatosTrabajador = "SELECT * FROM Personal WHERE Id_Personal = '".$idTrabajador."'";
    $Datos = $db -> select($SqlDatosTrabajador);    
    foreach($Datos as $dato){      
      $Array['email'] = $dato["email"];
    }

    // busco el nombre del cargo del trabajador
    $SqlDatosCargo = "SELECT cargo FROM RH_cargo WHERE id_cargo = '".$Datos[0]['id_cargo']."'";
    $Cargo = $db -> select($SqlDatosCargo);  

    if (count($Cargo)>0)  
      $Array['cargo'] = $Cargo[0]['cargo']; 
            

  


    var_dump($Array);

        /*if($Periodos !== false){
          foreach($Periodos as $Periodo){
            $Array = array();
            $Array['fechaInicio'] = $Periodo['Fecha_Inicio'];
            $Array['fechaTermino'] = $Periodo['Fecha_Termino'];
            $Array['Actions'] = $Periodo[$idPeriodo];
            array_push($periodosArray,$Array);
        }
        }

        var_dump($periodosArray);*/



/*$host_name = '192.168.1.8';
$user_name = 'root';
$pass_word = 's9q7l5.,777';
$database_name = 'foco';
$conn = mysql_connect($host_name, $user_name, $pass_word) or die ('Error connecting to mysql');
mysql_select_db($database_name);

$consultaMenu = "SELECT * FROM menu WHERE padre = '31'";
$resultado = mysql_query($consultaMenu, $conn) or die(mysql_error());

  $row = mysql_num_rows($resultado);
  echo $row;

while($resultNivel3 = mysql_fetch_array($resultado))
{
  echo "</br>";
  echo $resultNivel3["descripcion"];
} */


/*
function getCedentesMandante($mandante){
  $ToReturn = "";
  $mandante=mysql_query("select Id_Cedente from SIS_Tablas where id_tabla = '".$mandante."'");
  while($row=mysql_fetch_assoc($mandante))
  {
    $ToReturn[] = $row;
  }
  return $ToReturn;
} */




  /* $Sql = mysql_query("select Id_Cedente from SIS_Tablas where id = $idTabla");
	 $cedentes = mysql_fetch_array($Sql);
   return $cedentes['Id_Cedente']; */
// }


/*
   $Sql = mysql_query("select Id_Cedente from SIS_Columnas_Estrategias where id = $idColumna");
	 $cedentes = mysql_fetch_array($Sql);
   return $cedentes['Id_Cedente']; */
 //}

//echo GetCedentesColumna(1)."<br>";
// al menos me debe traer uno o varios
//$campos = '13';
//$idCampos = explode(",", $campos);
//echo count($idCampos)."<br><br>"; */
     /*    $array = array('14', '15', '16', '17');
         var_dump($array);
         //unset($array['15']);
         echo "<br><br>";
         //var_dump($array);

         $key = array_search('15',$array,TRUE);
         unset($array[$key]);
         var_dump($array); */



     /*    function GetCedentesTabla($idTabla){
          $db = new Db();
          $Sql = "select Id_Cedente from SIS_Tablas where id = '$idTabla'";
		      $cedentes = $db -> select($Sql);
          return $cedentes;
          }

function GetIdColumna($idTabla){
          $db = new Db();
          $Sql = "select id from SIS_Columnas_Estrategias where id_tabla = '".$idTabla."'";
		  $idColumna = $db -> select($Sql);
          return $idColumna;
       }


 $idColumnas = GetIdColumna('13');
        foreach($idColumnas as $columna){
               echo $columna['id']."<br><br>";
            } */
            /*
            $camposArray = array('hello','hora_gestion','foo','bar');
            function getListar_camposNoConfig($nombreTabla,$camposArray){
            $db = new Db(); */
            // busco todos los campos de una tabla
            // los busco en sis_colu osea campos configurados
            // y los que no esten los muestro osea es lo que devuelve este metodo
            // retorno campos y id_tabla
            //$arrayListCampos = Array;
        /*    $SqlCampos = "describe ".$nombreTabla;
		        $camposTabla = $db -> select($SqlCampos);

            if (count($camposTabla) == count($camposArray))
            { */
              // la tabla ya no tiene mas campos para configurar
          /*  }else{
              $i = 0;
              foreach($camposTabla as $campo){ // campos de la tabla
               $campoYaConfigurado = 0; // no configurado
               foreach($camposArray as $campoConfig){ // campos que ya estan configurados
                 if (($campo["Field"]) == ($campoConfig)){
                   $campoYaConfigurado = 1; // si configurado
                 }
               } */
            /*   if ($campoYaConfigurado == 0)
               {
                 // campos a listar en el combo
                 $arrayListCampos[$i] = $campo["Field"];
                 $i = $i + 1;
               }
              } // fin primer for
            } // fin else
            //var_dump($arrayListCampos);
            foreach($arrayListCampos as $campos){
              echo $campos;
            }
            //return $Tabla;
       }
if(!isset($_SESSION)){ /*
  session_start();
}
       getListar_camposNoConfig("Mejor_Gestion_Periodo_Foco",$camposArray);


     /*   function getEvaluations_Managment(){
            $db = new Db();
            $EvaluationsArray = array();
            $Cont = 0;
            $SqlEvaluation = "select * from mantenedor_evaluaciones order by id";
		    $Evaluations = $db -> select($SqlEvaluation);
            foreach($Evaluations as $Evaluation){
                $EvaluationArray = array();
                $EvaluationArray['Descripcion'] = utf8_encode($Evaluation["Descripcion"]);
                $EvaluationArray['Ponderacion'] = number_format($Evaluation["Ponderacion"], 2, '.', '');
                $EvaluationArray['Actions'] = $Evaluation["id"];
                $EvaluationsArray[$Cont] = $EvaluationArray;
                $Cont++;
            }
            return $EvaluationsArray;
        } */



/*
            $Array = array();
                $Array['nombre'] = $Tabla["columna"];
                $Array['tipo'] = $Tabla["tipo"];
                $Array['tipo_dato'] = $Tabla["tipo_dato"];
                $Array['orden'] = $Tabla["orden"];
                $Array['logica'] = $Tabla["logica"];
                $Array['relacion'] = $Tabla["relacion"];
                $Array['nulo'] = $Tabla["nulo"];
                $Array['Actions'] = $Tabla["id"];
                array_push($TablasArray,$Array);
*/


/*
 foreach($idCampos as $idCampo){
                echo "oooooo".$idCampo."sdfsdfs<br><br>";
            }

$cede = GetCedentesTabla(13);
$idCedente = "45";
if ($cede[0]['Id_Cedente'] <> "")
{

  echo "tiene valores<br><br>";
//var_dump($cede[0]['Id_Cedente']);

  $valor = $cede[0]['Id_Cedente'].",".$idCedente;
  echo $valor;



} else
{
  echo "no tiene valores<br><br>";
  echo $valor = $idCedente;

} */





    /*
       public function GetCedentesColumna($idColumna){
          $db = new Db();
          $Sql = "select Id_Cedente from SIS_Columnas_Estrategias where id = '$idColumna'";
		  $cedentes = $db -> select($Sql);
          return $cedentes;
       } */


/*$vector = getCedentesMandante(5);

foreach($vector as $cedente){
    if($cedente["Nombre_Cedente"] != ""){
        $ToReturn .= "<option value='".$cedente["id_cedente"]."'>".$cedente["Nombre_Cedente"]."</option>";

    }
}
echo $ToReturn; */


/*
$resultado = buscarOperacion("update select evaluaciones set Evaluacion_Final =  wher",true);
echo "operacion: ".$resultado[0]." tabla: ".$resultado[1]."<br>";
$fechaHora = date('Y-m-d H:i:s');
echo $fechaHora;
/*
$query = "seLect  update   evaluaciones set Evaluacion_Final =  wher";
$queryTmp = $query;
$queryTmp = strtoupper(trim($queryTmp));
$posSelect = strpos($queryTmp,"SELECT");
if(($posSelect !== FALSE) && ($posSelect === 0)) { // sip es un select entra aca (si lo consigue)
  echo "es un select con posicion 0";
} else {
  echo "no es un select";
} */
/*
$queryTmp = "update mantenedor_evaluaciones set Descripcion =  Ponderacion = ";
$queryTmp = strtoupper(trim($queryTmp));
$posSelect = strpos($queryTmp,"SELECT");
if(($posSelect !== FALSE) && ($posSelect === 0)) { // sip es un select entra aca (si lo consigue en la posicion 0)
  echo "Registra LOG de select";
} else {
  echo "Registra LOG de insert update delete";

}

//echo "mmmmmmm".$posSelect."<br>";


/*
$cadena = "Sin León no hubiera España";
$buscar = "León";
$resultado = strpos($cadena, $buscar);

if($resultado !== FALSE){
    echo "La subcadena '$buscar' fue encontrada dentro de la cadena '$cadena' en la posición: '$resultado'";
} */
/*
 function buscarOperacion($query,$parametro=false)
 {
    $query = strtoupper(trim($query));
    $array = array("INSERT","DELETE","UPDATE");

    if ($parametro)
    { echo "es verdadero";
    } else {
      echo "es falso";
    }
    foreach ($array as $clave => $buscar)
    {
      switch ($buscar) {
        case 'INSERT':
          $queryTmp = str_replace("INSERT INTO ","",$query);
          $posUltimoEspacio = strpos($queryTmp," ");
          $tabla = substr($queryTmp,0,$posUltimoEspacio);
        break;
        case 'DELETE':
          $queryTmp = str_replace("DELETE FROM ","",$query);
          $posUltimoEspacio = strpos($queryTmp," ");
          $tabla = substr($queryTmp,0,$posUltimoEspacio);
          break;
        case 'UPDATE':
          $queryTmp = str_replace("UPDATE ","",$query);
          $posUltimoEspacio = strpos($queryTmp," ");
          $tabla = substr($queryTmp,0,$posUltimoEspacio);
        break;
      }
      $tablaOperacion = array($buscar,$tabla);
      $resultado = strpos(strtoupper($query), strtoupper($buscar));
      if($resultado !== FALSE){
        break; // si lo encuentro cancelo el ciclo para no seguir buscando
      }
    }

  return $tablaOperacion; // envio el nombre de la tabla y la operacion
} */

// false para no guardar el select -- envio parametro en true cuando quiera guardar el selet
// si esta en true guardo directamente el selec OJO validar este comportamiento


?>
