<?php

    include("../../db/db.php"); 
    header('Content-type: application/json');

    class Proveedor{


    	public function CrearProveedor($Nombre,$Direccion,$Telefono,$Contacto,$Correo){

            $response_array = array();

            $Nombre = isset($Nombre) ? trim($Nombre) : "";
            $Direccion = isset($Direccion) ? trim($Direccion) : "";
            $Telefono = isset($Telefono) ? trim($Telefono) : "";
            $Contacto = isset($Contacto) ? trim($Contacto) : "";
            $Correo = isset($Correo) ? trim($Correo) : "";

            if(!empty($Nombre) && !empty($Direccion)  && !empty($Telefono)  && !empty($Contacto) &&
                !empty($Correo)){

                $this->Nombre=$Nombre;
                $this->Direccion=$Direccion;
                $this->Telefono=$Telefono;
                $this->Contacto=$Contacto;
                $this->Correo=$Correo;

                $Query = mysql_query("INSERT INTO mantenedor_proveedores(nombre, direccion, telefono, contacto, correo) VALUES ('$this->Nombre','$this->Direccion','$this->Telefono','$this->Contacto','$this->Correo')");

                if($Query){


                    $array = array('nombre' => $this->Nombre,'direccion' => $this->Direccion,'telefono' => $this->Telefono,'contacto' => $this->Contacto,'correo' => $this->Correo);

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


        function updateProveedor($Nombre,$Direccion,$Telefono,$Contacto,$Correo, $Id){

            $response_array = array();

            $Nombre = isset($Nombre) ? trim($Nombre) : "";
            $Direccion = isset($Direccion) ? trim($Direccion) : "";
            $Telefono = isset($Telefono) ? trim($Telefono) : "";
            $Contacto = isset($Contacto) ? trim($Contacto) : "";
            $Correo = isset($Correo) ? trim($Correo) : "";

            if(!empty($Nombre) && !empty($Direccion)  && !empty($Telefono)  && !empty($Contacto) &&
                !empty($Correo)){

                $this->Id=$Id;
                $this->Nombre=$Nombre;
                $this->Direccion=$Direccion;
                $this->Telefono=$Telefono;
                $this->Contacto=$Contacto;
                $this->Correo=$Correo;

                $array = array('nombre' => $this->Nombre,'direccion' => $this->Direccion,'telefono' => $this->Telefono,'contacto' => $this->Contacto,'correo' => $this->Correo, 'id' => $this->Id);

                $QueryString = "UPDATE `mantenedor_proveedores` set `nombre` = '$this->Nombre', `direccion` = '$this->Direccion', `telefono` = '$this->Telefono', `contacto` = '$this->Contacto', `correo` = '$this->Correo' where `id` = '$this->Id'";

                $Query = mysql_query($QueryString);
                // or die(mysql_error());

                if($Query){

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
    }

?>
