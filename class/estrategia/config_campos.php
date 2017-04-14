<?php
    class configCampos
    {
      /*
       *** Lista todas las tablas 
      */  
      public function getListar_tablas(){
            $db = new Db();
            $TablasArray = array();
            $SqlTablas = "select * from SIS_Tablas";
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
       *** Lista todos los campos configurados de una tabla 
       */ 
      public function getListar_camposConfig($idTabla){
            $db = new Db();
            $TablasArray = array();
            $SqlTablas = "select * from SIS_Columnas_Estrategias where id_tabla = '".$idTabla."' order by columna desc";
		    $Tablas = $db -> select($SqlTablas);
            foreach($Tablas as $Tabla){
                $Array = array();
                $Array['nombre'] = $Tabla["columna"];
                //$Array['tipo'] = $Tabla["tipo"];
                $Array['tipo_dato'] = $Tabla["tipo_dato"];
                $Array['orden'] = $Tabla["orden"];
                $Array['logica'] = $Tabla["logica"];
                //$Array['relacion'] = $Tabla["relacion"];
                //$Array['nulo'] = $Tabla["nulo"];    
                $Array['Actions'] = $Tabla["id"];
                array_push($TablasArray,$Array);
            }
            return $TablasArray;
       }

        /*
       *** Elimina un campo configurado
       */ 

       // ojoooooo en el JS verifico si el campo a eliminar ya esta guardado en bd por ejemplo: si tiene id 
       // mando a eliminar desde BD, si no tiene id solo mando a remover la fila por q aun no esta guardado 

       public function insertarModificarCampos($campos,$idtabla){
            $db = new Db();
            foreach($campos as $campo){
                print_r($campo);
                $idCampo = $campo[4];
                 print_r($idCampo);
                if ($idCampo == ""){ // no esta en bd
                    //$this->insertarCamposConfig($campos,$idtabla);    
                    echo "hola";
                }else{
                    $this->actualizaCamposConfig($campos);                    
                }

            }


        }

       public function eliminarCampoConfig($idCampo){
            $db = new Db();
            $ToReturn = false;
            $SqlEliminarCampo = "delete from SIS_Columnas_Estrategias where id = ".$idCampo;
            $DeleteCampo = $db -> query($SqlEliminarCampo);
            if($DeleteCampo !== false){
                $ToReturn = true;
            }else{
                $ToReturn = false;
            }
            return $ToReturn;
        }

       /*
       *** Inserta nuevos campos configurados
       */ 
       // OJOOOOO los que no estan insertados son aquellos que no tienen id en el boton eliminar

        public function insertarCamposConfig($campos, $idtabla){
            $db = new Db();
            foreach($campos as $campo){
                $columna = $campo[0];
                $id_tabla = $idtabla;
                $tipo_dato = $campo[1];
                $orden = $campo[2];
                $logica = $campo[3];
                // SIN COMILLA = 0 --- CON COMILLA = 1 tipo
                if ($tipo_dato == 0)
                {
                   $tipo = 0;  
                }else
                {
                   $tipo = 1;
                }
                $idCampo = $campo[4];
                if ($idCampo == ""){ // no esta en bd
                  $SqlInsertCampo = "insert into SIS_Columnas_Estrategias (columna, id_tabla, tipo, tipo_dato, orden, logica) values('".$columna."', '".$id_tabla."', '".$tipo."','".$tipo_dato."','".$orden."','".$logica."')";
                  $InsertCampo = $db -> query($SqlInsertCampo);
                }else{
                  $SqlUpdateCampo = "update SIS_Columnas_Estrategias set columna = '".$columna."', tipo = '".$tipo."', tipo_dato = '".$tipo_dato."', orden = '".$orden."', logica = '".$logica."' where id='".$idCampo."' ";
                  $UpdateCampo = $db -> query($SqlUpdateCampo);                
                }
                
            }

        }

       /*
       *** Update campos configurados
       */ 

        public function actualizaCamposConfig($campos){
            $db = new Db();
            foreach($campos as $campo){
               
                $columna = $campo[0];
                $tipo_dato = $campo[1];
                $orden = $campo[2];
                $logica = $campo[3];
                $id_campo = $campo[4];
                 echo "actualiza".$columna;
                $tipo=0; // ojoooooooooooooooooooooooooo
                $SqlUpdateCampo = "update SIS_Columnas_Estrategias set columna = '".$columna."', tipo = '".$tipo."', tipo_dato = '".$tipo_dato."', orden = '".$orden."', logica = '".$logica."' where id='".$id_campo."' ";
                $UpdateCampo = $db -> query($SqlUpdateCampo);
            }
        }

        /*
       *** Lista todos los campos no configurados de una tabla 
       *** 
       */ 
       function getListar_camposNoConfig($nombreTabla,$camposArray){
            $db = new Db();
            $SqlCampos = "describe ".$nombreTabla;
		    $camposTabla = $db -> select($SqlCampos);

            if (count($camposTabla) == count($camposArray))
            {
              // la tabla ya no tiene mas campos para configurar
            }else{
              $i = 0;
              foreach($camposTabla as $campo){ // campos de la tabla
               $campoYaConfigurado = 0; // no configurado
               foreach($camposArray as $campoConfig){ // campos que ya estan configurados       
                 if (($campo["Field"]) == ($campoConfig)){
                   $campoYaConfigurado = 1; // si configurado
                 }
               }
               if ($campoYaConfigurado == 0)
               {
                 // campos a listar en el combo
                 $arrayListCampos[$i] = $campo["Field"];
                 $i = $i + 1; 
               } 
              } // fin primer for
            } // fin else

            return $arrayListCampos;
       }


      /*public function getListar_camposNoConfig($idTabla){
            $db = new Db();
            // busco todos los campos de una tabla
            // los busco en sis_colu osea campos configurados
            // y los que no esten los muestro osea es lo que devuelve este metodo


            $TablasArray = array();
            $SqlTablas = "select * from SIS_Columnas_Estrategias where id_tabla = '".$idTabla."'";
		    $Tablas = $db -> select($SqlTablas);
            foreach($Tablas as $Tabla){
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
            }
            return $TablasArray;
       } */


    }   

?>