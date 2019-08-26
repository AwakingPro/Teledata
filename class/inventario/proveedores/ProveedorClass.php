<?php

    include('../../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class Proveedor{

    	public function CrearProveedor($Nombre,$Direccion,$Telefono,$Contacto,$Correo,$Rut){

            $run = new Method;
            
            $response_array = array();

            $Nombre = isset($Nombre) ? trim($Nombre) : "";
            $Direccion = isset($Direccion) ? trim($Direccion) : "";
            $Telefono = isset($Telefono) ? trim($Telefono) : "";
            $Contacto = isset($Contacto) ? trim($Contacto) : "";
            $Correo = isset($Correo) ? trim($Correo) : "";
            $Rut = isset($Rut) ? trim($Rut) : "";
            $Dv = $run->obtenerDv($Rut);

            if(!empty($Nombre) && !empty($Direccion) && !empty($Contacto) && !empty($Rut)){

                $this->Nombre=$Nombre;
                $this->Direccion=$Direccion;
                $this->Telefono=$Telefono;
                $this->Contacto=$Contacto;
                $this->Correo=$Correo;
                $this->Rut=$Rut;
                $this->Dv=$Dv;

                $query = "INSERT INTO mantenedor_proveedores(nombre, direccion, telefono, contacto, correo, rut, dv) VALUES ('$this->Nombre', '$this->Direccion', '$this->Telefono', '$this->Contacto', '$this->Correo', '$this->Rut', '$this->Dv')";
                $id = $run->insert($query);

                if($id){

                    $array = array('id'=> $id, 'nombre' => $this->Nombre,'direccion' => $this->Direccion,'telefono' => $this->Telefono,'contacto' => $this->Contacto,'correo' => $this->Correo, 'rut' => $this->Rut, 'dv' => $this->Dv);

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


        function updateProveedor($Nombre,$Direccion,$Telefono,$Contacto,$Correo, $Id, $Rut){
            $run = new Method;
            $response_array = array();

            $Nombre = isset($Nombre) ? trim($Nombre) : "";
            $Direccion = isset($Direccion) ? trim($Direccion) : "";
            $Telefono = isset($Telefono) ? trim($Telefono) : "";
            $Contacto = isset($Contacto) ? trim($Contacto) : "";
            $Correo = isset($Correo) ? trim($Correo) : "";
            $Rut = isset($Rut) ? trim($Rut) : "";
            $Dv = $run->obtenerDv($Rut);
            if(!empty($Nombre) && !empty($Direccion)  && !empty($Telefono)  && !empty($Contacto) && !empty($Correo)){

                $this->Id=$Id;
                $this->Nombre=$Nombre;
                $this->Direccion=$Direccion;
                $this->Telefono=$Telefono;
                $this->Contacto=$Contacto;
                $this->Correo=$Correo;
                $this->Rut=$Rut;
                $this->Dv=$Dv;

                $query = "UPDATE `mantenedor_proveedores` set `nombre` = '$this->Nombre', `direccion` = '$this->Direccion', `telefono` = '$this->Telefono', `contacto` = '$this->Contacto', `correo` = '$this->Correo', `rut` = '$this->Rut', `dv` = '$this->Dv' where `id` = '$this->Id'";
                
                $data = $run->update($query);

                if($data){

                    $array = array('nombre' => $this->Nombre,'direccion' => $this->Direccion,'telefono' => $this->Telefono,'contacto' => $this->Contacto,'correo' => $this->Correo, 'id' => $this->Id, 'rut' => $this->Rut, 'dv' => $this->Dv);

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

        function deleteProveedor($Id){

            $response_array = array();

            $Id = isset($Id) ? trim($Id) : "";

            if(!empty($Id)){

                $this->Id=$Id;

                $query = "SELECT * from `inventario_ingresos` where `proveedor_id` = '$this->Id'";
                $run = new Method;
                $data = $run->select($query);

                if(!$data){

                    $query = "DELETE from `mantenedor_proveedores` where `id` = '$this->Id'";
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

        function showProveedores(){

            $query = 'SELECT * FROM mantenedor_proveedores';
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }
        function showProveedor($id){
            $query = " SELECT * FROM mantenedor_proveedores where id = '".$id."' ";
            $run = new Method;
            $data = $run->select($query);
            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

    }

?>
