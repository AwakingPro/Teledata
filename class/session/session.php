<?php
  class Session
  {
    public function __construct($MM_authorizedUsers,$MM_donotCheckaccess) // listo
    {
      session_start();
      $this->MM_authorizedUsers = $MM_authorizedUsers;  // se llena distinto en cada pagina
      $this->MM_donotCheckaccess = $MM_donotCheckaccess;
    }

    // La session solo la destruyo cuando el usuario se desloguea
    public function destruirSession()
    {
      session_destroy();
    }

    public function crearVariableSession($vector)
    {
     foreach ($vector as $clave => $valor)
     {
       $_SESSION[$clave] = $valor;
     }
    }
    // esta funcion la coloque tal cual
    public function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") //listo
  	{
    		if (PHP_VERSION < 6)
    		{
      		$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
    		}

    		$theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
    		switch ($theType)
    		{
  		    case "text":
  		    $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
  		    break;
  		    case "long":
  		    case "int":
  		    $theValue = ($theValue != "") ? intval($theValue) : "NULL";
  		    break;
  		    case "double":
  		    $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
  		    break;
  		    case "date":
  		    $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
  		    break;
  		    case "defined":
  		    $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
  		    break;
   		}

    	return $theValue;
  	}


    public function login($loginUsername,$password,$conn,$database_name) // Listo
    {
      // OJO LA PRIMERA VEZ ME ENVIA A ESTA url
      // http://localhost/index.php?accesscheck=%2Fproduccion%2Fcedente.php
      // si el usuario ingresa un usuario y contraseña sucede todo esto
      $this->loginUsername = $loginUsername;
      $MM_fldUserAuthorization = "nivel";
      $MM_redirectLoginSuccess = "bienvenida/bienvenida.php"; // admin // $MM_redirectLoginSuccess = "cedente.php"; // admin // 
      $MM_redirectLoginSuccess2 = "cedente.php"; // supervisor
      $MM_redirectLoginSuccess3 = "index.php";
      $MM_redirectLoginSuccess4 = "crm/index.php"; // ejecutivos
      $MM_redirectLoginSuccess5 = "cedente.php"; // 6 Calidad
      $MM_redirectLoginFailed = "index.php?id=1"; // 5 cedente
      $MM_redirecttoReferrer = false;

      mysql_select_db($database_name, $conn);
      $LoginRS__query=sprintf("SELECT usuario, clave, nivel, nombre, id, sexo,email,cargo FROM Usuarios WHERE usuario=%s",
      $this->GetSQLValueString($this->loginUsername, "text"));
      //$LoginRS__query=sprintf("SELECT usuario, clave, nivel FROM Usuarios WHERE usuario=%s AND clave=%s",
      //$this->GetSQLValueString($this->loginUsername, "text"), $this->GetSQLValueString($password, "text"));

      $LoginRS = mysql_query($LoginRS__query, $conn) or die(mysql_error());
      $loginFoundUser = mysql_num_rows($LoginRS);
      $isValid = False;
      if ($loginFoundUser) // si entro aca es porque el usuario existe
      {
        // verifico el password con el Hash
        $row=mysql_fetch_array($LoginRS);
        $objetoHash = new Hash();
        if($objetoHash->verificarHash($password,$row['clave']))
        {
          // si entro aca es porque las contraseñas si coinciden
          $isValid = true;
        }
      }

      	if ($isValid) // si entra aca es porque el usuario y contraseña son correctos
      	{
        	$this->loginStrGroup = mysql_result($LoginRS,0,'nivel');
          $this->idUsuLogin = mysql_result($LoginRS,0,'id');
          $this->nombreUsu = $row['nombre'];
          $this->emailUsu = $row['email'];
          $this->cargoUsu = $row['cargo'];
          $this->sexo = $row['sexo'];

          // OJO esta creando las variables de session asi el nivel del usuario no exista


            $array = array(
              "MM_Username" => $this->loginUsername,
              "MM_UserGroup" => $this->loginStrGroup,
              "nombreUsuario" => $this->nombreUsu,
              "emailUsuario" => $this->emailUsu,
              "cargoUsuario" => $this->cargoUsu,
              "id_usuario" => $this->idUsuLogin,
              "sexo_usuario" => $this->sexo,
            );
            $this->crearVariableSession($array);

            $usuario_sis = $_SESSION['MM_Username'];

            $personal = mysql_query("select * from Personal where Nombre_Usuario = '".$usuario_sis."'");
            while($rowpersonal = mysql_fetch_assoc($personal)){
              $_SESSION['personal'] = $rowpersonal['Id_Personal'];
              $_SESSION['personalName'] = $rowpersonal['Nombre'];
            }

       		  if (isset($_SESSION['PrevUrl']) && false) // OJO VERIFICAR ESTE CASO
       		  {
         		  $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];
       		  }
           	if($this->loginStrGroup==1)
           	{
              $ced = mysql_query("SELECT * FROM Usuarios WHERE usuario = '$usuario_sis' LIMIT 1");
                while($row = mysql_fetch_assoc($ced))
                {
    							/*	if(empty($row["mandante"])){
                      $MM_redirectLoginSuccess = "mandante.php";
                    }else{
                      $_SESSION['mandante'] = $row["mandante"];
                    } */
                }
              $this->registrarLogLogin();
              header("Location: " . $MM_redirectLoginSuccess );
           	}
            if($this->loginStrGroup==2)
            {
              echo "SELECT * FROM Usuarios WHERE usuario = '$usuario_sis' LIMIT 1";
              $ced = mysql_query("SELECT * FROM Usuarios WHERE usuario = '$usuario_sis' LIMIT 1");
                while($row = mysql_fetch_assoc($ced))
                {
    								if(empty($row["mandante"])){
                      $MM_redirectLoginSuccess2 = "mandante.php";
                    }else{
                      $_SESSION['mandante'] = $row["mandante"];
                    }
                }
              $this->registrarLogLogin();
              header("Location: " . $MM_redirectLoginSuccess2 );
    		    }
            if($this->loginStrGroup==3)
            {
              $ced = mysql_query("SELECT * FROM Usuarios WHERE usuario = '$usuario_sis' LIMIT 1");
                while($row = mysql_fetch_assoc($ced))
                {
    								if(empty($row["mandante"])){
                      $MM_redirectLoginSuccess5 = "mandante.php";
                    }else{
                      $_SESSION['mandante'] = $row["mandante"];
                    }
                }
              $this->registrarLogLogin();
            	header("Location: " . $MM_redirectLoginSuccess3 );
            }
            if($this->loginStrGroup==4) // OJOOO PROBAR ESTE CASO PREGUNTAR EL NEGOCIO DE PORQ EXISTEN VARIOS USUARIO CON EL MISMO NOMBRE DE USUARIO
            {
                $ced = mysql_query("SELECT Id_Cedente,user_dial,pass_dial,mandante FROM Usuarios WHERE usuario = '$usuario_sis' LIMIT 1");
                while($row = mysql_fetch_assoc($ced))
                {
    								$_SESSION['cedente'] = $row["Id_Cedente"];
                    $_SESSION['user_dial'] = $row["user_dial"];
                    $_SESSION['pass_dial'] = $row["pass_dial"];

                    if(empty($row["mandante"])){
                      $MM_redirectLoginSuccess4 = "mandante.php";
                    }else{
                      $_SESSION['mandante'] = $row["mandante"];
                      if(empty($_SESSION['cedente'])){
                        $MM_redirectLoginSuccess4 = "cedente.php";
                      }
                    }

                    $_SESSION['isEjecutivo'] = true;
                }
                $this->registrarLogLogin();
                header("Location: " . $MM_redirectLoginSuccess4 );
            }
            if($this->loginStrGroup==5)
           	{
              $ced = mysql_query("SELECT * FROM Usuarios WHERE usuario = '$usuario_sis' LIMIT 1");
              while($row = mysql_fetch_assoc($ced))
              {
                if(!empty($row["mandante"])){
                  $_SESSION['mandante'] = $row["mandante"];
                }
              }
              $this->registrarLogLogin();
              header("Location: " . $MM_redirectLoginSuccess );
           	}
            if($this->loginStrGroup==6){
                $ced = mysql_query("SELECT * FROM Usuarios WHERE usuario = '$usuario_sis' LIMIT 1");
                while($row = mysql_fetch_assoc($ced))
                {
    								if(empty($row["mandante"])){
                      $MM_redirectLoginSuccess5 = "mandante.php";
                    }else{
                      $_SESSION['mandante'] = $row["mandante"];
                    }
                }
              $this->registrarLogLogin();
              header("Location: " . $MM_redirectLoginSuccess5 );
            }
      	}
      	else
      	{
          // Registrando ingreso fallido en el sistema
          $this->registrarLogFallidoLogin($loginUsername,$password);
          return 1;
        	header("Location: ". $MM_redirectLoginFailed );
      	}
    }

    // *** Restrict Access To Page: Grant or deny access to this page
    public function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) // listo
    {
        $isValid = False;
        if (!empty($UserName))
        {
            $arrUsers = explode(",", $strUsers);
            $arrGroups = explode(",", $strGroups);
            if (in_array($UserName, $arrUsers))
            {
                $isValid = true;
            }
        // Or, you may restrict access to only certain users based on their username.
            if (in_array($UserGroup, $arrGroups))
            {
                $isValid = true;
            }
            if (($strUsers == "") && false)
            {
                $isValid = true;
            }
        }
        return $isValid;
    }

    public function creaMM_restrictGoTo() // listo
    {
      $MM_restrictGoTo = "../index.php";
      if (!((isset($_SESSION['MM_Username'])) && ($this->isAuthorized("",$this->MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup']))))
      {
          $MM_qsChar = "?";
          $MM_referrer = $_SERVER['PHP_SELF'];
          if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
          if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0)
          $MM_referrer .= "?" . $QUERY_STRING;
          $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
          header("Location: ". $MM_restrictGoTo);
          exit;
      }
    }

    public function creaLogoutAction() // listo
    {
      // ** Logout the current user. **
      $logoutAction = $_SERVER['PHP_SELF']."?doLogout=true"; // cierra session
      if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != ""))
      {
          $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
      }
      return $logoutAction;
    }

    public function borrarVariablesSession() // lista
    {
      unset($_SESSION['MM_Username']);
      unset($_SESSION['MM_UserGroup']);
      unset($_SESSION['PrevUrl']);
      unset($_SESSION['cedente']);
      session_unset();
      $this->destruirSession();
    }

    public function logoutGoTo($ruta)
    {
      $logoutGoTo = $ruta;
      if ($logoutGoTo)
      {
          header("Location: $logoutGoTo");
          exit;
      }
    }

    public function registrarLogLogin()
    {
      $fechaHora = date('Y-m-d H:i:s');
      $idMenu = 1;
      $sql="insert into log_modulo (fecha, id_usuario, usuario, id_menu ,ip) values('".$fechaHora."','".$_SESSION["id_usuario"]."','".$_SESSION['MM_Username']."','".$idMenu."','".$_SERVER['REMOTE_ADDR']."')";
      mysql_query($sql);
    }

    public function registrarLogFallidoLogin($usuario,$password)
    {
      $fechaHora = date('Y-m-d H:i:s');
      $sql="insert into log_fallidos_login (fecha, usuario, password, ip) values('".$fechaHora."','".$usuario."','".$password."','".$_SERVER['REMOTE_ADDR']."')";
      mysql_query($sql);
    }
  }
 ?>
