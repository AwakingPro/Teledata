<?php
    class Reclutamiento{
        public $Username;
        public $Password;
        public $Perfil;
        public $idPregunta;
        public $idUsuario;
        public $idPersonal;
        public $idEmpresa;
        public $CompetenciasMinMax;
        function __construct(){
            $this->CompetenciasMinMax["Max"] = 4.6;
            $this->CompetenciasMinMax["Min"] = 2.8;
        }
        function Login(){
            $ToReturn = false;
            $db = new DB();
            $SqlLogin = "select * from usuarios_reclutamiento where username='".$this->Username."' and password='".$this->Password."'";
            $Login = $db->select($SqlLogin);
            if(count($Login) > 0){
                $ToReturn = array();
                $ToReturn[] = true;
                $_SESSION["idUsuario_reclutamiento"] = $Login[0]["id"];
                $this->idUsuario = $Login[0]["id"];
                $_SESSION["idEmpresa_reclutamiento"] = $Login[0]["id_empresa"];
                $generales = (count($db -> select('SELECT * FROM datos_generales_reclutamiento WHERE IdUsuarioReclutamiento = '.$Login[0]["id"])) > 0) ? true : false;
                $domicilio = (count($db -> select('SELECT * FROM domicilio_reclutamiento WHERE IdUsuarioReclutamiento = '.$Login[0]["id"])) > 0) ? true : false;
                $contactos = (count($db -> select('SELECT * FROM contactos_reclutamiento WHERE IdUsuarioReclutamiento = '.$Login[0]["id"])) > 0) ? true : false;
                $previcionales = (count($db -> select('SELECT * FROM datos_personales_reclutamiento WHERE IdUsuarioReclutamiento = '.$Login[0]["id"])) > 0) ? true : false;
                if ($generales || $domicilio || $contactos || $previcionales) {
                    $ToReturn[] = true;
                }else{
                    $ToReturn[] = false;
                }
            }
            echo json_encode($ToReturn);
        }
        function getPreguntas(){
            $db = new DB();
            $SqlPreguntas = "select * from preguntas_reclutamiento where id_perfil='".$this->getPerfilId()."'";
            $Preguntas = $db->select($SqlPreguntas);
            return $Preguntas;
        }
        function getOpciones(){
            $db = new DB();
            $SqlPreguntas = "select * from opciones_preguntas_reclutamiento where id_pregunta='".$this->idPregunta."'";
            $Preguntas = $db->select($SqlPreguntas);
            return $Preguntas;
        }
        function insertCalificacion($Preguntas){
            $db = new DB();
            $email = new Email();
            foreach($Preguntas as $Pregunta){
                $idPregunta = $Pregunta[0];
                $idOpcion = $Pregunta[1];
                $DateArray = $this->getDateFromServer();
                $Date = $DateArray["date"];
                $SQL = "insert into respuestas_opciones_preguntas_reclutamiento (id_pregunta,id_opcion,id_usuario,fecha,id_prueba) values ('".$idPregunta."','".$idOpcion."','".$_SESSION['idUsuario_reclutamiento']."','".$Date."','".$this->getPruebaId()."')";
                $insertRespuestas = $db->query($SQL);
            }
            $SQlUpdatePruebas = "update pruebas_reclutamiento set status = '1' where id_usuario = '".$_SESSION['idUsuario_reclutamiento']."'";
            $UpdatePruebas = $db->query($SQlUpdatePruebas);
            //$email->SendNotification("Contenido del Correo","Notificacion de Calificacion", "jurbina@cobranding.cl");
        }
        function usuarioTienePruebasDisponibles(){
            $ToReturn = false;
            $db = new DB();
            $SqlRespuestas = "select * from pruebas_reclutamiento where id_usuario ='".$_SESSION['idUsuario_reclutamiento']."' and pruebas_reclutamiento.status='0'";
            $Respuestas = $db->select($SqlRespuestas);
            if(count($Respuestas) > 0){
                $ToReturn = true;
            }
            return $ToReturn;
        }
        function getDateFromServer($Separator = ""){
            $db = new Db();
            $SqlDate = "select DATE_FORMAT(NOW(),'%Y".$Separator."%m".$Separator."%d') as date, DATE_FORMAT(NOW(),'%T:%f') as hour";
            $Dates = $db -> select($SqlDate);
            return $Dates[0];
        }
        function getPruebaId(){
            $db = new DB();
            $SqlPrueba = "select id from pruebas_reclutamiento where id_usuario='".$_SESSION['idUsuario_reclutamiento']."' and status='0'";
            $Prueba = $db->select($SqlPrueba);
            return $Prueba[0]["id"];
        }
        function getPerfilId(){
            $db = new DB();
            $SqlPerfil = "select id_perfil from pruebas_reclutamiento where id_usuario='".$_SESSION['idUsuario_reclutamiento']."' and status='0'";
            $Perfil = $db->select($SqlPerfil);
            return $Perfil[0]["id_perfil"];
        }
        function getPreguntasCompetencias(){
            $db = new DB();
            $SqlPreguntas = "select preguntas_competencias_reclutamiento.* from preguntas_competencias_reclutamiento inner join competencias_periles_reclutamiento on competencias_periles_reclutamiento.id = preguntas_competencias_reclutamiento.id_competencia inner join perfiles_reclutamiento on perfiles_reclutamiento.id = competencias_periles_reclutamiento.id_perfil where perfiles_reclutamiento.id='".$this->Perfil."' and perfiles_reclutamiento.id_empresa='".$_SESSION['idEmpresa_reclutamiento']."'";
            $Preguntas = $db->select($SqlPreguntas);
            return $Preguntas;
        }
        function getPruebaActiva(){
            $db = new DB();
            $SqlPrueba = "select * from pruebas_reclutamiento where id_usuario = '".$_SESSION['idUsuario_reclutamiento']."' and status ='0'";
            $Prueba = $db->select($SqlPrueba);
            return $Prueba[0];
        }
        function getOpcionesCompetencias(){
            $db = new DB();
            $SqlPreguntas = "select * from opciones_preguntas_competencias_reclutamiento where id_pregunta='".$this->idPregunta."'";
            $Preguntas = $db->select($SqlPreguntas);
            return $Preguntas;
        }
        function insertCalificacionCompetencias($Preguntas){
            $db = new DB();
            $email = new Email();
            foreach($Preguntas as $Pregunta){
                $idPregunta = $Pregunta[0];
                $alto = $Pregunta[3];
                $promedio = $Pregunta[2];
                $bajo = $Pregunta[1];
                echo $SQL = "insert into respuestas_opciones_preguntas_competencias_reclutamiento (id_pregunta,alto,promedio,bajo,id_usuario,id_prueba) values ('".$idPregunta."','".$alto."','".$promedio."','".$bajo."','".$_SESSION['idUsuario_reclutamiento']."','".$this->getPruebaId()."')";
                $insertRespuestas = $db->query($SQL);
            }
            $SQlUpdatePruebas = "update pruebas_reclutamiento set status = '1' where id_usuario = '".$_SESSION['idUsuario_reclutamiento']."'";
            $UpdatePruebas = $db->query($SQlUpdatePruebas);
            //$email->SendNotification("Contenido del Correo","Notificacion de Calificacion", "jurbina@cobranding.cl");
        }
        ////////////////////////////////////
        function getPerfilesByDate($startDate,$endDate){
            $db = new DB();
            $SqlPerfil = "select perfiles_reclutamiento.id, perfiles_reclutamiento.nombre from perfiles_reclutamiento inner join pruebas_reclutamiento on pruebas_reclutamiento.id_perfil = perfiles_reclutamiento.id where perfiles_reclutamiento.id_empresa='".$_SESSION['mandante']."' and pruebas_reclutamiento.fecha BETWEEN '".$startDate."' and '".$endDate."' Group by perfiles_reclutamiento.id, perfiles_reclutamiento.nombre";
            $Perfiles = $db->select($SqlPerfil);
            return $Perfiles;
        }
        function getAspirantesByDateAndPerfil($startDate,$endDate,$Perfil){
            $db = new DB();
            $WherePerfil = $Perfil == "" ? "" : "and pruebas_reclutamiento.id_perfil = '".$Perfil."'";
            $SqlAspirante = "select datos_generales_reclutamiento.IdUsuarioReclutamiento as idUsuario, concat(datos_generales_reclutamiento.Nombres,' ',datos_generales_reclutamiento.Apellidos) as Nombre_Completo from pruebas_reclutamiento inner join usuarios_reclutamiento on usuarios_reclutamiento.id = pruebas_reclutamiento.id_usuario inner join datos_generales_reclutamiento on datos_generales_reclutamiento.IdUsuarioReclutamiento = usuarios_reclutamiento.id where pruebas_reclutamiento.fecha BETWEEN '".$startDate."' and '".$endDate."' and pruebas_reclutamiento.id_empresa='".$_SESSION['mandante']."' ".$WherePerfil." group by datos_generales_reclutamiento.IdUsuarioReclutamiento";
            $Aspirantes = $db->select($SqlAspirante);
            return $Aspirantes;
        }
        function getCalificacionesByDateAndPerfilAndAspirante($startDate,$endDate,$Perfil,$Aspirante){
            $ToReturn = array();
            $db = new DB();
            $WherePerfil = $Perfil == "" ? "" : "and pruebas_reclutamiento.id_perfil = '".$Perfil."'";
            $WhereAspirante = $Aspirante == "" ? "" : "and pruebas_reclutamiento.id_usuario='".$Aspirante."'";
            //$SqlCalificacion = "select pruebas_reclutamiento.id as idPrueba, CONCAT(datos_generales_reclutamiento.Nombres,' ',datos_generales_reclutamiento.Apellidos) as NombreCompleto, AVG(opciones_preguntas_reclutamiento.ponderacion) as PromedioCalificacion, AVG(preguntas_reclutamiento.calf_minima) as PromedioCalfMinima from pruebas_reclutamiento inner join datos_generales_reclutamiento on datos_generales_reclutamiento.IdUsuarioReclutamiento = pruebas_reclutamiento.id_usuario inner join respuestas_opciones_preguntas_reclutamiento on respuestas_opciones_preguntas_reclutamiento.id_prueba = pruebas_reclutamiento.id inner join preguntas_reclutamiento on preguntas_reclutamiento.id = respuestas_opciones_preguntas_reclutamiento.id_pregunta inner join opciones_preguntas_reclutamiento on opciones_preguntas_reclutamiento.id = respuestas_opciones_preguntas_reclutamiento.id_opcion where pruebas_reclutamiento.fecha BETWEEN '".$startDate."' and '".$endDate."' ".$WhereAspirante." ".$WherePerfil." GROUP BY pruebas_reclutamiento.id order by pruebas_reclutamiento.fecha DESC";
            $SqlPrueba = "Select * FROM pruebas_reclutamiento WHERE fecha BETWEEN '".$startDate."' and '".$endDate."' ".$WhereAspirante." ".$WherePerfil." and id IN ( SELECT MAX(id) FROM pruebas_reclutamiento group by id_usuario)";
            $Pruebas = $db->select($SqlPrueba);
            foreach($Pruebas as $Prueba){
                $ArrayTmp = array();
                $idTipoTest = $Prueba['id_tipotest'];
                switch($idTipoTest){
                    case '1':
                        $SqlRespuestas = "select AVG(opciones_preguntas_reclutamiento.ponderacion) as Calificacion, AVG(preguntas_reclutamiento.calf_minima) as CalfMinima from opciones_preguntas_reclutamiento inner join respuestas_opciones_preguntas_reclutamiento on respuestas_opciones_preguntas_reclutamiento.id_opcion = opciones_preguntas_reclutamiento.id inner join preguntas_reclutamiento on preguntas_reclutamiento.id = respuestas_opciones_preguntas_reclutamiento.id_pregunta where respuestas_opciones_preguntas_reclutamiento.id_prueba='".$Prueba['id']."'";
                        $Respuestas = $db->select($SqlRespuestas);
                        foreach($Respuestas as $Respuesta){
                            $ArrayTmp["PromedioCalificacion"] = $Respuesta["Calificacion"];
                            $ArrayTmp["PromedioCalfMinima"] = $Respuesta["CalfMinima"];
                        }
                        $ArrayTmp["NombreCompleto"] = $this->getNombreAspirante($Prueba["id_usuario"]);
                        $ArrayTmp["idPrueba"] = $Prueba['id'];
                        array_push($ToReturn,$ArrayTmp);
                    break;
                    case '2':
                        $SqlRespuestas = "select * from respuestas_opciones_preguntas_competencias_reclutamiento where id_prueba='".$Prueba['id']."'";
                        $Respuestas = $db->select($SqlRespuestas);
                        $Calificacion = 0;
                        if(count($Respuestas) > 0){
                            $CalfAprobacion = count($Respuestas) * $this->CompetenciasMinMax["Max"];
                            $CalfReprobacion = count($Respuestas) * $this->CompetenciasMinMax["Min"];
                            $CalfMinima = ($CalfAprobacion + $CalfReprobacion) / 2;
                            foreach($Respuestas as $Respuesta){
                                $Alto = $Respuesta["alto"]; // 100%
                                $Promedio = $Respuesta["promedio"] * 0.75; // 75%
                                $Bajo = $Respuesta["bajo"] * 0.10; // 10%
                                $Calificacion += $Alto + $Promedio + $Bajo;
                            }
                        }else{
                            $SqlResultado = "select count(*) as CantPreguntas from preguntas_competencias_reclutamiento inner join competencias_periles_reclutamiento on competencias_periles_reclutamiento.id = preguntas_competencias_reclutamiento.id_competencia where competencias_periles_reclutamiento.id_perfil='".$Prueba["id_perfil"]."'";
                            $Resultados = $db->select($SqlResultado);
                            foreach($Resultados as $Resultado){
                                $CalfMinima = ((($Resultado["CantPreguntas"] * floatval($this->CompetenciasMinMax["Max"])) + ($Resultado["CantPreguntas"] * $this->CompetenciasMinMax["Min"])) / 2);
                            }
                        }
                        $ArrayTmp["NombreCompleto"] = $this->getNombreAspirante($Prueba["id_usuario"]);
                        $ArrayTmp["PromedioCalificacion"] = $Calificacion;
                        $ArrayTmp["PromedioCalfMinima"] = $CalfMinima;
                        $ArrayTmp["idPrueba"] = $Prueba['id'];
                        if($Calificacion > $CalfMinima){
                            //Aprobo
                        }else{
                            //Reprobo
                        }
                        array_push($ToReturn,$ArrayTmp);
                    break;
                }
            }
            return $ToReturn;
        }
        function getNombreAspirante($idUsuario){
            $db = new DB();
            $SqlAspirante = "select CONCAT(Nombres,' ',Apellidos) as NombreCompleto from datos_generales_reclutamiento where IdUsuarioReclutamiento='".$idUsuario."'";
            $Aspirantes = $db->select($SqlAspirante);
            return $Aspirantes[0]["NombreCompleto"];
        }
        function getGraphData($Prueba){
            $ToReturn = array();
            $ArrayPreguntas = array();
            $ArrayCalificacion = array();
            $ArrayCalificacionMinima = array();
            $db = new DB();
            $Prueba = $this->getPruebaByID($Prueba);
            $Prueba = $Prueba[0];
            switch($Prueba["id_tipotest"]){
                case '1':
                    $SqlCalificacionPreguntas = "select opciones_preguntas_reclutamiento.ponderacion, preguntas_reclutamiento.pregunta, preguntas_reclutamiento.calf_minima from opciones_preguntas_reclutamiento inner join respuestas_opciones_preguntas_reclutamiento on respuestas_opciones_preguntas_reclutamiento.id_opcion = opciones_preguntas_reclutamiento.id inner join preguntas_reclutamiento on preguntas_reclutamiento.id = opciones_preguntas_reclutamiento.id_pregunta where respuestas_opciones_preguntas_reclutamiento.id_prueba='".$Prueba["id"]."' order by preguntas_reclutamiento.id";
                    $Preguntas = $db->select($SqlCalificacionPreguntas);
                    foreach($Preguntas as $Pregunta){
                        array_push($ArrayCalificacion,$Pregunta["ponderacion"]);
                        array_push($ArrayCalificacionMinima,$Pregunta["calf_minima"]);
                        array_push($ArrayPreguntas,utf8_encode($Pregunta["pregunta"]));
                    }
                break;
                case '2':
                    $SqlCompetencias = "select * from competencias_periles_reclutamiento where id_empresa='".$_SESSION['mandante']."' and id_perfil='".$Prueba['id_perfil']."' order by competencia";
                    $Competencias = $db->select($SqlCompetencias);
                    foreach($Competencias as $Competencia){
                        $SqlResultado = "select sum(alto) as alto, sum(promedio*0.75) as promedio, sum(bajo*0.1) as bajo, (sum(alto) + sum(promedio*0.75) + sum(bajo*0.1)) as resultado, count(*) as CantPreguntas from respuestas_opciones_preguntas_competencias_reclutamiento inner join preguntas_competencias_reclutamiento on preguntas_competencias_reclutamiento.id = respuestas_opciones_preguntas_competencias_reclutamiento.id_pregunta where id_competencia='".$Competencia["id"]."' and id_prueba='".$Prueba['id']."'";
                        $Resultados = $db->select($SqlResultado);
                        if($Resultados[0]["CantPreguntas"] > 0){
                            foreach($Resultados as $Resultado){
                                $CalfMinima = ((($Resultado["CantPreguntas"] * floatval($this->CompetenciasMinMax["Max"])) + ($Resultado["CantPreguntas"] * $this->CompetenciasMinMax["Min"])) / 2);
                                array_push($ArrayCalificacion,$Resultado["resultado"]);
                                array_push($ArrayCalificacionMinima,$CalfMinima);
                                array_push($ArrayPreguntas,utf8_encode($Competencia["competencia"]));
                            }
                        }else{
                            $SqlResultado = "select count(*) as CantPreguntas from preguntas_competencias_reclutamiento where id_competencia='".$Competencia["id"]."'";
                            $Resultados = $db->select($SqlResultado);
                            foreach($Resultados as $Resultado){
                                $CalfMinima = ((($Resultado["CantPreguntas"] * floatval($this->CompetenciasMinMax["Max"])) + ($Resultado["CantPreguntas"] * $this->CompetenciasMinMax["Min"])) / 2);
                                array_push($ArrayCalificacionMinima,$CalfMinima);
                                array_push($ArrayPreguntas,utf8_encode($Competencia["competencia"]));
                                array_push($ArrayCalificacion,0);
                            }
                        }
                    }
                break;
            }
            $ToReturn["Preguntas"] = $ArrayPreguntas;
            $ToReturn["Calificacion"] = $ArrayCalificacion;
            $ToReturn["CalificacionMinima"] = $ArrayCalificacionMinima;
            return $ToReturn;
        }
        function getPruebasActivas(){
            $db = new DB();
            $SqlPruebasActivas = "select CONCAT(datos_generales_reclutamiento.Nombres,' ',datos_generales_reclutamiento.Apellidos) as Nombre, perfiles_reclutamiento.nombre as Perfil, datos_generales_reclutamiento.Correo as Correo, datos_generales_reclutamiento.Telefono as Telefono, pruebas_reclutamiento.id as Prueba from pruebas_reclutamiento inner join usuarios_reclutamiento on usuarios_reclutamiento.id = pruebas_reclutamiento.id_usuario inner join perfiles_reclutamiento on perfiles_reclutamiento.id = pruebas_reclutamiento.id_perfil inner join datos_generales_reclutamiento on datos_generales_reclutamiento.IdUsuarioReclutamiento = usuarios_reclutamiento.id where pruebas_reclutamiento.id_empresa='".$_SESSION['mandante']."' and pruebas_reclutamiento.status='0'";
            $PruebasActivas = $db->select($SqlPruebasActivas);
            return $PruebasActivas;
        }
        function getAspirantesSinPruebasActivas(){
            $db = new DB();
            $SqlUsuariosPruebasActivas = "select distinct usuarios_reclutamiento.id as idUsuario, CONCAT(datos_generales_reclutamiento.Nombres,' ',datos_generales_reclutamiento.Apellidos) as Nombre_Completo from usuarios_reclutamiento inner join datos_generales_reclutamiento on datos_generales_reclutamiento.IdUsuarioReclutamiento = usuarios_reclutamiento.id where usuarios_reclutamiento.id_empresa = '".$_SESSION['mandante']."'";
            $UsuariosPruebasActivas = $db->select($SqlUsuariosPruebasActivas);
            return $UsuariosPruebasActivas;
        }
        function getPerfiles(){
            $db = new DB();
            $SqlPerfiles = "select * from perfiles_reclutamiento where perfiles_reclutamiento.id_empresa = '".$_SESSION['mandante']."'";
            $Perfiles = $db->select($SqlPerfiles);
            return $Perfiles;
        }
        function getTests(){
            $db = new DB();
            $SqlTests = "select * from tipos_test_reclutamiento order by nombre";
            $Tests = $db->select($SqlTests);
            return $Tests;
        }
        function crearPrueba($idUsuario,$idPerfil,$idTest){
            $ToReturn = array();
            $ToReturn["result"] = "0";
            $db = new DB();
            $SqlInsert = "insert into pruebas_reclutamiento (id_usuario,id_perfil,id_tipotest,id_empresa,fecha) values('".$idUsuario."','".$idPerfil."','".$idTest."','".$_SESSION['mandante']."',NOW())";
            $Insert = $db->query($SqlInsert);
            if($Insert){
                $ToReturn["result"] = "1";
            }
            return $ToReturn;
        }
        function getPruebaByID($idPrueba){
             $db = new DB();
             $SqlPrueba = "select * from pruebas_reclutamiento where id='".$idPrueba."'";
             $Pruebas = $db->select($SqlPrueba);
             return $Pruebas;
        }
    }
?>