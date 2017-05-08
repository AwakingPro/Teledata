<?php

    include('../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class Bodega{

    	public function CrearBodega($Nombre,$Direccion,$Telefono,$Personal,$Correo){

            $response_array = array();

            $Nombre = isset($Nombre) ? trim($Nombre) : "";
            $Direccion = isset($Direccion) ? trim($Direccion) : "";
            $Telefono = isset($Telefono) ? trim($Telefono) : "";
            $Personal = isset($Personal) ? trim($Personal) : "";
            $Correo = isset($Correo) ? trim($Correo) : "";

            if(!empty($Nombre) && !empty($Direccion)  && !empty($Telefono)  && !empty($Personal) &&
                !empty($Correo)){

                $this->Nombre=$Nombre;
                $this->Direccion=$Direccion;
                $this->Telefono=$Telefono;
                $this->Personal=$Personal;
                $this->Correo=$Correo;

                $query = "INSERT INTO mantenedor_bodegas(nombre, direccion, telefono, personal_id, correo) VALUES ('$this->Nombre','$this->Direccion','$this->Telefono','$this->Personal','$this->Correo')";
                $run = new Method;
                $data = $run->insert($query);

                // if($data){

                    $array = array('nombre' => $this->Nombre,'direccion' => $this->Direccion,'telefono' => $this->Telefono, 'personal_id' => $this->Personal, 'correo' => $this->Correo);

                    $response_array['array'] = $array;
                    $response_array['status'] = 1; 
                // }else{
                //     $response_array['status'] = 0; 
                // }
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);

    	} 


        function updateBodega($Nombre,$Direccion,$Telefono,$Personal,$Correo, $Id){

            $response_array = array();

            $Nombre = isset($Nombre) ? trim($Nombre) : "";
            $Direccion = isset($Direccion) ? trim($Direccion) : "";
            $Telefono = isset($Telefono) ? trim($Telefono) : "";
            $Personal = isset($Personal) ? trim($Personal) : "";
            $Correo = isset($Correo) ? trim($Correo) : "";

            if(!empty($Nombre) && !empty($Direccion)  && !empty($Telefono)  && !empty($Personal) &&
                !empty($Correo)){

                $this->Id=$Id;
                $this->Nombre=$Nombre;
                $this->Direccion=$Direccion;
                $this->Telefono=$Telefono;
                $this->Personal=$Personal;
                $this->Correo=$Correo;

                $query = "UPDATE `mantenedor_bodegas` set `nombre` = '$this->Nombre', `direccion` = '$this->Direccion', `telefono` = '$this->Telefono', `personal_id` = '$this->Personal', `correo` = '$this->Correo' where `id` = '$this->Id'";
                $run = new Method;
                $data = $run->insert($query);

                // if($Query){

                    $array = array('nombre' => $this->Nombre,'direccion' => $this->Direccion,'telefono' => $this->Telefono, 'personal_id' => $this->Personal, 'correo' => $this->Correo, 'id' => $this->Id);

                    $response_array['array'] = $array;
                    $response_array['status'] = 1; 

                // }else{
                //     $response_array['status'] = 0; 
                // }
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);
        }

        function showBodegas(){

            $query = 'SELECT * FROM mantenedor_bodegas';
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }
    }

?>
