<?php
    require_once('class/methods_global/methods.php');
    
    session_start();
    $run = new Method;
    if($_SESSION['idUsuario'])
    $run->update("UPDATE usuarios set estaLogin = 0 WHERE id = '".$_SESSION['idUsuario']."' ");
    session_destroy();
    header('Location: index.php');
?>