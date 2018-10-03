<?php
require_once('../../class/methods_global/methods.php');

if(isset($_POST['IdClienteOculto'])) {
    session_start();
    $run = new Method;
    
    $contacto        = $_POST['NombreContacto'];
    $tipo_contacto   = $_POST['TipoContacto'];
    $correo          = $_POST['CorreoContacto'];
    $telefono        = $_POST['TelefonoContacto'];
    $id_persona      = $_POST['IdClienteOculto'];

    if(isset($_POST['IdContactoOculto']) && $_POST['IdContactoOculto'] != '') {
        $idContacto = $_POST['IdContactoOculto'];
        $query = "  UPDATE contactos 
                    SET contacto = '".$contacto."',
                    tipo_contacto = '".$tipo_contacto."',
                    correo = '".$correo."',
                    telefono = '".$telefono."' 
                    WHERE
                        id = '".$idContacto."'";
        $update = $run->update($query);
        if($update){
            echo 'Editado';
        } else {
            echo 'No Editado';
        }
        return;
    }

    $query = "  INSERT INTO contactos ( contacto, tipo_contacto, correo, telefono, rut ) SELECT
                '".$contacto."',
                '".$tipo_contacto."',
                '".$correo."',
                '".$telefono."'
                rut 
                FROM
                    personaempresa 
                WHERE
                    id = '".$id_persona."'";

    $id = $run->insert($query);

    if($id > 0){

        echo $id;
    }
} else {
    echo 'No existe El id del Cliente para el Contacto';
}
    

?>