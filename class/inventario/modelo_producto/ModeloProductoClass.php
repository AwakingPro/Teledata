<?php

    include('../../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class ModeloProducto{

    	public function CrearModeloProducto($MarcaProducto, $nombreMarca, $Nombre,$Descripcion){

            $response_array = array();
            $nombreMarca = isset($nombreMarca) ? trim($nombreMarca) : "";
            $MarcaProducto = isset($MarcaProducto) ? trim($MarcaProducto) : "";
            $Nombre = isset($Nombre) ? trim($Nombre) : "";
            $Descripcion = isset($Descripcion) ? trim($Descripcion) : "";

            if(!empty($MarcaProducto) && !empty($Nombre) && !empty($Descripcion)){

                $this->MarcaProducto=$MarcaProducto;
                $this->Nombre=$Nombre;
                $this->Descripcion=$Descripcion;

                $query = "INSERT INTO mantenedor_modelo_producto(marca_producto_id, nombre, descripcion) VALUES ('$this->MarcaProducto','$this->Nombre','$this->Descripcion')";
                $run = new Method;
                $id = $run->insert($query);

                if($id){

                    $array = array('id'=> $id, 'marca_producto_id' => $nombreMarca, 'nombre' => $this->Nombre, 'descripcion' => $this->Descripcion);

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
                $data = $run->update($query);

                if($data){

                    $array = array('marca_producto_id' => $this->MarcaProducto,'nombre' => $this->Nombre,'descripcion' => $this->Descripcion, 'id' => $this->Id);

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

        function deleteModeloProducto($Id){

            $response_array = array();

            $Id = isset($Id) ? trim($Id) : "";

            if(!empty($Id)){

                $this->Id=$Id;

                $query = "SELECT * from `inventario_ingresos` where `modelo_producto_id` = '$this->Id'";
                $run = new Method;
                $data = $run->select($query);

                if(!$data){

                    $query = "DELETE from `mantenedor_modelo_producto` where `id` = '$this->Id'";
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
