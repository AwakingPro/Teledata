<?php
$mystring = 'asd';
$findme   = ',';
$pos = strpos($mystring, $findme);
if($pos==true){
    echo "coma";
}
else
{
    echo "no";
}
?>