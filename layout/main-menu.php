<?php
require_once('../class/menu/menu.php');
// envio el nivel de usuario y el nom del menu donde estoy parada
$objetoMenu = new Menu(explode( ',' ,1),1);
$objetoMenu->crearMenu();
?>
