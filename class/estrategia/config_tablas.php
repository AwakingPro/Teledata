<?php
    class configTablas
    {
        /*
        *** Lista todas las tablas registradas de un cedente
        */  
        public function getListar_tablas($cedente){
            $db = new Db();
            $TablasArray = array();
            $SqlTablas = "select * from SIS_Tablas where FIND_IN_SET('$cedente',Id_Cedente)";
            $Tablas = $db -> select($SqlTablas);
            foreach($Tablas as $Tabla){
                $Array = array();
                $Array['nombre'] = utf8_encode($Tabla["nombre"]);
                $Array['Actions'] = $Tabla["id"];
                array_push($TablasArray,$Array);
            }
            return $TablasArray;
        }

        /*
            *** Lista todas las tablas que no han sido seleccionadas por un cedente
        */ 

        public function getFiltrar_tablas($cedente){
            $db = new Db();
            $TablasArray = array();
            $SqlTablas = "select * from SIS_Tablas where NOT FIND_IN_SET('$cedente',Id_Cedente)";
            $Tablas = $db -> select($SqlTablas);
            foreach($Tablas as $Tabla){
                $Array = array();
                $Array['nombre'] = utf8_encode($Tabla["nombre"]);
                $Array['id_tabla'] = $Tabla["id"];
                array_push($TablasArray,$Array);
            }
            return $TablasArray;
        }

        /*
            *** Lista todos los campos configurados de una tabla
        */ 

        public function getFiltrar_campos($idTabla){
            $db = new Db();
            $TablasArray = array();
            $SqlTablas = "select * from SIS_Columnas_Estrategias where id_tabla = '$idTabla' order by columna desc";
            $Tablas = $db -> select($SqlTablas);
            foreach($Tablas as $Tabla){
                $Array = array();
                $Array['columna'] = utf8_encode($Tabla["columna"]);
                $Array['id_columna'] = $Tabla["id"];
                array_push($TablasArray,$Array);
            }
            return $TablasArray;
        }  


        /*
            *** Registrar tablas y campos
        */ 

        public function registrartablaCampos($idTabla,$campos,$idCedente){ 
            $db = new Db();
            $cedentesTabla = $this->GetCedentesTabla($idTabla);
            // verifico dato para saber si concateno valores o nop
            $idCedenteTabla = $idCedente;
            if ($cedentesTabla[0]['Id_Cedente'] <> ""){
            $idCedenteTabla = $cedentesTabla[0]['Id_Cedente'].",".$idCedente; 
            }      
            $this->updateCedenteTabla($idCedenteTabla,$idTabla); 

            $arrayIdCampos = $campos;
            
            foreach($arrayIdCampos as $idCampo){
            $cedentesColumna = $this->GetCedentesColumna($idCampo);
            $idCedenteColumna = $idCedente;
            if ($cedentesColumna[0]['Id_Cedente'] <> ""){
                $idCedenteColumna = $cedentesColumna[0]['Id_Cedente'].",".$idCedente; 
            }
            $this->updateCedenteColumnas($idCedenteColumna,$idCampo);  
            }
        }

        /*
            *** Muestra los cedentes correspondientes a una tabla
        */ 

        public function GetCedentesTabla($idTabla){
            $db = new Db(); 
            $Sql = "select Id_Cedente from SIS_Tablas where id = '$idTabla'";
            $cedentes = $db -> select($Sql);
            return $cedentes;
        }

        /*
            *** Muestra los cedentes correspondientes a un campo
        */ 

        public function GetCedentesColumna($idColumna){
            $db = new Db(); 
            $Sql = "select Id_Cedente from SIS_Columnas_Estrategias where id = '".$idColumna."'";
            $cedentes = $db -> select($Sql);
            return $cedentes;
        }

        /*
            *** Muestra id_columna correspondiente a un campo
        */ 

        public function GetIdColumna($idTabla){
            $db = new Db(); 
            $Sql = "select id from SIS_Columnas_Estrategias where id_tabla = '".$idTabla."'";
            $idColumna = $db -> select($Sql);
            return $idColumna;
        }

        /*
        ** Actualiza los cedentes de una columna
        */

        public function updateCedenteColumnas($cedentesColumna,$Idcolumna){
            $db = new Db();
            $ToReturn = false;
            $SqlColumnas = "Update SIS_Columnas_Estrategias Set Id_Cedente = '".$cedentesColumna."' Where id='".$Idcolumna."'";
            $updateTabla = $db->query($SqlColumnas); 
            if($updateTabla !== false){
                $ToReturn = true;
            }else{
                $ToReturn = false;
            }
            return $ToReturn; 
        }

        /*
        ** Actualiza los cedentes de una tabla
        */

        public function updateCedenteTabla($cedentesTabla,$idTabla){
            $db = new Db(); 
            $ToReturn = false;
            $SqlTabla = "Update SIS_Tablas Set Id_Cedente = '".$cedentesTabla."' Where id='".$idTabla."'";
            $updateTabla = $db -> query($SqlTabla);
            if($updateTabla !== false){
                $ToReturn = true;
            }else{
                $ToReturn = false;
            }
            return $ToReturn; 
        }

        /*
        ** Logica para actualizar los cedentes de los campos y tabla
        */
        public function eliminarTablaCedente($idCedente, $idTabla){      
            // me voy a tabla y saco el id_cedente          
            $cedentesTabla = $this->updateStringCedentes($this->GetCedentesTabla($idTabla),$idCedente);
            $this->updateCedenteTabla($cedentesTabla,$idTabla);
            // lo mismo para campos saco el id_cedente y lo actualizo

            // Busco todos los campos de la tabla en cuestion y por cada campo busco cedentes y actualizo
            $idColumnas = $this->GetIdColumna($idTabla);
            foreach($idColumnas as $columna){
                $cedentesColumna = $this->updateStringCedentes($this->GetCedentesColumna($columna['id']),$idCedente);
                $this->updateCedenteColumnas($cedentesColumna,$columna['id']);            
            }          
        }

        /*
        ** Convierte string cedentes en array y elimina el cedente en cuestion
        ** y retorna el string actualizado (sin el cedente) 
        */

        public function updateStringCedentes($cedentes, $idCedente){
            $arrCedentes = explode(",", $cedentes[0]['Id_Cedente']);
            $key = array_search($idCedente,$arrCedentes,TRUE);
            unset($arrCedentes[$key]);
            $cedentesUpdate = implode(",", $arrCedentes);
            return $cedentesUpdate;
        }
        function getOptionsFromTablesWithSelectedID($table){
            $db = new Db(); 
            $TablasArray = array();
            $Sql = "select * from SIS_Tablas where id='".$table."' order by nombre";
            $Tables = $db -> select($Sql);
            foreach($Tables as $Table){
                $Array = array();
                $Array['nombre'] = utf8_encode($Table["nombre"]);
                $Array['id_tabla'] = $Table["id"];
                array_push($TablasArray,$Array);
            }
            return $TablasArray;
        }
        function getOptionsFromColumnsWithSelectedID($table){
            $db = new Db(); 
            $Sql = "select * from SIS_Columnas_Estrategias where id_tabla='".$table."' order by columna";
            $Columnas = $db -> select($Sql);
            return $Columnas;
        }
    }
?>