<?php
$salida = shell_exec('/var/www/java/java -jar Main.jar');
echo "<pre>$salida</pre>";
?>