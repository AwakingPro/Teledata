<?php
require_once('db/db.php');
require_once('class/session/session.php');
$objetoSession = new Session('1,2,3,4,5,6',false);
$_SESSION['cedente'] = $_POST['cedente'];
//$_SESSION['cedente'] = $_POST['cedente'];
//$_SESSION['cedente'] = "48";
/*
$url_redirect = $_POST['url'];
if($url_redirect==1){
    echo header('Location: estrategia/estrategias.php');
}
else if($url_redirect==2){
    echo header('Location: estrategia/crear.php');
}
else if($url_redirect==3){
    echo header('Location: estrategia/ver_estrategias.php');
}*/
?>
