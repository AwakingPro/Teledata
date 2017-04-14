<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script>
    window.onload=function(){
                // Una vez cargada la página, el formulario se enviara automáticamente.
		document.forms["miformulario"].submit();
    }
    </script>
</head>

<body>
<form action="insertar.php" name="miformulario" method="post">
<input type="text" name="mensaje" value="hola shoro"/>
<input type="submit" value="enviar" />
<input type="text" name="tipo" value = "1" />
 </form>
</body>
</html>