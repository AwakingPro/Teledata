<?php

    include('../../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class MarcaProducto{

    	public function CrearMarcaProducto($TipoProducto,$Nombre,$Descripcion){

            $response_array = array();

            $TipoProducto = isset($TipoProducto) ? trim($TipoProducto) : "";
            $Nombre = isset($Nombre) ? trim($Nombre) : "";
            $Descripcion = isset($Descripcion) ? trim($Descripcion) : "";

            if(!empty($TipoProducto) && !empty($Nombre) && !empty($Descripcion)){

                $this->TipoProducto=$TipoProducto;
                $this->Nombre=$Nombre;
                $this->Descripcion=$Descripcion;

                $query = "INSERT INTO mantenedor_marca_producto(tipo_producto_id, nombre, descripcion) VALUES ('$this->TipoProducto','$this->Nombre','$this->Descripcion')";
                $run = new Method;
                $id = $run->insert($query);

                if($id){

                    $array = array('id'=> $id, 'tipo_producto_id' => $this->TipoProducto, 'nombre' => $this->Nombre, 'descripcion' => $this->Descripcion);

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


        function updateMarcaProducto($TipoProducto, $Nombre, $Descripcion, $Id){

            $response_array = array();

            $TipoProducto = isset($TipoProducto) ? trim($TipoProducto) : "";
            $Nombre = isset($Nombre) ? trim($Nombre) : "";
            $Descripcion = isset($Descripcion) ? trim($Descripcion) : "";

            if(!empty($TipoProducto) && !empty($Nombre) && !empty($Descripcion)){

                $this->Id=$Id;
                $this->TipoProducto=$TipoProducto;
                $this->Nombre=$Nombre;
                $this->Descripcion=$Descripcion;

                $query = "UPDATE `mantenedor_marca_producto` set `tipo_producto_id` = '$this->TipoProducto', `nombre` = '$this->Nombre', `descripcion` = '$this->Descripcion' where `id` = '$this->Id'";
                $run = new Method;
                $data = $run->insert($query);

                // if($Query){

                    $array = array('tipo_producto_id' => $this->TipoProducto,'nombre' => $this->Nombre,'descripcion' => $this->Descripcion, 'id' => $this->Id);

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

        function deleteMarcaProducto($Id){

            $response_array = array();

            $Id = isset($Id) ? trim($Id) : "";

            if(!empty($Id)){

                $this->Id=$Id;

                $query = "SELECT * from `mantenedor_modelo_producto` where `marca_producto_id` = '$this->Id'";
                $run = new Method;
                $data = $run->select($query);

                if(!$data){

                    $query = "DELETE from `mantenedor_marca_producto` where `id` = '$this->Id'";
                    $run = new Method;
                    $data = $run->insert($query);
                    $response_array['status'] = 1; 
                    
                }else{
                    $response_array['status'] = 3; 
                }
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);
        }

        function showMarcaProducto(){

            $query = 'SELECT mantenedor_marca_producto.*, mantenedor_tipo_producto.nombre as tipo FROM mantenedor_marca_producto INNER JOIN mantenedor_tipo_producto ON mantenedor_marca_producto.tipo_producto_id = mantenedor_tipo_producto.id';
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

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
