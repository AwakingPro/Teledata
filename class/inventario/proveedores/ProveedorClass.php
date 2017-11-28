<?php

    include('../../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class Proveedor{

    	public function CrearProveedor($RutDv,$Nombre,$Direccion,$Telefono,$Contacto,$Correo){

            $response_array = array();

            $Rut = substr($RutDv, 0, strpos($RutDv, '-'));
            $Dv = substr($RutDv, - 1);
            $Nombre = isset($Nombre) ? trim($Nombre) : "";
            $Direccion = isset($Direccion) ? trim($Direccion) : "";
            $Telefono = isset($Telefono) ? trim($Telefono) : "";
            $Contacto = isset($Contacto) ? trim($Contacto) : "";
            $Correo = isset($Correo) ? trim($Correo) : "";

            if(!empty($Rut) && !empty($Dv) && !empty($Nombre) && !empty($Direccion)  && !empty($Telefono)  && !empty($Contacto) && !empty($Correo)){

                $this->Rut=$Rut;
                $this->Dv=$Dv;
                $this->Nombre=$Nombre;
                $this->Direccion=$Direccion;
                $this->Telefono=$Telefono;
                $this->Contacto=$Contacto;
                $this->Correo=$Correo;

                $query = "INSERT INTO mantenedor_proveedores(rut, dv, nombre, direccion, telefono, contacto, correo) VALUES ('$this->Rut', '$this->Dv', '$this->Nombre', '$this->Direccion', '$this->Telefono', '$this->Contacto', '$this->Correo')";
                $run = new Method;
                $id = $run->insert($query);

                if($id){

                    $array = array('id'=> $id, 'rut' => $RutDv, 'nombre' => $this->Nombre,'direccion' => $this->Direccion,'telefono' => $this->Telefono,'contacto' => $this->Contacto,'correo' => $this->Correo);

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


        function updateProveedor($RutDv,$Nombre,$Direccion,$Telefono,$Contacto,$Correo, $Id){

            $response_array = array();

            $Rut = substr($RutDv, 0, strpos($RutDv, '-'));
            $Dv = substr($RutDv, - 1);
            $Nombre = isset($Nombre) ? trim($Nombre) : "";
            $Direccion = isset($Direccion) ? trim($Direccion) : "";
            $Telefono = isset($Telefono) ? trim($Telefono) : "";
            $Contacto = isset($Contacto) ? trim($Contacto) : "";
            $Correo = isset($Correo) ? trim($Correo) : "";

            if(!empty($Rut) && !empty($Dv) && !empty($Nombre) && !empty($Direccion)  && !empty($Telefono)  && !empty($Contacto) && !empty($Correo)){

                $this->Id=$Id;
                $this->Rut=$Rut;
                $this->Dv=$Dv;
                $this->Nombre=$Nombre;
                $this->Direccion=$Direccion;
                $this->Telefono=$Telefono;
                $this->Contacto=$Contacto;
                $this->Correo=$Correo;

                $query = "UPDATE `mantenedor_proveedores` set `rut` = '$this->Rut', `dv` = '$this->Dv', `nombre` = '$this->Nombre', `direccion` = '$this->Direccion', `telefono` = '$this->Telefono', `contacto` = '$this->Contacto', `correo` = '$this->Correo' where `id` = '$this->Id'";
                $run = new Method;
                $data = $run->update($query);

                if($data){

                    $array = array('rut' => $RutDv, 'nombre' => $this->Nombre,'direccion' => $this->Direccion,'telefono' => $this->Telefono,'contacto' => $this->Contacto,'correo' => $this->Correo, 'id' => $this->Id);

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

    }

?>
