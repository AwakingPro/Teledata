<?php
if($arrMenu[0] == "tar"){
echo "<li class='active-sub'>";}
else { ?>
<li>
<?php } ?>
<a href="#">
<i class="fa fa-tasks"></i>
<span class="menu-title">Tareas</span>
<i class="arrow"></i>
</a>

<!--Submenu-->
<ul class="collapse">
<?php if($arrMenu[1] == "pdt"){
  echo "<li class='active-link'>";}
    else { ?>
    <li>
  <?php } ?>
<a href="../tareas/tareas.php">Panel de Tareas</a>
</li>

</ul>
</li>

/*require_once('pruebaM.php');
require_once('db/db.php');
$objeto = new Session();
$objeto->crearVariableSessionLogin();
echo $_SESSION['SS_Username']."<br />";
echo $_SESSION['SS_UserGroup'];*/




/*include('session.php');
$objeto = new Session();
$objeto->iniciaSession();
//$_SESSION['prueba'] = "PROBANDOMARIANA";
//echo $_SESSION['prueba'];
$_SESSION['aDatos'] = array();
$_SESSION['aDatos']['nombre'] = "Mariana";
echo "Nombre: ".$_SESSION['nombre']."<br />";
echo "Nombre (en array): ".$_SESSION['aDatos']['nombre']."<p />";
$valor = "soy la variable";
$objeto->probandoValores();
$objeto->imprimirValor(); */


/*
Eliminar las variables de session
session_unset();
    //$_SESSION = array();      // También podemos hacerlo así:
   echo "<p>Variables y arrays de la sesión borrados</p>";
   if( isset($_SESSION['nombre']) == false )
   echo "Nombre no definido.<br />";
   if( isset($_SESSION['aDatos']['nombre']) == false )
       echo "Nombre (en array) no definido"; */



       /*
           public function crearVariableSessionLogin() //listo
           {
             $_SESSION['MM_Username'] = $this->loginUsername; // se crea en el index al loguearse
             $_SESSION['MM_UserGroup'] = $this->loginStrGroup; // se crea en el index al loguearse
           }

           public function crearVariableSessionMenu($idMenuActual) //listo
           {
             //Para Id de Menu Actual (Menu Padre, Menu hijo)
             // se cambia en cada doc varia dependiendo de donde estoy parada ejemplo: est,cci --- tar,pdt -- est,egu
             $this->idMenuActual = $idMenuActual;
             $_SESSION['idMenu'] = $this->idMenuActual;
           }

           public function crearVariableSessionCedente($idCedente) // listo
           {
             //  se crea en sesion_cedente.php la informacion llega de cedente.php
             $this->idCedente = $idCedente;
             $_SESSION['cedente'] = $this->idCedente;
           }

           public function crearVariableSessionPrevUrl($accesscheck) // listo
           {
             $this->accesscheck = $accesscheck;
             $_SESSION['PrevUrl'] = $this->accesscheck; // se crea en index.php login
           }

       */


?>
