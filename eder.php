<?php
$edad = $_POST['edad'];
?>

<html>
<body>
<center><b><h1>Ingresa Tus Datos : </h1></b></center>
<br>
<form action="eder.php" method="POST">
<input type="text" name="edad">
<input type="submit" value="guardar">
</form>
<br>
<?php
if($edad >= 18 && $edad <110)
{
    echo "Eder mayor de edad";
}    
elseif ($edad >110)
{
    echo "Es probable que estes muerto";
}
else
{
    echo "no se cumple";
}    
?>
</body>
</html>