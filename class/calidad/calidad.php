<?php
    class Calidad{
        public $dir;
        public $dirTmp;

        public $Filename;
        public $Date;
        public $Phone;
        public $Cartera;
        public $User;

        public $Id_Evaluacion;
        public $Evaluacion_Final;
        public $Aspectos_Fortalecer;
        public $Aspectos_Corregir;
        public $Compromiso_Ejecutivo;
        public $Id_Personal;
        public $Id_Usuario;
        public $Id_Grabacion;


        public $Description;
        public $Esperado;
        public $Ponderacion;
        public $Nota;
        public $CalificacionPonderada;
        public $Observacion;
        public $Resumen;

        public $startDate;
        public $endDate;

        public $Id_Group;
        public $Fecha_Agrupamiento;

        public $Id_Mandante;
        public $Id_Cedente;

        public $EvaluatedColum;
        public $EvaluatedValue;

        public $Id_Cierre;

        function __construct(){
            $this->dir = "../../Records/";
            $this->dirTmp = "../../Records/Tmp/";
            $this->Id_Usuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario']: "";
            $this->Id_Mandante = isset($_SESSION['mandante']) ? $_SESSION['mandante'] : "";
            $this->Id_Cedente = isset($_SESSION['cedente']) ? $_SESSION['cedente']: "";
            if(isset($_SESSION['MM_UserGroup'])){
                if($this->isUserMandante()){
                    switch($_SESSION['MM_UserGroup']){
                        case 2:
                            $this->EvaluatedColum = ",bySupervisorMandante";
                            $this->EvaluatedValue = ",1";
                        break;
                        case 4:
                            $this->EvaluatedColum = ",byEjecutivoMandante";
                            $this->EvaluatedValue = ",1";
                        break;
                        case 6:
                            $this->EvaluatedColum = ",byCalidadMandante";
                            $this->EvaluatedValue = ",1";
                        break;
                    }
                }else{
                    switch($_SESSION['MM_UserGroup']){
                        case 2:
                            $this->EvaluatedColum = ",bySupervisorSystem";
                            $this->EvaluatedValue = ",1";
                        break;
                        case 4:
                            $this->EvaluatedColum = ",byEjecutivoSystem";
                            $this->EvaluatedValue = ",1";
                        break;
                        case 6:
                            $this->EvaluatedColum = ",byCalidadSystem";
                            $this->EvaluatedValue = ",1";
                        break;
                    }
                }
            }
        }

        function getRecordListAjax(){
            $db = new Db();
            $RecordsArray = array();
            $Cont = 0;
            $SqlRecord = "select * from grabacion_2 where usuario = '".$this->User."' and Cartera = '".$this->Cartera."' and Fecha BETWEEN '".$this->startDate."' and '".$this->endDate."' order by Fecha";
		    $Records = $db -> select($SqlRecord);
            foreach($Records as $Record){
                $this->Id_Grabacion = $Record['id'];
                $RecordArrayTmp = array();
                $RecordArrayTmp["Filename"] = $Record["Nombre_Grabacion"];
                $RecordArrayTmp["Date"] = $Record["Fecha"];
                $RecordArrayTmp["Cartera"] = $Record["Cartera"];
                $RecordArrayTmp["User"] = $Record["Usuario"];
                $RecordArrayTmp["Phone"] = $Record["Telefono"];
                $RecordArrayTmp["Listen"] = $this->dir.$Record["Nombre_Grabacion"];
                $RecordArrayTmp["Status"] = $this->hasEvaluation() ? "Evaluada" : "";//$Record["Estado"] == "1" ? "Evaluada" : "";
                $RecordArrayTmp["Evaluar"] = $Record["id"];
                $RecordArrayTmp["Imprimir"] = $Record["id"];
                $RecordsArray[$Cont] = $RecordArrayTmp;
                $Cont++;
            }
            return $RecordsArray;
        }
        function getRecordList(){
            $db = new Db();
            $SqlRecord = "select * from grabacion_2 order by Fecha";
		    $Records = $db -> select($SqlRecord);
            return $Records;
        }
        public function InsertRecordsToDataBase(){
            $Cedentes = $this->getCedenteArray();
            $files = scandir($this->dirTmp);
            $files = array_diff(scandir($this->dirTmp), array('.', '..'));
            $Cont = 1;
            foreach($files as $File){
                $Filename = $File;
                $Name = substr($Filename,0,strpos($Filename,"."));
                $Extension = substr($Filename,strpos($Filename,"."),strlen($Filename));
                $Date = substr($Name,0,strpos($Name,"-"));
                $ArrayDataTmp = explode("_",substr($Name,strpos($Name,"-") + 1));
                $DataTmp1 = $ArrayDataTmp[0];
                $Phone = $ArrayDataTmp[1];
                $Cartera = $ArrayDataTmp[2];
                $User = substr($ArrayDataTmp[3],0,strpos($ArrayDataTmp[3],"-"));
                $DataTmp2 = substr($ArrayDataTmp[3],strpos($ArrayDataTmp[3],"-") + 1,strlen($ArrayDataTmp[3]));
                $this->Filename = $Filename;
                $this->Date = $Date;
                $this->User = $User;
                $this->Phone = $Phone;

                if(isset($Cedentes[$Cartera])){
                    $Cartera = $Cedentes[$Cartera];
                    $this->Cartera = $Cartera;
                    $this->addRecord();
                    //
                        rename($this->dirTmp.$Filename, $this->dir.$Filename);
                    //
                }else{
                    echo "No paso: ".$Cartera." - ".$Filename."<br>";
                }
                $Cont++;
                
            }
        }
        function getCedenteArray(){
            $ToReturn = array();
            $db = new DB();
            $SqlCedentes = "select vicidial_campaigns.campaign_id as campaign, Cedente.Nombre_Cedente as nombre from Cedente inner join Cedente_Campaign on Cedente_Campaign.id_cedente = Cedente.Id_Cedente inner join vicidial_campaigns on vicidial_campaigns.campaign_id = Cedente_Campaign.id_campaign";
            $Cedentes = $db->select($SqlCedentes);
            foreach($Cedentes as $Cedente){
                $ToReturn[$Cedente["campaign"]] = $Cedente["nombre"];
            }
            return $ToReturn;
        }
        function addRecord(){
            $db = new Db();
            $ToReturn = false;
            $SqlInsertRecord = "insert into grabacion_2 (Nombre_Grabacion, Fecha, Cartera, Usuario, Telefono) values('".$this->Filename."','".$this->Date."','".$this->Cartera."','".$this->User."','".$this->Phone."')";
            $InsertRecord = $db -> query($SqlInsertRecord);
            if($InsertRecord !== false){
                $ToReturn = true;
            }else{
                $ToReturn = false;
            }
            return $ToReturn;
        }
        function AddEvaluation(){
            $db = new Db();
            $ToReturn = false;
            //$SqlInsertEvaluation = "insert into evaluaciones (Id_Personal, Id_Usuario, Id_Grabacion, Evaluacion_Final, Aspectos_Fortalecer,Aspectos_Corregir,Compromiso_Ejecutivo, Fecha_Evaluacion) values('".$this->Id_Personal."','".$this->Id_Usuario."','".$this->Id_Grabacion."','".$this->Evaluacion_Final."','".$this->Aspectos_Fortalecer."','".$this->Aspectos_Corregir."','".$this->Compromiso_Ejecutivo."',NOW())";
            $SqlInsertEvaluation = "insert into evaluaciones (Id_Personal, Id_Usuario, Id_Grabacion, Evaluacion_Final, Fecha_Evaluacion, Id_Cedente".$this->EvaluatedColum.") values('".$this->Id_Personal."','".$this->Id_Usuario."','".$this->Id_Grabacion."','".$this->Evaluacion_Final."',NOW(),'".$_SESSION['cedente']."'".$this->EvaluatedValue.")";
            $InsertEvaluation = $db -> query($SqlInsertEvaluation);
            /*if($InsertEvaluation !== false){
                $ToReturn = $db->getLastID();
            }else{
                $ToReturn = false;
            }
            return $db->getLastID();*/
            if($InsertEvaluation !== false){
                $ToReturn = $this->getLastEvaluationAdded();
            }else{
                $ToReturn = false;
            }
            return $this->getLastEvaluationAdded();
        }
        function getLastEvaluationAdded(){
            $ToReturn = false;
            $db = new Db();
            $SqlEvaluation = "select max(id) as id from evaluaciones where Id_Usuario = '".$this->Id_Usuario."' and Id_Grabacion = '".$this->Id_Grabacion."' and Id_Personal = '".$this->Id_Personal."' LIMIT 1";
		    $Evaluations = $db -> select($SqlEvaluation);
            $Evaluation = $Evaluations[0]["id"];
            return $Evaluation;
        }
        function hasEvaluation(){
            $ToReturn = false;
            $db = new Db();
            $SqlEvaluation = "select * from evaluaciones where Id_Usuario = '".$this->Id_Usuario."' and Id_Grabacion = '".$this->Id_Grabacion."'";
		    $Evaluations = $db -> select($SqlEvaluation);
            if(count($Evaluations) > 0){
                $ToReturn = true;
            }
            return $ToReturn;
        }
        function getEvaluation(){
            $db = new Db();
            $SqlEvaluation = "select * from evaluaciones where Id_Grabacion = '".$this->Id_Grabacion."' and Id_Usuario = '".$this->Id_Usuario."'";
		    $Evaluations = $db -> select($SqlEvaluation);
            return $Evaluations;
        }
        function getEvaluationByUser(){
            $db = new Db();
            $SqlEvaluation = "select * from evaluaciones where Id_Grabacion = '".$this->Id_Grabacion."' and Id_Usuario = '".$this->Id_Usuario."'";
		    $Evaluations = $db -> select($SqlEvaluation);
            return $Evaluations;
        }
        function getEvaluationDetails(){
            $db = new Db();
            $EvaluationsArray = array();
            $Cont = 0;
            $SqlEvaluation = "select * from detalle_evaluaciones where Id_Evaluacion = '".$this->Id_Evaluacion."' order by resumen ASC";
		    $Evaluations = $db -> select($SqlEvaluation);
            foreach($Evaluations as $Evaluation){
                $EvaluationArray = array();
                $EvaluationArray['Nombre'] = $Evaluation["resumen"];
                $EvaluationArray['Descripcion'] = $Evaluation["Descripcion"];
                $EvaluationArray['Esperado'] = utf8_encode($Evaluation["Esperado"]);
                $EvaluationArray['Ponderacion'] = number_format($Evaluation["Ponderacion"], 2, '.', '');
                $EvaluationArray['Nota'] = number_format($Evaluation["Nota"], 2, '.', '');
                $EvaluationArray['CalificacionPonderada'] = number_format(($Evaluation["Ponderacion"] * $Evaluation["Nota"]) / 100, 2,'.','');
                $EvaluationArray['Observacion'] = "";
                $EvaluationArray['Actions'] = "";
                $EvaluationArray['ObservacionText'] = $Evaluation["Observacion"];
                $EvaluationsArray[$Cont] = $EvaluationArray;
                $Cont++;
            }
            return $EvaluationsArray;
        }
        function getEvaluationTemplate(){
            $db = new Db();
            $EvaluationsArray = array();
            $Cont = 0;
            $SqlEvaluation = "select * from mantenedor_evaluaciones inner join perfil_personal on perfil_personal.id = mantenedor_evaluaciones.id_perfil inner join Personal on Personal.id_perfil = perfil_personal.id where Personal.Nombre_Usuario = '".$this->User."' order by resumen";
		    $Evaluations = $db -> select($SqlEvaluation);
            foreach($Evaluations as $Evaluation){
                $EvaluationArray = array();
                $EvaluationArray['Nombre'] = utf8_encode($Evaluation["resumen"]);
                $EvaluationArray['Descripcion'] = utf8_encode($Evaluation["Descripcion"]);
                $EvaluationArray['Esperado'] = utf8_encode($Evaluation["Esperado"]);
                $EvaluationArray['Ponderacion'] = number_format($Evaluation["Ponderacion"], 2, '.', '');
                $EvaluationArray['Nota'] = number_format(0, 2, '.', '');
                $EvaluationArray['CalificacionPonderada'] = number_format(0, 2, '.', '');
                $EvaluationArray['Observacion'] = "";
                $EvaluationArray['Actions'] = "";
                $EvaluationArray['ObservacionText'] = "";
                $EvaluationsArray[$Cont] = $EvaluationArray;
                $Cont++;
            }
            return $EvaluationsArray;
        }
        function deleteEvaluationDetails(){
            $db = new Db();
            $ToReturn = false;
            $SqlDeleteEvaluacionDetail = "delete from detalle_evaluaciones where Id_Evaluacion = ".$this->Id_Evaluacion;
            $DeleteEvaluacionDetail = $db -> query($SqlDeleteEvaluacionDetail);
            if($DeleteEvaluacionDetail !== false){
                $ToReturn = true;
            }else{
                $ToReturn = false;
            }
            return $ToReturn;
        }
        function addEvaluationDetails($Evaluations){
            $db = new Db();
            foreach($Evaluations as $Evaluation){
                $this->Resumen = $Evaluation[0];
                $this->Description = $Evaluation[1];
                $this->Esperado = $Evaluation[2];
                $this->Ponderacion = $Evaluation[3];
                $this->Nota = $Evaluation[4];
                $this->Observacion = $Evaluation[5];
                $SqlInsertEvaluation = "insert into detalle_evaluaciones (Id_Evaluacion, resumen, Descripcion, Esperado, Ponderacion, Nota, Observacion) values('".$this->Id_Evaluacion."', '".$this->Resumen."', '".$this->Description."', '".$this->Esperado."','".$this->Ponderacion."','".$this->Nota."','".$this->Observacion."')";
                $InsertEvaluation = $db -> query($SqlInsertEvaluation);
            }

        }
        function updateEvaluation(){
            $db = new Db();
            $ToReturn = false;
            //$SqlUpdateEvaluation = "update evaluaciones set Evaluacion_Final = '".$this->Evaluacion_Final."',Aspectos_Fortalecer = '".$this->Aspectos_Fortalecer."',Aspectos_Corregir = '".$this->Aspectos_Corregir."',Compromiso_Ejecutivo='".$this->Compromiso_Ejecutivo."' where Id_Grabacion='".$this->Id_Grabacion."' and Id_Usuario = '".$this->Id_Usuario."'";
            $SqlUpdateEvaluation = "update evaluaciones set Evaluacion_Final = '".$this->Evaluacion_Final."' where Id_Grabacion='".$this->Id_Grabacion."' and Id_Usuario = '".$this->Id_Usuario."'";
            $UpdateEvaluation = $db -> query($SqlUpdateEvaluation);
            $ToReturn = $this->getEvaluationID();
            return $ToReturn;
        }
        function getEvaluationID(){
            $db = new Db();
            $SqlEvaluation = "select id from evaluaciones where Id_Grabacion = '".$this->Id_Grabacion."' and Id_Usuario = '".$this->Id_Usuario."'";
		    $Evaluations = $db -> select($SqlEvaluation);
            return $Evaluations[0]["id"];
        }
        function getEvaluations_Managment(){
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
        }
        function AddEvaluation_Managment(){
            $db = new Db();
            $ToReturn = false;
            $SqlInsertEvaluation = "insert into mantenedor_evaluaciones (Descripcion, Ponderacion) values('".$this->Description."','".$this->Ponderacion."')";
            $InsertEvaluation = $db -> query($SqlInsertEvaluation);
            if($InsertEvaluation !== false){
                $ToReturn = $db->getLastID();
            }else{
                $ToReturn = false;
            }
            return $db->getLastID();
        }
        function updateEvaluation_Managment(){
            $db = new Db();
            $ToReturn = false;
            $SqlUpdateEvaluation = "update mantenedor_evaluaciones set Descripcion = '".$this->Description."', Ponderacion = '".$this->Ponderacion."' where id='".$this->Id_Evaluacion."' ";
            $UpdateEvaluation = $db -> query($SqlUpdateEvaluation);
            if($UpdateEvaluation !== false){
                $ToReturn = true;
            }else{
                $ToReturn = false;
            }
            return $ToReturn;
        }
        function deleteEvaluation_Managment(){
            $db = new Db();
            $ToReturn = false;
            $SqlDeleteEvaluacion = "delete from mantenedor_evaluaciones where id = ".$this->Id_Evaluacion;
            $DeleteEvaluacion = $db -> query($SqlDeleteEvaluacion);
            if($DeleteEvaluacion !== false){
                $ToReturn = true;
            }else{
                $ToReturn = false;
            }
            return $ToReturn;
        }
        function getCarteraList(){
            $db = new Db();
            $SqlCartera = "select distinct Cartera from grabacion_2 INNER JOIN Cedente on Cedente.Nombre_Cedente = grabacion_2.Cartera INNER JOIN mandante_cedente on mandante_cedente.Id_Cedente = Cedente.Id_Cedente INNER JOIN mandante on mandante.id = mandante_cedente.Id_Mandante where mandante.id = '".$this->Id_Mandante."' order by grabacion_2.Cartera";
            //$SqlCartera = "select distinct Cartera from grabacion_2 where grabacion_2.Fecha BETWEEN '".$this->startDate."' and '".$this->endDate."'";
		    $Carteras = $db -> select($SqlCartera);
            return $Carteras;
        }
        function getRecordGroupByIDs($ArrayIDs){

            $inArrayIDs = "(".$ArrayIDs.")";
            //Query (Probar)
                //select grabacion_2.Nombre_Grabacion as Grabacion, grabacion_2.Fecha as fecha, SUM(detalle_evaluaciones.Ponderacion) as Ponderacion, AVG(detalle_evaluaciones.Nota) as Nota, SUM((detalle_evaluaciones.Nota * detalle_evaluaciones.Ponderacion) / 100) as CalfPonderada from grabacion_2 inner join evaluaciones on evaluaciones.Id_Grabacion = grabacion_2.id inner join detalle_evaluaciones on detalle_evaluaciones.Id_Evaluacion = evaluaciones.id where evaluaciones.Id_Usuario='46' group by grabacion_2.Nombre_Grabacion, grabacion_2.Usuario, grabacion_2.Fecha, evaluaciones.Id_Usuario

            $db = new Db();
            $RecordsArray = array();
            $Cont = 0;
            $PromPonderacion = 0;
            $PromNota = 0;
            $PromCalf = 0;
            $SqlRecord = "select evaluaciones.id as ID, grabacion_2.Nombre_Grabacion as Grabacion, grabacion_2.Fecha as fecha, SUM(detalle_evaluaciones.Ponderacion) as Ponderacion, AVG(detalle_evaluaciones.Nota) as Nota, SUM((detalle_evaluaciones.Nota * detalle_evaluaciones.Ponderacion) / 100) as CalfPonderada from grabacion_2 inner join evaluaciones on evaluaciones.Id_Grabacion = grabacion_2.id inner join detalle_evaluaciones on detalle_evaluaciones.Id_Evaluacion = evaluaciones.id where evaluaciones.Id_Usuario='".$this->Id_Usuario."' and grabacion_2.id in ".$inArrayIDs." group by evaluaciones.id, grabacion_2.Nombre_Grabacion, grabacion_2.Usuario, grabacion_2.Fecha, evaluaciones.Id_Usuario";
		    $Records = $db -> select($SqlRecord);
            foreach($Records as $Record){
                $RecordArrayTmp = array();
                $RecordArrayTmp["Grabacion"] = $Record["Grabacion"];
                $RecordArrayTmp["FechaEvaluacion"] = $Record["fecha"];
                $RecordArrayTmp["Ponderacion"] = number_format($Record["Ponderacion"], 2, '.', '');
                $RecordArrayTmp["Nota"] = number_format($Record["Nota"], 2, '.', '');
                $RecordArrayTmp["CalificacionPonderada"] = number_format($Record["CalfPonderada"], 2, '.', '');
                $RecordsArray["Body"][$Cont] = $RecordArrayTmp;
                $Cont++;
                $PromPonderacion += $RecordArrayTmp["Ponderacion"];
                $PromNota += $RecordArrayTmp["Nota"];
                $PromCalf += $RecordArrayTmp["CalificacionPonderada"];
            }
            $PromPonderacion = $PromPonderacion / $Cont;
            $PromNota = $PromNota / $Cont;
            $PromCalf = $PromCalf / $Cont;
            $RecordsArray["Foot"]["Ponderacion"] = number_format($PromPonderacion,2,'.','');
            $RecordsArray["Foot"]["Nota"] = number_format($PromNota,2,'.','');
            $RecordsArray["Foot"]["CalificacionPonderada"] = number_format($PromCalf,2,'.','');
            return $RecordsArray;
        }
        function AddGroup(){
            $db = new Db();
            $ToReturn = false;
            $SqlInsertGroup = "insert into grupos_evaluaciones (Id_Personal, fecha_agrupamiento, Aspectos_Fortalecer, Aspectos_Corregir, Compromiso_Ejecutivo, Id_Usuario) values('".$this->Id_Personal."',NOW(),'".$this->Aspectos_Fortalecer."','".$this->Aspectos_Corregir."','".$this->Compromiso_Ejecutivo."','".$this->Id_Usuario."')";
            $InsertGroup = $db -> query($SqlInsertGroup);
            if($InsertGroup !== false){
                $ToReturn = $db->getLastID();
            }else{
                $ToReturn = false;
            }
            return $db->getLastID();
        }
        function deleteGroupDetails(){
            $db = new Db();
            $ToReturn = false;
            $SqlDeleteGroupDetail = "delete from detalle_grupos_evaluaciones where Id_Grupo = ".$this->Id_Group;
            $DeleteGroupDetail = $db -> query($SqlDeleteGroupDetail);
            if($DeleteGroupDetail !== false){
                $ToReturn = true;
            }else{
                $ToReturn = false;
            }
            return $ToReturn;
        }
        function addGroupDetails($Records){
            $db = new Db();
            $Evaluations = $this->getEvaluationsFromRecords($Records);
            foreach($Evaluations as $Evaluation){
                $SqlInsertGroup = "insert into detalle_grupos_evaluaciones (Id_Grupo, Id_Evaluacion) values('".$this->Id_Group."','".$Evaluation['id']."')";
                $InsertGroup = $db -> query($SqlInsertGroup);
            }
        }
        function getEvaluationsFromRecords($Records){
            $db = new Db();
            $SqlRecord = "select * from evaluaciones where Id_Grabacion in (".$Records.") and Id_Usuario = '".$this->Id_Usuario."' order by id";
		    $Records = $db -> select($SqlRecord);
            return $Records;
        }
        function getRecordListEvaluadosAjax(){
            $db = new Db();
            $RecordsArray = array();
            $Cont = 0;
            $fechaDesde = new DateTime();
            $fechaDesde->modify('first day of this month');
            $Desde = $fechaDesde->format('Ymd'); // imprime por ejemplo: 01/12/2012
            $fechaHasta = new DateTime();
            $fechaHasta->modify('last day of this month');
            $Hasta = $fechaHasta->format('Ymd'); // imprime por ejemplo: 31/12/2012
            $SqlRecord = "select
                            grabacion_2.id as id,
                            grabacion_2.Nombre_Grabacion as Nombre_Grabacion,
                            grabacion_2.Fecha as Fecha,
                            grabacion_2.Cartera as Cartera,
                            grabacion_2.Usuario as Usuario,
                            grabacion_2.Telefono as Telefono
                        from evaluaciones
                            inner join grabacion_2 on grabacion_2.id = evaluaciones.Id_Grabacion
                            inner join Cedente on Cedente.Id_Cedente = evaluaciones.Id_Cedente
                            inner join mandante_cedente on mandante_cedente.Id_Cedente = Cedente.Id_Cedente
                            inner join mandante on mandante.id = mandante_cedente.Id_Mandante
                        where
                            mandante.id = '".$this->Id_Mandante."' and
                            Cedente.Id_Cedente = '".$this->Id_Cedente."' and
                            grabacion_2.Usuario = '".$this->User."' and
                            grabacion_2.Fecha BETWEEN '".$Desde."' and '".$Hasta."'
                        group by
                            grabacion_2.id,
                            grabacion_2.Nombre_Grabacion,
                            grabacion_2.Cartera,
                            grabacion_2.Usuario,
                            grabacion_2.Telefono";
		    $Records = $db -> select($SqlRecord);
            foreach($Records as $Record){
                $this->Id_Grabacion = $Record['id'];
                $RecordArrayTmp = array();
                $RecordArrayTmp["Filename"] = $Record["Nombre_Grabacion"];
                $RecordArrayTmp["Date"] = $Record["Fecha"];
                $RecordArrayTmp["Cartera"] = $Record["Cartera"];
                $RecordArrayTmp["User"] = $Record["Usuario"];
                $RecordArrayTmp["Phone"] = $Record["Telefono"];
                $RecordArrayTmp["Listen"] = $this->dir.$Record["Nombre_Grabacion"];
                $RecordArrayTmp["Status"] = $this->hasEvaluation() ? "Evaluada" : "";//$Record["Estado"] == "1" ? "Evaluada" : "";
                $RecordArrayTmp["Evaluar"] = $Record["id"];
                $RecordArrayTmp["Imprimir"] = $Record["id"];
                $RecordsArray[$Cont] = $RecordArrayTmp;
                $Cont++;
            }
            return $RecordsArray;
        }
        function isUserMandante(){
            $ToReturn = false;
            $db = new Db();
            $SqlUser = "select * from Usuarios where id = '".$this->Id_Usuario."'";
		    $Users = $db -> select($SqlUser);
            foreach($Users as $User){
                if($User["mandante"] != ""){
                    $ToReturn = true;
                }
            }
            return $ToReturn;
        }
        function Empiezo(){
            $ToReturn = false;
            $db = new Db();
            $SqlMandante = "select * from mandante where id = '".$this->Id_Mandante."'";
		    $Mandantes = $db -> select($SqlMandante);
            foreach($Mandantes as $Mandante){
                if($this->isUserMandante()){
                    if($Mandante["Empieza"] == "1"){
                        $ToReturn = true;
                    }
                }else{
                    if($Mandante["Empieza"] == "0"){
                        $ToReturn = true;
                    }
                }
            }
            return $ToReturn;
        }
        function PuedeHacerCierreDeProceso(){
            $ToReturn = false;
            $fechaDesde = new DateTime();
            $fechaDesde->modify('first day of this month');
            $Desde = $fechaDesde->format('Ymd'); // imprime por ejemplo: 01/12/2012
            $fechaHasta = new DateTime();
            $fechaHasta->modify('last day of this month');
            $Hasta = $fechaHasta->format('Ymd'); // imprime por ejemplo: 31/12/2012
            $db = new Db();
            $SqlEvaluation = "select
                                    grabacion_2.id as id,
                                    grabacion_2.Nombre_Grabacion as Nombre_Grabacion,
                                    grabacion_2.Fecha as Fecha,
                                    grabacion_2.Cartera as Cartera,
                                    grabacion_2.Usuario as Usuario,
                                    grabacion_2.Telefono as Telefono
                                from evaluaciones
                                    inner join grabacion_2 on grabacion_2.id = evaluaciones.Id_Grabacion
                                    inner join Cedente on Cedente.Id_Cedente = evaluaciones.Id_Cedente
                                    inner join mandante_cedente on mandante_cedente.Id_Cedente = Cedente.Id_Cedente
                                    inner join mandante on mandante.id = mandante_cedente.Id_Mandante
                                where
                                    evaluaciones.Id_Usuario = '".$this->Id_Usuario."' and
                                    evaluaciones.Id_Cedente = '".$this->Id_Cedente."' and 
                                    mandante.id = '".$this->Id_Mandante."' and
                                    grabacion_2.Usuario = '".$this->User."' and
                                    grabacion_2.Fecha BETWEEN '".$Desde."' and '".$Hasta."'
                                group by
                                    grabacion_2.id,
                                    grabacion_2.Nombre_Grabacion,
                                    grabacion_2.Cartera,
                                    grabacion_2.Usuario,
                                    grabacion_2.Telefono";
		    $Evaluations = $db -> select($SqlEvaluation);
            if(count($Evaluations) > 0){
                $ToReturn = true;
            }
            return $ToReturn;
        }
        function CierreDeProceso(){
            $Evaluations = $this->GetEvaluatedEvaluations();
            $this->InsertCierreDeProceso($Evaluations);
        }
        function GetEvaluatedEvaluations(){
            $fechaDesde = new DateTime();
            $fechaDesde->modify('first day of this month');
            $Desde = $fechaDesde->format('Ymd'); // imprime por ejemplo: 01/12/2012
            $fechaHasta = new DateTime();
            $fechaHasta->modify('last day of this month');
            $Hasta = $fechaHasta->format('Ymd'); // imprime por ejemplo: 31/12/2012
            $db = new Db();
            $SqlEvaluation = "select
                                    evaluaciones.*
                                from evaluaciones
                                    inner join grabacion_2 on grabacion_2.id = evaluaciones.Id_Grabacion
                                    inner join Cedente on Cedente.Id_Cedente = evaluaciones.Id_Cedente
                                    inner join mandante_cedente on mandante_cedente.Id_Cedente = Cedente.Id_Cedente
                                    inner join mandante on mandante.id = mandante_cedente.Id_Mandante
                                where
                                    evaluaciones.Id_Usuario = '".$this->Id_Usuario."' and
                                    evaluaciones.Id_Cedente = '".$this->Id_Cedente."' and 
                                    mandante.id = '".$this->Id_Mandante."' and
                                    grabacion_2.Usuario = '".$this->User."' and
                                    grabacion_2.Fecha BETWEEN '".$Desde."' and '".$Hasta."'
                                group by
                                    grabacion_2.id,
                                    grabacion_2.Nombre_Grabacion,
                                    grabacion_2.Cartera,
                                    grabacion_2.Usuario,
                                    grabacion_2.Telefono";
		    $Evaluations = $db -> select($SqlEvaluation);
            return $Evaluations;
        }
        function InsertCierreDeProceso($Evaluations){
            $db = new Db();
            $PersonalClass = new Personal();
            $PersonalClass->Username = $this->User;
            $Id_Personal = $PersonalClass->getPersonalIDFromUsername();
            $ToReturn = false;
            $Nota = 0;
            $Ponderacion = 0;
            $CalfPonderada = 0;
            $Id_Evaluaciones = "";
            foreach($Evaluations as $Evaluation){
                $this->Id_Evaluacion = $Evaluation['id'];
                $Id_Evaluaciones = $Id_Evaluaciones ."". $Evaluation['id'].",";
                $ArrayResumenDetalle = $this->GetDetalleEvaluaciones_Resumen();
                $Nota += $ArrayResumenDetalle["Nota"];
                $Ponderacion += $ArrayResumenDetalle["Ponderacion"];
                $CalfPonderada += $ArrayResumenDetalle["CalfPonderada"];
            }
            $Id_Evaluaciones = substr($Id_Evaluaciones,0,strlen($Id_Evaluaciones) - 1);
            $Nota = $Nota / count($Evaluations);
            $Ponderacion = $Ponderacion / count($Evaluations);
            $CalfPonderada = $CalfPonderada / count($Evaluations);
            $SqlInsertCierre = "insert into cierre_evaluaciones (Id_Evaluaciones,Nota,Ponderacion,Calf_Ponderada,Id_Usuario,Id_Mandante,Id_Cedente,Id_Personal,Aspectos_Fortalecer,Aspectos_Corregir,Compromiso_Ejecutivo,fecha) values('".$Id_Evaluaciones."','".$Nota."','".$Ponderacion."','".$CalfPonderada."','".$this->Id_Usuario."','".$this->Id_Mandante."','".$this->Id_Cedente."','".$Id_Personal."','".$this->Aspectos_Fortalecer."','".$this->Aspectos_Corregir."','".$this->Compromiso_Ejecutivo."',NOW())";
            $InsertCierre = $db->query($SqlInsertCierre);
            /*if($InsertCierre === true){
                $ToReturn = true;
            }
            return $ToReturn;*/
        }
        function GetDetalleEvaluaciones_Resumen(){
            $ToReturn = array();
            $db = new Db();
            $Query = "select SUM(Ponderacion) as Ponderacion, AVG(Nota) as Nota, SUM((Nota * Ponderacion) / 100) as CalfPonderada from detalle_evaluaciones where Id_Evaluacion = '".$this->Id_Evaluacion."'";
            $EvaluationResume = $db -> select($Query);
            foreach($EvaluationResume as $Evaluation){
                $ToReturn["Nota"] = $Evaluation["Nota"];
                $ToReturn["Ponderacion"] = $Evaluation["Ponderacion"];
                $ToReturn["CalfPonderada"] = $Evaluation["CalfPonderada"];
            }
            return $ToReturn;
        }
        function HizoCierre(){
            $ToReturn = false;
            $db = new Db();
            $PersonalClass = new Personal();
            $PersonalClass->Username = $this->User;
            $Id_Personal = $PersonalClass->getPersonalIDFromUsername();
            $Query = "select * from cierre_evaluaciones where Id_Usuario = '".$this->Id_Usuario."' and Id_Cedente = '".$this->Id_Cedente."' and Id_Personal = '".$Id_Personal."' and year(fecha) = year(NOW()) and month(fecha) = month(NOW())";
            $Evaluations = $db -> select($Query);
            if(count($Evaluations) > 0){
                $ToReturn = true;
            }
            return $ToReturn;
        }
        function getCierres(){
            $db = new Db();
            $PersonalClass = new Personal();
            $PersonalClass->Username = $this->User;
            $Id_Personal = $PersonalClass->getPersonalIDFromUsername();
            $CierresArray = array();
            $Cont = 0;
            $SqlCierre = "select
                            *
                        from cierre_evaluaciones
                        where
                            Id_Cedente = '".$this->Id_Cedente."' and
                            Id_Usuario = '".$this->Id_Usuario."' and
                            Id_Personal = '".$Id_Personal."' and
                            fecha BETWEEN '".$this->startDate."' and '".$this->endDate."'";
		    $Cierres = $db -> select($SqlCierre);
            foreach($Cierres as $Cierre){
                $this->Id_Grabacion = $Cierre['id'];
                $CierreArrayTmp = array();
                $CierreArrayTmp["AspectosF"] = $Cierre["Aspectos_Fortalecer"];
                $CierreArrayTmp["AspectosC"] = $Cierre["Aspectos_Corregir"];
                $CierreArrayTmp["CompromisoE"] = $Cierre["Compromiso_Ejecutivo"];
                $CierreArrayTmp["Date"] = $Cierre["fecha"];
                $CierreArrayTmp["Visualizar"] = $Cierre["id"];
                $CierreArrayTmp["Imprimir"] = $Cierre["id"];
                $CierresArray[$Cont] = $CierreArrayTmp;
                $Cont++;
            }
            return $CierresArray;
        }
        function getCierre(){
            $db = new Db();
            $SqlCierre = "select * from cierre_evaluaciones where id = '".$this->Id_Cierre."'";
		    $Cierres = $db -> select($SqlCierre);
            return $Cierres;
        }
        function getEvaluationDetailsCierre($Evaluations){
            $db = new Db();
            $EvaluationsArray = array();
            $Cont = 0;
            $SqlEvaluation = "select
                                    evaluaciones.id,
                                    grabacion_2.Nombre_Grabacion as Grabacion,
                                    SUM(detalle_evaluaciones.Ponderacion) as Ponderacion,
                                    AVG(detalle_evaluaciones.Nota) as Nota,
                                    SUM((detalle_evaluaciones.Nota * detalle_evaluaciones.Ponderacion) / 100) as CalfPonderada
                                from evaluaciones
                                    inner join detalle_evaluaciones on detalle_evaluaciones.Id_Evaluacion = evaluaciones.id
                                    inner join grabacion_2 on grabacion_2.id = evaluaciones.Id_Grabacion
                                where
                                    evaluaciones.id in(".$Evaluations.")
                                group by
                                    evaluaciones.id
                                order by 
                                    evaluaciones.id,
                                    grabacion_2.Nombre_Grabacion";
		    $Evaluations = $db -> select($SqlEvaluation);
            foreach($Evaluations as $Evaluation){
                $EvaluationArray = array();
                $EvaluationArray['Nombre_Grabacion'] = $Evaluation["Grabacion"];
                $EvaluationArray['Grabacion'] = $this->dir.$Evaluation["Grabacion"];
                $EvaluationArray['Ponderacion'] = number_format($Evaluation["Ponderacion"], 2, '.', '');
                $EvaluationArray['Nota'] = number_format($Evaluation["Nota"], 2, '.', '');
                $EvaluationArray['CalificacionPonderada'] = number_format($Evaluation["CalfPonderada"], 2,'.','');
                $EvaluationsArray[$Cont] = $EvaluationArray;
                $Cont++;
            }
            return $EvaluationsArray;
        }
        function getGeneralGraphDataByUserType($UserType){
            $ByUser = "";
            switch($UserType){
                case '1':
                    //Calidad Sistema
                    $ByUser = "byCalidadSystem";
                break;
                case '2':
                    //Calidad Mandante
                    $ByUser = "byCalidadMandante";
                break;
                case '3':
                    //Ejecutivo Sistema
                    $ByUser = "byEjecutivoSystem";
                break;
                case '4':
                    //Ejecutivo Mandantte
                    $ByUser = "byCEjecutivoMandante";
                break;
                case '5':
                break;
                case '6':
                break;
            }
            $db = new Db();
            $DateArray = $this->getDateFromServer();
            $Now = $DateArray["date"];
            $Now = new DateTime($Now);
            $Now->modify('last day of this month');
            $Now = $Now->format('Ymd');
            $SixMonthsAgo = strtotime ( '-6 months' , strtotime ( $Now ) ) ;
            $SixMonthsAgo = date ( 'Ymd' , $SixMonthsAgo );
            $Array = array();
            $Cont = 0;
            $Month = 1;
            $SqlEvaluation = "select
                                    year(evaluaciones.Fecha_Evaluacion) as Year, MONTH(evaluaciones.Fecha_Evaluacion) as Month, ROUND(AVG(Nota),2) as Nota
                                from evaluaciones
                                    INNER JOIN detalle_evaluaciones on detalle_evaluaciones.Id_Evaluacion = evaluaciones.id
                                where
                                    Fecha_Evaluacion BETWEEN '".$SixMonthsAgo."' and '".$Now."' and
                                    Id_Cedente = '".$this->Id_Cedente."' and
                                    Id_Personal = '460' and
                                    (select Id_Evaluaciones from cierre_evaluaciones where FIND_IN_SET(evaluaciones.id,Id_Evaluaciones)) and
                                    ".$ByUser." = 1
                                GROUP by year(evaluaciones.Fecha_Evaluacion), MONTH(evaluaciones.Fecha_Evaluacion)
                                ORDER BY year(evaluaciones.Fecha_Evaluacion) ASC, MONTH(evaluaciones.Fecha_Evaluacion) ASC";
		    $Evaluations = $db -> select($SqlEvaluation);
            foreach($Evaluations as $Evaluation){
                $DataArray = array();
                $DataArray[0] = $Month;
                $DataArray[1] = $Evaluation["Nota"];
                $Array[$Cont] = $DataArray;
                $Month++;
                $Cont++;
            }
            return $Array;
        }
        function getGeneralByEvaluationGraphDataByUserType($UserType){
            $ByUser = "";
            $UserTypeName = "";
            switch($UserType){
                case '1':
                    //Calidad Sistema
                    $ByUser = "byCalidadSystem";
                    $UserTypeName = "calidad";
                break;
                case '2':
                    //Calidad Mandante
                    $ByUser = "byCalidadMandante";
                    $UserTypeName = "empresa";
                break;
                case '3':
                    //Ejecutivo Sistema
                    $ByUser = "byEjecutivoSystem";
                    $UserTypeName = "ejecutivo";
                break;
                case '4':
                    //Ejecutivo Mandantte
                    $ByUser = "byEjecutivoMandante";
                    $UserTypeName = "";
                break;
                case '5':
                break;
                case '6':
                break;
            }
            $db = new Db();
            $DateArray = $this->getDateFromServer();
            $Now = $DateArray["date"];
            $Now = new DateTime($Now);
            $Now->modify('last day of this month');
            $Now = $Now->format('Ymd');
            $SixMonthsAgo = strtotime ( '-6 months' , strtotime ( $Now ) ) ;
            $SixMonthsAgo = date ( 'Ymd' , $SixMonthsAgo );
            $Array = array();
            $Cont = 0;
            $Month = 1;
            $SqlEvaluation = "select
                                    year(evaluaciones.Fecha_Evaluacion) as Year, MONTH(evaluaciones.Fecha_Evaluacion) as Month, ROUND(AVG(Nota),2) as Nota, detalle_evaluaciones.resumen as Resumen
                                from evaluaciones
                                    INNER JOIN detalle_evaluaciones on detalle_evaluaciones.Id_Evaluacion = evaluaciones.id
                                where
                                    Id_Cedente = '".$this->Id_Cedente."' and
                                    Id_Personal = '460' and
                                    YEAR(Fecha_Evaluacion) = YEAR((select MAX(Fecha_Evaluacion) from evaluaciones where Id_Personal = '460')) and
                                    MONTH(Fecha_Evaluacion) = MONTH((select MAX(Fecha_Evaluacion) from evaluaciones where Id_Personal = '460')) and
                                    (select Id_Evaluaciones from cierre_evaluaciones where FIND_IN_SET(evaluaciones.id,Id_Evaluaciones)) and
                                    ".$ByUser." = 1
                                GROUP by year(evaluaciones.Fecha_Evaluacion), MONTH(evaluaciones.Fecha_Evaluacion), detalle_evaluaciones.resumen
                                ORDER BY year(evaluaciones.Fecha_Evaluacion) ASC, MONTH(evaluaciones.Fecha_Evaluacion) ASC, detalle_evaluaciones.resumen ASC";
		    $Evaluations = $db -> select($SqlEvaluation);
            foreach($Evaluations as $Evaluation){
                $DataArray = array();
                $DataArray["Evaluacion"] = $Evaluation["Resumen"];
                $DataArray["Nota"] = $Evaluation["Nota"];
                $DataArray["UserTypeName"] = $UserTypeName;
                $Array[$Cont] = $DataArray;
                $Month++;
                $Cont++;
            }
            return $Array;
        }
        function getByEvaluationGraphDataByUserType($UserType){
            $ByUser = "";
            $UserTypeName = "";
            switch($UserType){
                case '1':
                    //Calidad Sistema
                    $ByUser = "byCalidadSystem";
                    $UserTypeName = "calidad";
                break;
                case '2':
                    //Calidad Mandante
                    $ByUser = "byCalidadMandante";
                    $UserTypeName = "empresa";
                break;
                case '3':
                    //Ejecutivo Sistema
                    $ByUser = "byEjecutivoSystem";
                    $UserTypeName = "ejecutivo";
                break;
                case '4':
                    //Ejecutivo Mandantte
                    $ByUser = "byEjecutivoMandante";
                    $UserTypeName = "";
                break;
                case '5':
                break;
                case '6':
                break;
            }
            $db = new Db();
            $DateArray = $this->getDateFromServer();
            $Now = $DateArray["date"];
            $Now = new DateTime($Now);
            $Now->modify('last day of this month');
            $Now = $Now->format('Ymd');
            $SixMonthsAgo = strtotime ( '-6 months' , strtotime ( $Now ) ) ;
            $SixMonthsAgo = date ( 'Ymd' , $SixMonthsAgo );
            $Array = array();
            $Cont = 0;
            $Month = 1;
            $SqlEvaluation = "select
                                    year(evaluaciones.Fecha_Evaluacion) as Year, MONTH(evaluaciones.Fecha_Evaluacion) as Month, ROUND(AVG(Nota),2) as Nota, detalle_evaluaciones.resumen as Resumen
                                from evaluaciones
                                    INNER JOIN detalle_evaluaciones on detalle_evaluaciones.Id_Evaluacion = evaluaciones.id
                                where
                                    Fecha_Evaluacion BETWEEN '".$SixMonthsAgo."' and '".$Now."' and
                                    Id_Cedente = '".$this->Id_Cedente."' and
                                    Id_Personal = '460' and
                                    (select Id_Evaluaciones from cierre_evaluaciones where FIND_IN_SET(evaluaciones.id,Id_Evaluaciones)) and
                                    ".$ByUser." = 1
                                GROUP by year(evaluaciones.Fecha_Evaluacion), MONTH(evaluaciones.Fecha_Evaluacion), detalle_evaluaciones.resumen
                                ORDER BY detalle_evaluaciones.resumen ASC, year(evaluaciones.Fecha_Evaluacion) ASC, MONTH(evaluaciones.Fecha_Evaluacion) ASC";
		    $Evaluations = $db -> select($SqlEvaluation);
            $EvaluationResumen = "";
            foreach($Evaluations as $Evaluation){
                if($EvaluationResumen != $Evaluation["Resumen"]){
                    $Month = 1;
                    $Cont = 0;
                    $EvaluationResumen = $Evaluation["Resumen"];
                }
                $DataArray = array();
                //$DataArray["Resumen"] = $Evaluation["Resumen"];
                $DataArray = array();
                $DataArray[0] = $Month;
                $DataArray[1] = $Evaluation["Nota"];
                $Array[$Evaluation["Resumen"]][$Cont] = $DataArray;
                $Month++;
                $Cont++;
            }
            return $Array;
        }
        function getDateFromServer($Separator = ""){
            $db = new Db();
            $SqlDate = "select DATE_FORMAT(NOW(),'%Y".$Separator."%m".$Separator."%d') as date, DATE_FORMAT(NOW(),'%T:%f') as hour";
		    $Dates = $db -> select($SqlDate);
            return $Dates[0];
        }
    }
?>