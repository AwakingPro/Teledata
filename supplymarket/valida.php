<?php
include("class/class.php");
include("db/db.php");
$v = $_GET['v'];
$m = base64_decode($v);
$registro = new main();
$registro->validaUsuario($m);
$registro->respUsuario();
?>