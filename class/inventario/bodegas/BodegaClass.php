<?php

    include('../../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class Bodega{

    	public function CrearBodega($Nombre,$Principal,$Direccion,$Telefono,$Personal,$Correo){

            $response_array = array();

            $Nombre = isset($Nombre) ? trim($Nombre) : "";
            $Principal = isset($Principal) ? trim($Principal) : "";
            $Direccion = isset($Direccion) ? trim($Direccion) : "";
            $Telefono = isset($Telefono) ? trim($Telefono) : "";
            $Personal = isset($Personal) ? trim($Personal) : "";
            $Correo = isset($Correo) ? trim($Correo) : "";

            if(!empty($Nombre) && !empty($Direccion)  && !empty($Telefono)  && !empty($Personal) &&
                !empty($Correo)){

                $this->Nombre=$Nombre;
                $this->Principal=$Principal;
                $this->Direccion=$Direccion;
                $this->Telefono=$Telefono;
                $this->Personal=$Personal;
                $this->Correo=$Correo;

                $query = "INSERT INTO mantenedor_bodegas(nombre, principal, direccion, telefono, personal_id, correo) VALUES ('$this->Nombre','$this->Principal','$this->Direccion','$this->Telefono','$this->Personal','$this->Correo')";
                $run = new Method;
                $id = $run->insert($query);

                if($id){

                    $array = array('id'=> $id, 'nombre' => $this->Nombre,'principal' => $this->Principal,'direccion' => $this->Direccion,'telefono' => $this->Telefono, 'personal_id' => $this->Personal, 'correo' => $this->Correo);

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


        function updateBodega($Nombre,$Principal,$Direccion,$Telefono,$Personal,$Correo, $Id){

            $response_array = array();

            $Nombre = isset($Nombre) ? trim($Nombre) : "";
            $Principal = isset($Principal) ? trim($Principal) : "";
            $Direccion = isset($Direccion) ? trim($Direccion) : "";
            $Telefono = isset($Telefono) ? trim($Telefono) : "";
            $Personal = isset($Personal) ? trim($Personal) : "";
            $Correo = isset($Correo) ? trim($Correo) : "";

            if(!empty($Nombre) && !empty($Direccion)  && !empty($Telefono)  && !empty($Personal) &&
                !empty($Correo)){

                $this->Id=$Id;
                $this->Nombre=$Nombre;
                $this->Principal=$Principal;
                $this->Direccion=$Direccion;
                $this->Telefono=$Telefono;
                $this->Personal=$Personal;
                $this->Correo=$Correo;

                $query = "UPDATE `mantenedor_bodegas` set `nombre` = '$this->Nombre', `principal` = '$this->Principal', `direccion` = '$this->Direccion', `telefono` = '$this->Telefono', `personal_id` = '$this->Personal', `correo` = '$this->Correo' where `id` = '$this->Id'";
                $run = new Method;
                $data = $run->update($query);

                if($data){

                    $array = array('nombre' => $this->Nombre, 'principal' => $this->Principal,'direccion' => $this->Direccion,'telefono' => $this->Telefono, 'personal_id' => $this->Personal, 'correo' => $this->Correo, 'id' => $this->Id);

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

        function deleteBodega($Id){

            $response_array = array();

            $Id = isset($Id) ? trim($Id) : "";

            if(!empty($Id)){

                $this->Id=$Id;

                $query = "SELECT * from `inventario_ingresos` where `bodega_id` = '$this->Id' and bodega_tipo = '1'";
                $run = new Method;
                $data = $run->select($query);

                if(!$data){

                    $query = "DELETE from `mantenedor_bodegas` where `id` = '$this->Id'";
                    $run = new Method;
                    $data = $run->delete($query);
                    $query = "DELETE from `inventario_egresos` where `destino_tipo` = '1' and `destino_id` = '$this->Id'";
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

        function showBodegas(){

            $query = "SELECT mantenedor_bodegas.*, usuarios.nombre as personal FROM mantenedor_bodegas LEFT JOIN usuarios ON mantenedor_bodegas.personal_id = usuarios.id where mantenedor_bodegas.id != '999'";
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function showPersonal(){

            $query = 'SELECT * FROM usuarios ORDER BY nombre';
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }
    }

?>
