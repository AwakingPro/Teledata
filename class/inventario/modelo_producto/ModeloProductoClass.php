<?php

    include('../../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class ModeloProducto{

    	public function CrearModeloProducto($MarcaProducto,$Nombre,$Descripcion){

            $response_array = array();

            $MarcaProducto = isset($MarcaProducto) ? trim($MarcaProducto) : "";
            $Nombre = isset($Nombre) ? trim($Nombre) : "";
            $Descripcion = isset($Descripcion) ? trim($Descripcion) : "";

            if(!empty($MarcaProducto) && !empty($Nombre) && !empty($Descripcion)){

                $this->MarcaProducto=$MarcaProducto;
                $this->Nombre=$Nombre;
                $this->Descripcion=$Descripcion;

                $query = "INSERT INTO mantenedor_modelo_producto(marca_producto_id, nombre, descripcion) VALUES ('$this->MarcaProducto','$this->Nombre','$this->Descripcion')";
                $run = new Method;
                $data = $run->insert($query);

                // if($data){

                    $array = array('marca_producto_id' => $this->MarcaProducto, 'nombre' => $this->Nombre, 'descripcion' => $this->Descripcion);

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


        function updateModeloProducto($MarcaProducto, $Nombre, $Descripcion, $Id){

            $response_array = array();

            $MarcaProducto = isset($MarcaProducto) ? trim($MarcaProducto) : "";
            $Nombre = isset($Nombre) ? trim($Nombre) : "";
            $Descripcion = isset($Descripcion) ? trim($Descripcion) : "";

            if(!empty($MarcaProducto) && !empty($Nombre) && !empty($Descripcion)){

                $this->Id=$Id;
                $this->MarcaProducto=$MarcaProducto;
                $this->Nombre=$Nombre;
                $this->Descripcion=$Descripcion;

                $query = "UPDATE `mantenedor_modelo_producto` set `marca_producto_id` = '$this->MarcaProducto', `nombre` = '$this->Nombre', `descripcion` = '$this->Descripcion' where `id` = '$this->Id'";
                $run = new Method;
                $data = $run->insert($query);

                // if($Query){

                    $array = array('marca_producto_id' => $this->MarcaProducto,'nombre' => $this->Nombre,'descripcion' => $this->Descripcion, 'id' => $this->Id);

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

        function showModeloProducto(){

            $query = 'SELECT mantenedor_modelo_producto.*, mantenedor_marca_producto.nombre as marca FROM mantenedor_modelo_producto INNER JOIN mantenedor_marca_producto ON mantenedor_modelo_producto.marca_producto_id = mantenedor_marca_producto.id';
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function showMarcaProducto(){

            $query = 'SELECT * FROM mantenedor_marca_producto';
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

    }

?>
