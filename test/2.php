<?php
  session_start();

$user =  $_SESSION["usuario"];
$cedente =  $_SESSION["cedente"];    
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Documento sin título</title>
</head>

<body>
Hola <?php echo $cedente?>
</body>
</html>