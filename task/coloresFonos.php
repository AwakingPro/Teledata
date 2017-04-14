<?php
include("../db/db.php");
include("../class/estrategia/estrategia.php");

$estrategia = new Estrategia();
$estrategia->javaGet(1);

?>