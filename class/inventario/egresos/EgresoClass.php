<?php

    $str = $_SERVER['SCRIPT_NAME'];
    $where = substr($str, strrpos($str, '/') + 1);

    if($where != 'insertArriendoEquipos.php'){
        include('../../../class/methods_global/methods.php'); 
    }else{
        include('../../class/methods_global/methods.php'); 
    }
    
    header('Content-type: application/json');

    class Egreso{

    	public function storeMovimiento($ProductoId,$DestinoTipo,$DestinoId){

            $str = $_SERVER['SCRIPT_NAME'];
            $where = substr($str, strrpos($str, '/') + 1);

            $response_array = array();

            $ProductoId = isset($ProductoId) ? trim($ProductoId) : "";
            $DestinoTipo = isset($DestinoTipo) ? trim($DestinoTipo) : "";
            $DestinoId = isset($DestinoId) ? trim($DestinoId) : "";

            if(!empty($ProductoId) && !empty($DestinoTipo) && !empty($DestinoId)){

                $query = "SELECT * FROM inventario_ingresos WHERE ID = '$ProductoId'";
                $run = new Method;
                $Producto = $run->select($query);

                if($Producto){

                    if($Producto[0]['bodega_tipo'] != 3){
                        $Acceso = 1;
                    }else{

                        $query = "SELECT * from `radio_ingresos` where `producto_id` = '$ProductoId'";
                        $run = new Method;
                        $Radio = $run->select($query);

                        if(!$Radio){
                            $Acceso = 1;
                        }else{
                            $Acceso = 0;
                        }
                    }

                    if($Acceso){

                        session_start();

                        $Usuario=$_SESSION['idUsuario'];
                        $DateTime = new DateTime();
                        $FechaMovimiento = $DateTime->format('Y-m-d');
                        $HoraMovimiento = $DateTime->format('H:i:s');

                        $query = "INSERT INTO inventario_egresos(destino_tipo, destino_id, fecha_movimiento, hora_movimiento, usuario_id, producto_id) VALUES ('$DestinoTipo','$DestinoId','$FechaMovimiento','$HoraMovimiento','$Usuario','$ProductoId')";

                        $run = new Method;
                        $id = $run->insert($query);

                        if($id){

                            $query = "UPDATE inventario_ingresos SET bodega_tipo = '$DestinoTipo', bodega_id = '$DestinoId' where id = '$ProductoId'";

                            $run = new Method;
                            $update = $run->update($query);

                            if($update){

                                $query = "SELECT inventario_ingresos.*, mantenedor_modelo_producto.nombre as modelo, mantenedor_marca_producto.nombre as marca, mantenedor_tipo_producto.nombre as tipo FROM inventario_ingresos INNER JOIN mantenedor_modelo_producto ON inventario_ingresos.modelo_producto_id = mantenedor_modelo_producto.id INNER JOIN mantenedor_marca_producto ON mantenedor_modelo_producto.marca_producto_id = mantenedor_marca_producto.id INNER JOIN mantenedor_tipo_producto ON mantenedor_marca_producto.tipo_producto_id = mantenedor_tipo_producto.id where inventario_ingresos.id = '$ProductoId' AND bodega_tipo = '$DestinoTipo'AND bodega_id = '$DestinoId' ORDER BY inventario_ingresos.id DESC LIMIT 1";

                                $run = new Method;
                                $data = $run->select($query);

                                if($data){

                                    $NumeroSerie = $data[0]['numero_serie'];
                                    $Producto = $data[0]['tipo'] . ' ' . $data[0]['marca'] . ' ' . $data[0]['modelo'];

                                    if($data[0]['bodega_tipo'] == 1){
                                        $query = "SELECT * FROM mantenedor_bodegas where id = ".$data[0]['bodega_id']." ORDER BY id DESC LIMIT 1";
                                        $run = new Method;
                                        $select = $run->select($query);
                                    }else if($data[0]['bodega_tipo'] == 2){
                                        $query = "SELECT Codigo AS nombre, id FROM servicios where id = ".$data[0]['bodega_id']." ORDER BY id DESC LIMIT 1";
                                        $run = new Method;
                                        $select = $run->select($query);
                                    }else{
                                        $query = "SELECT * FROM mantenedor_site where id = ".$data[0]['bodega_id']." ORDER BY id DESC LIMIT 1";
                                        $run = new Method;
                                        $select = $run->select($query);
                                    }

                                    if($select){
                                        $Destino = $select[0]['nombre'];
                                    }else{
                                        $Destino = '';
                                    }

                                    $query = "SELECT * FROM usuarios where id = '$Usuario' ORDER BY id DESC LIMIT 1";
                                    $run = new Method;
                                    $usuario = $run->select($query);

                                    if($usuario){

                                        $Responsable = $usuario[0]['nombre'];

                                        $array = array('id' => $id, 'numero_serie' => $NumeroSerie, 'producto' => $Producto, 'destino' => $Destino, 'fecha_movimiento' => $FechaMovimiento, 'hora_movimiento' => $HoraMovimiento, 'responsable' => $Responsable);

                                        if($where != 'insertArriendoEquipos.php'){
                                            $response_array['array'] = $array;
                                            $response_array['status'] = 1; 
                                        }else{
                                            $response_array = $id;
                                        }

                                    }else{
                                        $response_array['status'] = 0; 
                                        $response_array['error'] = 'Select Usuario'; 
                                    }

                                }else{
                                    $response_array['status'] = 0; 
                                    $response_array['error'] = 'Select Ingreso'; 
                                }
                            }else{
                                $response_array['status'] = 0; 
                                $response_array['error'] = 'Update Ingreso'; 
                            }
                        }else{
                            $response_array['status'] = 0; 
                            $response_array['error'] = 'Insert Egreso'; 
                        }
                    }else{
                        $response_array['status'] = 10; 
                        $response_array['error'] = 'Select Radio'; 
                    }
                }else{
                    $response_array['status'] = 0; 
                    $response_array['error'] = 'Select Producto'; 
                }
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);

    	} 

        function showMovimientos(){

            $array = array();

            $query = "SELECT inventario_egresos.*, inventario_ingresos.numero_serie, mantenedor_modelo_producto.nombre as modelo, mantenedor_marca_producto.nombre as marca, mantenedor_tipo_producto.nombre as tipo, usuarios.nombre as responsable FROM inventario_egresos INNER JOIN inventario_ingresos ON inventario_egresos.producto_id = inventario_ingresos.id INNER JOIN mantenedor_modelo_producto ON inventario_ingresos.modelo_producto_id = mantenedor_modelo_producto.id INNER JOIN mantenedor_marca_producto ON mantenedor_modelo_producto.marca_producto_id = mantenedor_marca_producto.id INNER JOIN mantenedor_tipo_producto ON mantenedor_marca_producto.tipo_producto_id = mantenedor_tipo_producto.id INNER JOIN usuarios ON inventario_egresos.usuario_id = usuarios.id";

            $run = new Method;
            $data = $run->select($query);

            foreach($data as $row){
                if($row['destino_tipo'] == 1){
                    $query = "SELECT * FROM mantenedor_bodegas where id = ".$row['destino_id']." ORDER BY id DESC LIMIT 1";
                    $run = new Method;
                    $destino = $run->select($query);
                }else if($row['destino_tipo'] == 2){
                    $query = "SELECT Codigo as nombre FROM servicios where id = ".$row['destino_id']." ORDER BY id DESC LIMIT 1";
                    $run = new Method;
                    $destino = $run->select($query);
                }else{
                    $query = "SELECT * FROM mantenedor_site where id = ".$row['destino_id']." ORDER BY id DESC LIMIT 1";
                    $run = new Method;
                    $destino = $run->select($query);
                }

                if($destino){
                    $destino_nombre = $destino[0]['nombre'];
                }else{
                    $destino_nombre = '';
                }

                $array[$row['id']] = array('id' => $row['id'], 'numero_serie' => $row['numero_serie'], 'modelo' => $row['modelo'], 'marca' => $row['marca'], 'tipo' => $row['tipo'], 'destino' => $destino_nombre,'fecha_movimiento' => $row['fecha_movimiento'],'hora_movimiento' => $row['hora_movimiento'],'responsable' => $row['responsable']);
            }

            $response_array['array'] = $array;

            echo json_encode($response_array);

        }

        function getProducto($BodegaTipo, $BodegaId){

            if(!$BodegaId && $BodegaTipo == 1){
                $BodegaTipo = 0;
            }

            $query = "  SELECT inventario_ingresos.*, mantenedor_modelo_producto.nombre as modelo, 
                                mantenedor_marca_producto.nombre as marca, 
                                mantenedor_tipo_producto.nombre as tipo 
                        FROM inventario_ingresos 
                        INNER JOIN mantenedor_modelo_producto ON inventario_ingresos.modelo_producto_id = mantenedor_modelo_producto.id 
                        INNER JOIN mantenedor_marca_producto ON mantenedor_modelo_producto.marca_producto_id = mantenedor_marca_producto.id 
                        INNER JOIN mantenedor_tipo_producto ON mantenedor_marca_producto.tipo_producto_id = mantenedor_tipo_producto.id 
                        WHERE inventario_ingresos.bodega_tipo = '$BodegaTipo' AND inventario_ingresos.bodega_id = '$BodegaId'";

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

            $query = 'SELECT * FROM mantenedor_bodegas where principal = 1';
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function showPersonaEmpresa(){

            $query = '  SELECT servicios.id, servicios.Codigo, personaempresa.nombre as cliente
                        FROM servicios 
                        INNER JOIN personaempresa ON servicios.Rut = personaempresa.rut';
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function showEstaciones(){

            $query = 'SELECT * FROM mantenedor_site';
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

    }

?>
