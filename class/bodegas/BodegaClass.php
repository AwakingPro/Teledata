<?php

    include('../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class Bodega{

    	public function CrearBodega($Nombre,$Direccion){

            $response_array = array();

            $Nombre = isset($Nombre) ? trim($Nombre) : "";
            $Direccion = isset($Direccion) ? trim($Direccion) : "";

            if(!empty($Nombre) && !empty($Direccion)){

                $this->Nombre=$Nombre;
                $this->Direccion=$Direccion;

                $query = "INSERT INTO mantenedor_bodegas(nombre, direccion) VALUES ('$this->Nombre','$this->Direccion')";
                $run = new Method;
                $data = $run->insert($query);

                // if($data){

                    $array = array('nombre' => $this->Nombre,'direccion' => $this->Direccion);

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


        function updateBodega($Nombre,$Direccion, $Id){

            $response_array = array();

            $Nombre = isset($Nombre) ? trim($Nombre) : "";
            $Direccion = isset($Direccion) ? trim($Direccion) : "";

            if(!empty($Nombre) && !empty($Direccion)){

                $this->Id=$Id;
                $this->Nombre=$Nombre;
                $this->Direccion=$Direccion;


                $query = "UPDATE `mantenedor_bodegas` set `nombre` = '$this->Nombre', `direccion` = '$this->Direccion' where `id` = '$this->Id'";
                $run = new Method;
                $data = $run->insert($query);

                // if($Query){

                    $array = array('nombre' => $this->Nombre,'direccion' => $this->Direccion, 'id' => $this->Id);

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
