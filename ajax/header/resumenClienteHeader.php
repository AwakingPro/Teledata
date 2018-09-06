<?php
$run = new Method;
session_start();
if (!isset($_SESSION['idUsuario']) || !isset($_SESSION['idUsuario'])) {
	echo "<script> window.location = '../index.php' </script>";
}
$query = 'SELECT nombre, email FROM usuarios WHERE id ='.$_SESSION['idUsuario'];
$data = $run->select($query);

if (file_exists('../ajax/perfil/img-profile/'.$_SESSION['idUsuario'].'.jpg')) {
	$img = '<img class="img-circle img-user media-object"  src="../ajax/perfil/img-profile/'.$_SESSION['idUsuario'].'.jpg" class="img-lg img-circle" alt="Profile Picture">';
} else {
	$img =  '<img class="img-circle img-user media-object" src="../img/av1.png" class="img-lg img-circle" alt="Profile Picture">';
}
?>
<header id="navbar">
	<div id="navbar-container" class="boxed">
		<!--Logo-->
		<div class="navbar-header">
			<a href="../bienvenida/bienvenida.php" class="navbar-brand">
				<div class="brand-title">
					ERP | Teledata
				</div>
			</a>
		</div>
		<div class="navbar-content clearfix">
			<ul class="nav navbar-top-links pull-left">
				<li class="tgl-menu-btn">
					<a class="mainnav-toggle" href="#">
						<i class="pli-view-list"></i>
					</a>
				</li>
			</ul>
			<ul class="nav navbar-top-links pull-right">
				<li class="username" style="color:white">
					UF: <span class="ValorUF">0</span>
				</li>
				<li id="dropdown-user" class="dropdown">
					<a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
						<span class="pull-right">
							<?php echo $img; ?>
						</span>
						<div id="username" class="username hidden-xs"><?php echo $data[0][0]; ?></div>
						<input type="hidden" id="IdUsuarioSession" value="<?php echo $_SESSION['idUsuario'] ?>">
					</a>
					<div class="dropdown-menu dropdown-menu-md dropdown-menu-right panel-default">
						<!-- Dropdown heading  -->
						<!-- User dropdown menu -->
						<ul class="head-list">
							<li>
								<a href="../perfil">
									<i class="pli-male icon-lg icon-fw"></i> Perfil
								</a>
							</li>
							<!-- <li>
									<a href="#">
											<i class="pli-gear icon-lg icon-fw"></i> Configuración
									</a>
							</li> -->
						</ul>
						<!-- Dropdown footer -->
						<div class="pad-all text-right">
							<a href="../index.php?doLogout=true" class="btn btn-primary">
								<i class="pli-unlock"></i> Salir
							</a>
						</div>
					</div>
				</li>
				<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				<!--End user dropdown-->
			</ul>
		</div>
		<!--================================-->
		<!--End Navbar Dropdown-->
	</div>
</header>
<style media="screen">
.bootbox.modal {
background-color: transparent !important;
z-index: 9999 !important;
background-image: none !important;
}
#navbar .brand-title {
padding: 0 1.5em 0 5px;
}
</style>
<!--===================================================-->
<!--END NAVBAR-->