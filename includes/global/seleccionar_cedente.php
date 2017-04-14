<?php
include("../../class/global/cedente.php");
include("../../db/db.php");
$formCedente = new Cedente();
$formCedente->formCedente($_POST['cedente'], $_POST['mandante']);
?>
