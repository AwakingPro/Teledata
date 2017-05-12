<?php

    include('../../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class Egreso{

    	public function storeMovimiento($ProductoId,$OrigenTipo,$OrigenId, $DestinoTipo,$DestinoId){

            $response_array = array();

            $ProductoId = isset($ProductoId) ? trim($ProductoId) : "";
            $OrigenTipo = isset($OrigenTipo) ? trim($OrigenTipo) : "";
            $OrigenId = isset($OrigenId) ? trim($OrigenId) : "";
            $DestinoTipo = isset($DestinoTipo) ? trim($DestinoTipo) : "";
            $DestinoId = isset($DestinoId) ? trim($DestinoId) : "";

            if(!empty($ProductoId) && !empty($OrigenTipo) && !empty($OrigenId) && !empty($DestinoTipo) && !empty($DestinoId)){

                session_start();

                $Usuario=$_SESSION['idUsuario'];
                $DateTime = new DateTime();
                $FechaMovimiento = $DateTime->format('Y-m-d');
                $HoraMovimiento = $DateTime->format('H:i:s');

                $query = "INSERT INTO inventario_egresos(destino_tipo, destino_id, fecha_movimiento, hora_movimiento, usuario_id, producto_id) VALUES ('$DestinoTipo','$DestinoId','$FechaMovimiento','$HoraMovimiento','$Usuario','$ProductoId')";

                $run = new Method;
                $id = $run->insert($query);

                if($id){

                    $query = "UPDATE inventario_ingresos set bodega_tipo = '$DestinoTipo', bodega_id = '$DestinoId' where modelo_producto_id = '$ProductoId' AND bodega_tipo = '$OrigenTipo' AND bodega_id = '$OrigenId'";

                    $run = new Method;
                    $update = $run->insert($query);

                    // if($update){

                        $query = "SELECT inventario_ingresos.*, mantenedor_modelo_producto.nombre as modelo, mantenedor_marca_producto.nombre as marca, mantenedor_tipo_producto.nombre as tipo FROM inventario_ingresos INNER JOIN mantenedor_modelo_producto ON inventario_ingresos.modelo_producto_id = mantenedor_modelo_producto.id INNER JOIN mantenedor_marca_producto ON mantenedor_modelo_producto.marca_producto_id = mantenedor_marca_producto.id INNER JOIN mantenedor_tipo_producto ON mantenedor_marca_producto.tipo_producto_id = mantenedor_tipo_producto.id where inventario_ingresos.id = '$ProductoId' ORDER BY inventario_ingresos.id DESC LIMIT 1";

                        $run = new Method;
                        $data = $run->select($query);

                        if($data){

                            $query = "SELECT * FROM usuarios where id = '$Usuario' ORDER BY id DESC LIMIT 1";
                            $run = new Method;
                            $usuario = $run->select($query);

                            $NumeroSerie = $data[0]['numero_serie'];

                            if($usuario){

                                $Responsable = $usuario[0]['nombre'];

                                $array = array('id' => $id, 'numero_serie' => $NumeroSerie, 'fecha_movimiento' => $FechaMovimiento, 'hora_movimiento' => $HoraMovimiento, 'responsable' => $Responsable);

                                $response_array['array'] = $array;
                                $response_array['status'] = 1; 

                            }else{
                                $response_array['status'] = 0; 
                                $response_array['error'] = 'Select Usuario'; 
                            }

                        }else{
                            $response_array['status'] = 0; 
                            $response_array['error'] = 'Select Ingreso'; 
                        }
                    // }else{
                    //     $response_array['status'] = 0; 
                    //     $response_array['error'] = 'Update Ingreso'; 
                    // }
                }else{
                    $response_array['status'] = 0; 
                    $response_array['error'] = 'Insert Egreso'; 
                }
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);

    	} 

        function showMovimientos(){

            $query = 'SELECT inventario_egresos.*, inventario_ingresos.numero_serie, mantenedor_modelo_producto.nombre as modelo, mantenedor_marca_producto.nombre as marca, mantenedor_tipo_producto.nombre as tipo, usuarios.nombre as responsable FROM inventario_ingresos INNER JOIN inventario_ingresos ON inventario_egresos.producto_id = inventario_ingresos.id INNER JOIN mantenedor_modelo_producto ON inventario_ingresos.modelo_producto_id = inventario_egresos.id INNER JOIN mantenedor_marca_producto ON mantenedor_modelo_producto.marca_producto_id = mantenedor_marca_producto.id INNER JOIN mantenedor_tipo_producto ON mantenedor_marca_producto.tipo_producto_id = mantenedor_tipo_producto.id INNER JOIN usuarios ON inventario_egresos.usuario_id = usuarios.id';

            $run = new Method;
            $data = $run->select($query);

            foreach($data as $row){
                if($row['destino_tipo'] == 1){
                    $query = 'SELECT * FROM mantenedor_bodegas where id = '.$row['destino_id'];
                    $run = new Method;
                    $destino = $run->select($query);

                    $row['destino_tipo'] = 'Bodega';
                    $row['destino_nombre'] = $destino['nombre'];
                }else{
                    $query = 'SELECT * FROM mantenedor_bodegas where id = '.$row['destino_id'];
                    $run = new Method;
                    $destino = $run->select($query);

                    $row['destino_tipo'] = 'Bodega';
                    $row['destino_nombre'] = $destino['nombre'];
                }
            }

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function getProducto($BodegaTipo, $BodegaId){

            $query = "SELECT inventario_ingresos.*, mantenedor_modelo_producto.nombre as modelo, mantenedor_marca_producto.nombre as marca, mantenedor_tipo_producto.nombre as tipo FROM inventario_ingresos INNER JOIN mantenedor_modelo_producto ON inventario_ingresos.modelo_producto_id = mantenedor_modelo_producto.id INNER JOIN mantenedor_marca_producto ON mantenedor_modelo_producto.marca_producto_id = mantenedor_marca_producto.id INNER JOIN mantenedor_tipo_producto ON mantenedor_marca_producto.tipo_producto_id = mantenedor_tipo_producto.id where inventario_ingresos.bodega_tipo = '$BodegaTipo' AND inventario_ingresos.bodega_id = '$BodegaId'";

            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function showProveedor(){

            $query = 'SELECT * FROM mantenedor_proveedores';
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function getBodega(){

            $query = 'SELECT * FROM mantenedor_bodegas';
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

    }

?>
