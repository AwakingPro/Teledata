<?php

    include('../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class ClaseCliente{

    	public function storeClase($Nombre, $LimiteFacturas){

            $response_array = array();

            $Nombre = isset($Nombre) ? trim($Nombre) : "";
            $LimiteFacturas = $LimiteFacturas ? trim($LimiteFacturas) : "0";

            if(!empty($Nombre)){

                $this->Nombre=$Nombre;
                $this->LimiteFacturas=$LimiteFacturas;

                $query = "INSERT INTO clase_clientes(nombre, limite_facturas) VALUES ('$this->Nombre','$this->LimiteFacturas')";
                $run = new Method;
                $id = $run->insert($query);

                if($id){

                    $array = array('id'=> $id, 'nombre' => $this->Nombre, 'limite_facturas' => $this->LimiteFacturas);

                    $response_array['array'] = $array;
                    $response_array['status'] = 1; 
                }else{
                    $response_array['status'] = 0; 
                }
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);

    	} 


        function updateClase($Nombre, $LimiteFacturas, $Id){

            $response_array = array();

            $Nombre = isset($Nombre) ? trim($Nombre) : "";
            $LimiteFacturas = $LimiteFacturas ? trim($LimiteFacturas) : "0";
            $Id = isset($Id) ? trim($Id) : "";

            if(!empty($Nombre) && !empty($Id)){

                $this->Nombre=$Nombre;
                $this->LimiteFacturas=$LimiteFacturas;
                $this->Id=$Id;

                $query = "UPDATE `clase_clientes` set `nombre` = '$this->Nombre', `limite_facturas` = '$this->LimiteFacturas' where `id` = '$this->Id'";
                $run = new Method;
                $data = $run->update($query);

                if($data){

                    $array = array('nombre' => $this->Nombre, 'limite_facturas' => $this->LimiteFacturas, 'id' => $this->Id);

                    $response_array['array'] = $array;
                    $response_array['status'] = 1; 

                }else{
                    $response_array['status'] = 0; 
                }
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);
        }

        function deleteClase($Id){

            $response_array = array();

            $Id = isset($Id) ? trim($Id) : "";

            if(!empty($Id)){

                $this->Id=$Id;

                $query = "DELETE from `clase_clientes` where `id` = '$this->Id'";
                $run = new Method;
                $data = $run->delete($query);
                $response_array['status'] = 1; 
              
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);
        }

        function showClase(){

            $query = "SELECT * from clase_clientes";
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }
    }

?>