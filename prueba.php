<?php
include("db/db.php");
include('class/estrategia/estrategias.php');
$Query  = new Estrategia();
$Query->RecalculaQuery();
?>