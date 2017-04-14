<?php
    class Personal{
        public $id;
        public $Username;
        public $Name;
        public $Rut;
        public $Birthday;
        public $Gender;

        public $startDate;
        public $endDate;
        public $Cartera;

        public $Id_Usuario;
        public $Id_Mandante;
        public $Id_Cedente;

        function __construct(){
            $this->Id_Usuario = $_SESSION['id_usuario'];
            $this->Id_Mandante = $_SESSION['mandante'];
            $this->Id_Cedente = $_SESSION['cedente'];
        }
        function getPersonal(){
            $db = new Db();
            $SqlPersonal = "select * from Personal where Id_Personal = '".$this->id."'";
		    $Personals = $db -> select($SqlPersonal);
            return $Personals;
        }
        function getPersonalList(){
            $db = new Db();
            //$SqlPersonal = "select * from Personal order by Nombre";
            $SqlPersonal = "select distinct Personal.* from Personal inner join grabacion_2 on grabacion_2.Usuario = Personal.Nombre_Usuario where grabacion_2.Fecha BETWEEN '".$this->startDate."' and '".$this->endDate."' and grabacion_2.Cartera = '".$this->Cartera."' order by Personal.Nombre";
		    $Personals = $db -> select($SqlPersonal);
            return $Personals;
        }
        function getPersonalIDFromUsername(){
            $db = new Db();
            $SqlPersonal = "select Id_Personal from Personal where Nombre_Usuario = '".$this->Username."'";
		    $Personals = $db -> select($SqlPersonal);
            return $Personals[0]["Id_Personal"];
        }
        function getPersonalListEvaluadas(){
            $fechaDesde = new DateTime();
            $fechaDesde->modify('first day of this month');
            $Desde = $fechaDesde->format('Ymd');
            $fechaHasta = new DateTime();
            $fechaHasta->modify('last day of this month');
            $Hasta = $fechaHasta->format('Ymd');
            $db = new Db();
            //$SqlPersonal = "select * from Personal order by Nombre";
            $SqlPersonal = "select distinct Personal.* from Personal inner join grabacion_2 on grabacion_2.Usuario = Personal.Nombre_Usuario inner join evaluaciones on evaluaciones.Id_Grabacion = grabacion_2.id where grabacion_2.Fecha BETWEEN '".$Desde."' and '".$Hasta."' and grabacion_2.Cartera = '".$this->Cartera."' order by Personal.Nombre";
		    $Personals = $db -> select($SqlPersonal);
            return $Personals;
        }
        function getPersonalListCierres(){
            $db = new Db();
            $SqlPersonal = "select distinct Personal.* from Personal inner join cierre_evaluaciones on cierre_evaluaciones.Id_Personal = Personal.Id_Personal where cierre_evaluaciones.Id_Usuario = '".$this->Id_Usuario."' and cierre_evaluaciones.Id_Cedente = '".$this->Id_Cedente."' and cierre_evaluaciones.fecha BETWEEN '".$this->startDate."' and '".$this->endDate."'";
		    $Personals = $db -> select($SqlPersonal);
            return $Personals;
        }
    }
?>