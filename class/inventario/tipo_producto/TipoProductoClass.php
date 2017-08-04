<?php

    include('../../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class TipoProducto{

    	public function CrearTipoProducto($Nombre,$Descripcion){

            $response_array = array();

            $Nombre = isset($Nombre) ? trim($Nombre) : "";
            $Descripcion = isset($Descripcion) ? trim($Descripcion) : "";

            if(!empty($Nombre) && !empty($Descripcion)){

                $this->Nombre=$Nombre;
                $this->Descripcion=$Descripcion;

                $query = "INSERT INTO mantenedor_tipo_producto(nombre, descripcion) VALUES ('$this->Nombre','$this->Descripcion')";
                $run = new Method;
                $id = $run->insert($query);

                if($id){

                    $array = array('id'=> $id, 'nombre' => $this->Nombre, 'descripcion' => $this->Descripcion);

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


        function updateTipoProducto($Nombre, $Descripcion, $Id){

            $response_array = array();

            $Nombre = isset($Nombre) ? trim($Nombre) : "";
            $Descripcion = isset($Descripcion) ? trim($Descripcion) : "";

            if(!empty($Nombre) && !empty($Descripcion)){

                $this->Id=$Id;
                $this->Nombre=$Nombre;
                $this->Descripcion=$Descripcion;

                $query = "UPDATE `mantenedor_tipo_producto` set `nombre` = '$this->Nombre', `descripcion` = '$this->Descripcion' where `id` = '$this->Id'";
                $run = new Method;
                $data = $run->update($query);

                if($data){

                    $array = array('nombre' => $this->Nombre,'descripcion' => $this->Descripcion, 'id' => $this->Id);

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

        function deleteTipoProducto($Id){

            $response_array = array();

            $Id = isset($Id) ? trim($Id) : "";

            if(!empty($Id)){

                $this->Id=$Id;

                $query = "SELECT * from `mantenedor_marca_producto` where `tipo_producto_id` = '$this->Id'";
                $run = new Method;
                $data = $run->select($query);

                if(!$data){

                    $query = "DELETE from `mantenedor_tipo_producto` where `id` = '$this->Id'";
                    $run = new Method;
                    $data = $run->delete($query);
                    $response_array['status'] = 1; 
                    
                }else{
                    $response_array['status'] = 3; 
                }
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);
        }

        function showTipoProducto(){

            $query = 'SELECT * FROM mantenedor_tipo_producto';
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

    }

?>
