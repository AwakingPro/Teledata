<?php $arrMenu = explode( ',' ,$_SESSION['idMenu']); ?>
<!--MAIN NAVIGATION-->
<!--===================================================-->
<nav id="mainnav-container">
  <div id="mainnav">
    <!--Shortcut buttons-->
    <!--================================-->
    <div id="mainnav-shortcut">
      <ul class="list-unstyled">
        <li class="col-xs-4" data-content="Page Alerts"></li>
      </ul>
    </div>
    <!--================================-->
    <!--End shortcut buttons-->
    <!--Menu-->
    <!--================================-->
    <div id="mainnav-menu-wrap">
      <div class="nano">
        <div class="nano-content">
          <ul id="mainnav-menu" class="list-group">
            <!--Category name-->
            <li class="list-header">Menú Principal</li>
            <!-- Aqui meto mi codigo -->
            <!--Menu list item-->
              <li>
						    <a href="../index.php">
						      <i class="psi-home"></i> <!-- class="psi-home" este es el icono del home -->
						      <span class="menu-title">
										<strong>Inicio</strong>
									</span>
						    </a>
						  </li>
            <!--Menu list item  esto va en la primera -->
						<?php
            if($arrMenu[0] == "est"){           // este <li cubre toda mi primera y segunda consulta en BD
              echo "<li class='active-sub'>";}  // class='active-sub'> cuando esta cerrado sale sombreado en azul Dependiendo
                                                // de la pagina donde este parada
                                                // es decir debo saber donde estoy parada para hacer este sombreado
            else
            { ?>
            <li>
            <?php } ?>
						  <a href="#">
						    <i class="psi-knight"></i> <!-- class="psi-knight" este es el icono q lo tienen solo los padres -->
						      <span class="menu-title">
						 			  <strong>Estrategia</strong>
									</span>
									<i class="arrow"></i> <!-- esta linea me coloca la flechita que indica q tiene sub menu osea solo lo tendra inicio -->
						  </a>
                <!--Submenu esto va en mi segunda consulta a la BD -->
						    <ul class="collapse in"> <!-- OJO  <ul class="collapse in"> Dependiendo donde este parada coloco el in
                                          es para que se abra el sub menu de esta caterp       -->

                  <?php
                  if($arrMenu[1] == "ces"){
		              echo "<li class='active-link'>";}
		              else { ?> <!-- class='active-link' esto coloca en negrita el link donde estoy parada dependiendp de de
                                  la pagina -->
		              <li>
		              <?php } ?>
						        <a href="../estrategia/crear.php">Crear Estrategia</a>
						      </li>

                  <?php
                  if($arrMenu[1] == "egu"){
		              echo "<li class='active-link'>";}
		              else { ?>
		              <li>
		              <?php } ?>
									 <a href="../estrategia/estrategias.php">Estrategias Guardadas</a>
									</li>

                  <?php
                  if($arrMenu[1] == "ccf"){
		              echo "<li class='active-link'>";}
		              else { ?>
		              <li>
		              <?php } ?>
                    <a href="../estrategia/categoria_fonos.php">Crear Categoria Fonos</a>
                  </li>

                </ul>
                <!--End Submenu-->
            </li>
            <!-- End Menu list item-->
						<!--Menu list item-->
						<li>
						  <a href="#">
						    <i class="psi-pie-chart"></i>
						      <span class="menu-title">Asignación</span>
								<i class="arrow"></i>
						  </a>
              <!--Submenu-->
              <ul class="collapse">
                <li><a href="#">Submenu</a></li>
                <!-- Menu Tree -->
                <li>
                    <a href="#">Third Level<i class="arrow"></i></a>

                    <!--Submenu-->
                    <ul class="collapse">
                        <li><a href="#">Third Level Item</a></li>
                        <li><a href="#">Third Level Item</a></li>
                        <li><a href="#">Third Level Item</a></li>
                        <li><a href="#">Third Level Item</a></li>
                    </ul>
                </li>
                <!-- End Menu Tree -->
              </ul>
              <!--End Submenu-->
            </li>
            <!-- End Menu list item-->

          <!-- Hasta aqui llega mi codigo -->
          </ul> <!-- Fin <ul id="mainnav-menu" class="list-group">  -->
        </div>
      </div>
    </div>
    <!--================================-->
    <!--End menu-->
  </div>
</nav>
<!--===================================================-->
<!--END MAIN NAVIGATION-->
