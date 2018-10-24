<?php

    include('../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class Descuento{
        function __construct () {
			$run = new Method;
        }
        
        function getDescuentos(){
            $run = new Method;
            $query = "  SELECT
                            descuentos.*,
                            servicios.Codigo,
                            personaempresa.nombre AS Cliente,
                            IFNULL(usuarios.nombre,'') AS Usuario 
                        FROM
                            descuentos
                            INNER JOIN personaempresa ON personaempresa.rut = descuentos.Rut
                            INNER JOIN servicios ON servicios.Id = descuentos.IdServicio
                            LEFT JOIN usuarios ON usuarios.id = descuentos.idUsuario";
            
            $data = $run->select($query);
            echo json_encode($data);

        }
        public function storeDescuento($Rut, $IdServicio, $Porcentaje, $Cantidad, $IdTicket){
            $run = new Method;
            $response_array = array();

            $Rut = isset($Rut) ? trim($Rut) : "";
            $IdServicio = isset($IdServicio) ? trim($IdServicio) : "";
            $Porcentaje = isset($Porcentaje) ? trim($Porcentaje) : "";
            $Cantidad = isset($Cantidad) ? trim($Cantidad) : "";
            $IdTicket = isset($IdTicket) ? trim($IdTicket) : "";

            if(!empty($Rut) && !empty($IdServicio) && !empty($Porcentaje) && !empty($Cantidad) && !empty($IdTicket)){

                if($Porcentaje > 100 OR $Porcentaje < 1){
                    $response_array['status'] = 3;
                    echo json_encode($response_array);
                    return;
                }
            
                $query = "INSERT INTO descuentos(Rut, IdServicio, Porcentaje, Cantidad, IdTicket, CantidadUtilizada, FechaCreacion) VALUES ('".$Rut."','".$IdServicio."','".$Porcentaje."','".$Cantidad."','".$IdTicket."', 0, NOW())";
                
                $id = $run->insert($query);

                if($id){
                    $response_array['status'] = 1; 
                }else{
                    $response_array['status'] = 0; 
                }
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);

        } 
        
        function aprobarDescuento($Id){
            $run = new Method;
            $response_array = array();

            $Id = isset($Id) ? trim($Id) : "";

            if(!empty($Id)){
                
                $idUsuario = $_SESSION['idUsuario'];
                $query = "UPDATE `descuentos` SET `idUsuario` = '".$idUsuario."', FechaAprobacion = NOW() WHERE `id` = '".$Id."'";
                
                $data = $run->update($query);

                if($data){
                    $response_array['status'] = 1; 
                }else{
                    $response_array['status'] = 0; 
                }
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);
        }

        function deleteDescuento($Id){
            $run = new Method;
            $response_array = array();

            $Id = isset($Id) ? trim($Id) : "";

            if(!empty($Id)){
                $query = "DELETE FROM `descuentos` WHERE `id` = '".$Id."'";
                
                $data = $run->delete($query);

                if($data){
                    $response_array['status'] = 1; 
                }else{
                    $response_array['status'] = 0; 
                }
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);
        }
    }
?>