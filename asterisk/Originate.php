<?php
  include ("phpagi-asmanager.php");

  $asm = new AGI_AsteriskManager();
  //$asm->Events("on");
  $asm->connect("127.0.0.1","lponce","lponce");

  $resultado = $asm->originate("SIP/994096738@datavox","7777","rob","1","","","18000","18295218507","","12345","true","1002");
  print_r($resultado);

  $asm->add_event_handler("OriginateResponse","mostrarDatos");
  $asm->add_event_handler("Hangup","mifuncion");

  while(true){
    $asm->wait_response(true);
  }

  function mostrarDatos($ecode,$data,$server,$port) {
    echo "Ejecutar Ajax!!!";
    echo "received event '$ecode' from $server:$port\n";
    print_r($data);
  }

  function mifuncion($ecode,$data,$server,$port) {
    echo "received event '$ecode' from $server:$port\n";
    echo implode(',',$data);
  }

  $asm->disconnect();
  sleep(1);

?>
