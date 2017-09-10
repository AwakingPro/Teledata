<?php

    include('../../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class Costo{

    	public function CrearCosto($Nombre,$Personal,$Correo,$Direccion){

            $response_array = array();

            $Nombre = isset($Nombre) ? trim($Nombre) : "";
            $Personal = isset($Personal) ? trim($Personal) : "";
            $Correo = isset($Correo) ? trim($Correo) : "";
            $Direccion = isset($Direccion) ? trim($Direccion) : "";

            if(!empty($Nombre) && !empty($Personal) && !empty($Correo) && !empty($Direccion)){

                $this->Nombre=$Nombre;
                $this->Personal=$Personal;
                $this->Correo=$Correo;
                $this->Direccion=$Direccion;

                $query = "INSERT INTO mantenedor_costos(nombre, direccion, personal_id, correo, telefono) VALUES ('$this->Nombre','$this->Direccion','$this->Personal','$this->Correo', '0')";
                $run = new Method;
                $id = $run->insert($query);

                if($id){

                    $array = array('id'=> $id, 'nombre' => $this->Nombre,'direccion' => $this->Direccion, 'personal_id' => $this->Personal, 'correo' => $this->Correo);

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


        function updateCosto($Nombre,$Personal,$Correo,$Direccion, $Id){

            $response_array = array();

            
            $Nombre = isset($Nombre) ? trim($Nombre) : "";
            $Personal = isset($Personal) ? trim($Personal) : "";
            $Correo = isset($Correo) ? trim($Correo) : "";
            $Direccion = isset($Direccion) ? trim($Direccion) : "";

            if(!empty($Nombre) && !empty($Personal) && !empty($Correo) && !empty($Direccion)){

                $this->Nombre=$Nombre;
                $this->Personal=$Personal;
                $this->Correo=$Correo;
                $this->Direccion=$Direccion;
                $this->Id=$Id;

                $query = "UPDATE `mantenedor_costos` set `nombre` = '$this->Nombre', `direccion` = '$this->Direccion', `personal_id` = '$this->Personal', `correo` = '$this->Correo' where `id` = '$this->Id'";
                $run = new Method;
                $data = $run->update($query);

                if($data){

                    $array = array('nombre' => $this->Nombre,'direccion' => $this->Direccion, 'personal_id' => $this->Personal, 'correo' => $this->Correo, 'id' => $this->Id);

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

        function deleteCosto($Id){

            $response_array = array();

            $Id = isset($Id) ? trim($Id) : "";

            if(!empty($Id)){

                $this->Id=$Id;

                $query = "DELETE from `mantenedor_costos` where `id` = '$this->Id'";
                $run = new Method;
                $data = $run->delete($query);
                $response_array['status'] = 1; 
                    
               
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);
        }

        function showCostos(){

            $query = 'SELECT mantenedor_costos.*, usuarios.nombre as personal FROM mantenedor_costos INNER JOIN usuarios ON mantenedor_costos.personal_id = usuarios.id';
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function showPersonal(){

            $query = 'SELECT * FROM usuarios';
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }
    }

?>
