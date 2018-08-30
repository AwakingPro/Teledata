<?php
require_once('../../class/methods_global/methods.php');

if(isset($_POST['IdClienteOculto'])) {
    session_start();
    $run = new Method;

    $contacto        = $_POST['Nombre'];
    $tipo_contacto   = $_POST['Tipo'];
    $correo          = $_POST['Correo'];
    $telefono        = $_POST['Telefono'];
    $id_persona      = $_POST['IdClienteOculto'];

    $query = "INSERT INTO contactos
            (contacto, tipo_contacto, correo, telefono, id_persona)
            VALUES
            ('".$contacto."', '".$tipo_contacto."', '".$correo."', '".$telefono."', '".$id_persona."')";

    $IdCliente = $run->insert($query);

    if($IdCliente > 0){

        echo $IdCliente;
    }
} else {
    echo 'Problemas al intentar insertar';
}
    

?>