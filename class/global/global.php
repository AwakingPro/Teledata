<?php
class Omni
{
	public function navBar($cedente)
	{
		$this->cedente=$cedente;
		//$this->validar=$validar;
    echo '<li class="dropdown">';
		        $cambiar_cedente=mysql_query("SELECT Nombre_Cedente FROM Cedente WHERE Id_Cedente = $this->cedente LIMIT 1");
	          $row=mysql_fetch_array($cambiar_cedente);
	   			  echo '<li id="idSeleccionarCedente"><a href="#demo-tabs-box-3" data-toggle="tab"><span class="text-mint">'.$row[0].'</span><button class="btn btn-icon icon-lg fa fa-toggle-on"  value=""  ></button></a></li>';
    echo '</li>';
  }
}
?>
