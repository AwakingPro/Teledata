<?php
$arrMenu = explode( ',' ,$_SESSION['idMenu']);
/*$host_name = 'localhost';
$user_name = 'root';
$pass_word = '';
$database_name = 'prueba';
$conn = mysql_connect($host_name, $user_name, $pass_word) or die ('Error connecting to mysql');
mysql_select_db($database_name);

$consultaMenu = "SELECT * FROM menu WHERE padre = 0";
$resultado = mysql_query($consultaMenu, $conn) or die(mysql_error());
$resut = mysql_fetch_assoc($resultado);
$numRows = mysql_num_rows($resultado);
while ($result = mysql_fetch_array($resultado))
{
  echo $result["nombre"]."</br></br>";
  $consultaSubMenu = "SELECT * FROM menu WHERE padre = ".$result["id_menu"];
  $resultadoSubMenu = mysql_query($consultaSubMenu, $conn) or die(mysql_error());
  while ($resultSubMenu = mysql_fetch_array($resultadoSubMenu))
  {
    echo "----".$resultSubMenu["nombre"]."</br></br>";
    $consultaSubMenuHijo = "SELECT * FROM menu WHERE padre = ".$resultSubMenu["id_menu"];
    $resultadoSubMenuHijo = mysql_query($consultaSubMenuHijo, $conn) or die(mysql_error());
    while ($resultSubMenuHijo = mysql_fetch_array($resultadoSubMenuHijo))
    {
      echo "--------------".$resultSubMenuHijo["nombre"]."</br></br>";
    }
  }
} */

?>
<!--MAIN NAVIGATION-->
<!--===================================================-->
<nav id="mainnav-container">
    <div id="mainnav">

        <!--Shortcut buttons-->
        <!--================================-->
        <div id="mainnav-shortcut">
            <ul class="list-unstyled">

                <li class="col-xs-4" data-content="Page Alerts">

                </li>
            </ul>
        </div>
        <!--================================-->
        <!--End shortcut buttons-->
        <!--================================-->

        <!--Menu-->
        <!--================================-->
        <div id="mainnav-menu-wrap">
          <div class="nano">
              <div class="nano-content">
              <!--ITEM -->
              <?php if($arrMenu[0] == "tar"){
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
              <!-- ITEM -->
              </div>
          </div>
        </div>
        <!--================================-->
        <!--End menu-->
    </div>
</nav>
<!--===================================================-->
<!--END MAIN NAVIGATION-->
