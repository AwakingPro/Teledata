<!--NAVBAR-->
<!--===================================================-->
<header id="navbar">
  <div id="navbar-container" class="boxed">
    <!--Logo-->
    <div class="navbar-header">
      <a href="../index.php" class="navbar-brand">
        <div class="brand-title">
        ERP | Teledata
        </div>
      </a>
    </div>
    <!--End Logo-->

    <!--Navbar Dropdown-->
    <!--================================-->
    <div class="navbar-content clearfix">
      <ul class="nav navbar-top-links pull-left">

        <!--Navigation toogle button-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <li class="tgl-menu-btn">
          <a class="mainnav-toggle" href="#">
            <i class="pli-view-list"></i>
          </a>
        </li>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End Navigation toogle button-->

        <!--Notification dropdown-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
      <!--  <li class="dropdown">
          <a href="#" data-toggle="dropdown" class="dropdown-toggle">
            <i class="pli-bell"></i>
            <span class="badge badge-header badge-danger"></span>
          </a>

          <!--Notification dropdown menu-->
      <!--  <div class="dropdown-menu dropdown-menu-md">
            <div class="pad-all bord-btm">
              <p class="text-lg text-semibold mar-no">Tienes Nuevas Notificaciones</p>
            </div>
            <div class="nano scrollable">
              <div class="nano-content">
                <ul class="head-list"></ul>
              </div>
            </div>

            <!--Dropdown footer-->
        <!--  <div class="pad-all bord-top">
              <a href="#" class="btn-link text-dark box-block">
                <i class="fa fa-angle-right fa-lg pull-right"></i>Ver Todas las Notificaciones
              </a>
            </div>
          </div>
        </li> -->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End notifications dropdown-->
      </ul>
      <ul class="nav navbar-top-links pull-right">

        <!--Language selector-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <?php
        if (isset($cedente) && $cedente != "" )
        {
          $navBar = new Omni();
          $navBar->navBar($cedente);
        }
        ?>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End language selector-->

        <!--User dropdown-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <li id="dropdown-user" class="dropdown">
          <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
            <span class="pull-right">
              <?php if ($_SESSION['sexo_usuario'] == "F"){ ?>
              <img class="img-circle img-user media-object" src="../img/av6.png" alt="Profile Picture">
              <?php }else{ ?>
              <img class="img-circle img-user media-object" src="../img/av1.png" alt="Profile Picture">
              <?php } ?>
            </span>
            <div class="username hidden-xs"><?php echo $_SESSION['nombreUsuario']; ?></div>
          </a>
          <div class="dropdown-menu dropdown-menu-md dropdown-menu-right panel-default">
            <!-- Dropdown heading  -->
            <!-- User dropdown menu -->
            <ul class="head-list">
              <li>
                <a href="#">
                  <i class="pli-male icon-lg icon-fw"></i> Perfil
                </a>
              </li>
              <li>
                <a href="#">
                  <span class="badge badge-danger pull-right">9</span>
                  <i class="pli-mail icon-lg icon-fw"></i> Mensajes
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="pli-gear icon-lg icon-fw"></i> Configuración
                </a>
              </li>
              <li>
                <a target="_blank" href="#">
                  <i class="pli-information icon-lg icon-fw"></i> Ayuda
                </a>
              </li>
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
<script src="../js/jquery-2.2.1.min.js"></script>
  <style media="screen">
    .bootbox.modal {
      background-color: transparent !important;
      z-index: 9999 !important;
      background-image: none !important;
    }
  </style>
<!--===================================================-->
<!--END NAVBAR-->
