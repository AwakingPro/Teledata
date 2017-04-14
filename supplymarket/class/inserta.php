<?php
include("class.php");
$registro = new main();
$registro->insertRegistro($_POST['user'],$_POST['pass'],$_POST['email']);

?>