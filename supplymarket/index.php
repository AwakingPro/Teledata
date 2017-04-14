<html>
<head>
<link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>
<body>
<div id="form-reg-container">
<div id="form-reg-title">Registrese</div>
<form id="formulario">
	<div class="form-reg-left">Nombre : </div>
	<div class="form-reg-right"><input type="text"  autocomplete="off"  class="form-input-main" id="nombre"></div>
	<div class="form-reg-left">Correo : </div>
	<div class="form-reg-right"><input type="text"  autocomplete="off"  class="form-input-main" id="email1"></div>
	<div class="form-reg-left">Repita su Correo : </div>
	<div class="form-reg-right"><input type="text" autocomplete="off"  class="form-input-main" id="email2"></div>
	<div class="form-reg-left">Contraseña :</div>
	<div class="form-reg-right"><input type="password" autocomplete="off" class="form-input-main" id="pass1"></div>
	<div class="form-reg-left">Repite Contraseña :</div>
	<div class="form-reg-right"> <input type="password" class="form-input-main" id="pass2"></div>
	<div class="form-reg-left"></div>
	<div class="form-reg-right"><div id="btn-dsb"><input type="submit" value="Registrar"  disabled class="form-input-main-btn-dsb" id="registrar"></div></div>
	<div class="form-reg-left"></div>
	<div class="form-reg-right"><div id="gif_carga"><center><img src="img/loading.gif"></center></div><div id="form-reg-alert"></div></div>
<br><br>

</form>

</div>
<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
<script type="text/javascript" src="js/funciones.js"></script>
</body>
</html>