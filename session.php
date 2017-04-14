<?php
  class Session
  {
    public function __destruct()
    {
       session_destroy();
    }

    public function iniciaSession()
    {
      session_start();
    }

    public function probandoValores()
    {
      $valor = "Melissa";
      echo $valor;
    }

    public function imprimirValor()
    {
      $this->probandoValores();
      echo "imprimir valor";
    }
  }
?>
