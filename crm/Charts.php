<?php
require_once('../db/db.php'); 
    class Charts{

        public function mostrarTorta($tabla,$cedente,$lista)
        {
            $this->tabla=$tabla;
            $this->cedente=$cedente;
            $this->lista=$lista;
            if($this->lista==-1)
            {
                $ToReturn = "";
                $ArrayGestiones = array(); 
                $ContArrayGestiones = 0;
                $q1 = mysql_query("SELECT Id,Respuesta_N1 FROM Nivel1 WHERE FIND_IN_SET('$this->cedente',Id_Cedente)");
                $num = mysql_num_rows($q1);
                $cant = 0;
                while($Result1 = mysql_fetch_array($q1))
                {
                    $Gestion = array();
                    $nombre = $Result1[1];
                    $registros = $Result1[0];
                    //$q2 = mysql_query("SELECT rut_cliente FROM gestion_ult_semestre WHERE resultado = $registros AND cedente = $this->cedente AND lista=$this->lista");
                    $q2 = mysql_query("SELECT Rut FROM Mejor_Gestion_Periodo WHERE Respuesta_N1 = $registros AND Id_Cedente = $this->cedente ");
                    $cant =  mysql_num_rows($q2);
                    $Gestion = array();
                    $Gestion["label"] = $nombre;
                    $Gestion["data"] = $cant;
                    $ArrayGestiones[$ContArrayGestiones] = $Gestion;
                    $ContArrayGestiones++;
                }
                 echo $ToReturn = json_encode($ArrayGestiones);
            }  
            else
            {  
                $ToReturn = "";
                $ArrayGestiones = array(); 
                $ContArrayGestiones = 0;
                $q1 = mysql_query("SELECT Id,Respuesta_N1 FROM Nivel1 WHERE FIND_IN_SET('$this->cedente',Id_Cedente)");
                $num = mysql_num_rows($q1);
                $cant = 0;
                while($Result1 = mysql_fetch_array($q1))
                {
                    $Gestion = array();
                    $nombre = $Result1[1];
                    $registros = $Result1[0];
                    //$q2 = mysql_query("SELECT rut_cliente FROM gestion_ult_semestre WHERE resultado = $registros AND cedente = $this->cedente AND lista=$this->lista");
                    $q2 = mysql_query("SELECT Rut FROM Mejor_Gestion_Periodo WHERE Respuesta_N1 = $registros AND Id_Cedente = $this->cedente AND lista=$this->lista");
                    $cant =  mysql_num_rows($q2);
                    $Gestion = array();
                    $Gestion["label"] = $nombre;
                    $Gestion["data"] = $cant;
                    $ArrayGestiones[$ContArrayGestiones] = $Gestion;
                    $ContArrayGestiones++;
                }
                 echo $ToReturn = json_encode($ArrayGestiones);
            }     
        }
        public function mostrarTorta2($tabla,$cedente,$lista,$id)
        {
            
            $this->tabla=$tabla;
            $this->cedente=$cedente;
            $this->lista=$lista;
            $this->id=$id;
            if($this->lista==-1)
            {
                $ToReturn = "";
                $ArrayGestiones = array(); 
                $ContArrayGestiones = 0;
                $q1 = mysql_query("SELECT Id,Respuesta_N2  FROM Nivel2 WHERE Id_Nivel1 = $id");
                $num = mysql_num_rows($q1);
                $cant = 0;
                while($Result1 = mysql_fetch_array($q1))
                {
                    $Gestion = array();
                    $nombre = $Result1[1];
                    //$nombre = '';
                    $registros = $Result1[0];
                    //$q2 = mysql_query("SELECT rut_cliente FROM gestion_ult_semestre WHERE resultado = $registros AND cedente = $this->cedente AND lista=$this->lista");
                    $q2 = mysql_query("SELECT Rut FROM Mejor_Gestion_Periodo WHERE Respuesta_N2 = $registros AND Id_Cedente = $this->cedente ");
                    $cant =  mysql_num_rows($q2);
                    $Gestion = array();
                    $Gestion["label"] = $nombre;
                    $Gestion["data"] = $cant;
                    $ArrayGestiones[$ContArrayGestiones] = $Gestion;
                    $ContArrayGestiones++;
                }
                if($num==0)
                {
                    echo 0;
                }    
                else
                {
                    echo $ToReturn = json_encode($ArrayGestiones);
                }  
            }
            else
            {    
                $ToReturn = "";
                $ArrayGestiones = array(); 
                $ContArrayGestiones = 0;
                $q1 = mysql_query("SELECT Id,Respuesta_N2  FROM Nivel2 WHERE Id_Nivel1 = $id");
                $num = mysql_num_rows($q1);
                $cant = 0;
                while($Result1 = mysql_fetch_array($q1))
                {
                    $Gestion = array();
                    $nombre = $Result1[1];
                    //$nombre = '';
                    $registros = $Result1[0];
                    //$q2 = mysql_query("SELECT rut_cliente FROM gestion_ult_semestre WHERE resultado = $registros AND cedente = $this->cedente AND lista=$this->lista");
                    $q2 = mysql_query("SELECT Rut FROM Mejor_Gestion_Periodo WHERE Respuesta_N2 = $registros AND Id_Cedente = $this->cedente AND lista=$this->lista");
                    $cant =  mysql_num_rows($q2);
                    $Gestion = array();
                    $Gestion["label"] = $nombre;
                    $Gestion["data"] = $cant;
                    $ArrayGestiones[$ContArrayGestiones] = $Gestion;
                    $ContArrayGestiones++;
                }
                if($num==0)
                {
                    echo 0;
                }    
                else
                {
                    echo $ToReturn = json_encode($ArrayGestiones);
                }  
            }      
        }
         public function mostrarTorta3($tabla,$cedente,$lista,$id)
        {
            $this->tabla=$tabla;
            $this->cedente=$cedente;
            $this->lista=$lista;
            $this->id=$id;
            if($this->lista==-1)
            {
                $ToReturn = "";
                $ArrayGestiones = array(); 
                $ContArrayGestiones = 0;
                $q1 = mysql_query("SELECT Id,Respuesta_N3  FROM Nivel3 WHERE Id_Nivel2 = $id");
                $num = mysql_num_rows($q1);
                $cant = 0;
                while($Result1 = mysql_fetch_array($q1))
                {
                    $Gestion = array();
                    $nombre = $Result1[1];
                    //$nombre = '';
                    $registros = $Result1[0];
                    //$q2 = mysql_query("SELECT rut_cliente FROM gestion_ult_semestre WHERE resultado = $registros AND cedente = $this->cedente AND lista=$this->lista");
                    $q2 = mysql_query("SELECT Rut FROM Mejor_Gestion_Periodo WHERE Respuesta_N3 = $registros AND Id_Cedente = $this->cedente ");
                    $cant =  mysql_num_rows($q2);
                    $Gestion = array();
                    $Gestion["label"] = $nombre;
                    $Gestion["data"] = $cant;
                    $ArrayGestiones[$ContArrayGestiones] = $Gestion;
                    $ContArrayGestiones++;
                }
                echo $ToReturn = json_encode($ArrayGestiones);
            }
            else
            {    
                $ToReturn = "";
                $ArrayGestiones = array(); 
                $ContArrayGestiones = 0;
                $q1 = mysql_query("SELECT Id,Respuesta_N3  FROM Nivel3 WHERE Id_Nivel2 = $id");
                $num = mysql_num_rows($q1);
                $cant = 0;
                while($Result1 = mysql_fetch_array($q1))
                {
                    $Gestion = array();
                    $nombre = $Result1[1];
                    //$nombre = '';
                    $registros = $Result1[0];
                    //$q2 = mysql_query("SELECT rut_cliente FROM gestion_ult_semestre WHERE resultado = $registros AND cedente = $this->cedente AND lista=$this->lista");
                    $q2 = mysql_query("SELECT Rut FROM Mejor_Gestion_Periodo WHERE Respuesta_N3 = $registros AND Id_Cedente = $this->cedente AND lista=$this->lista");
                    $cant =  mysql_num_rows($q2);
                    $Gestion = array();
                    $Gestion["label"] = $nombre;
                    $Gestion["data"] = $cant;
                    $ArrayGestiones[$ContArrayGestiones] = $Gestion;
                    $ContArrayGestiones++;
                }
                echo $ToReturn = json_encode($ArrayGestiones);
            }    
        }
    }
?>