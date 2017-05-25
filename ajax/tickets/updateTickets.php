<?php
	require_once('../../class/methods_global/methods.php');
	$query = "UPDATE tickets SET  IdCliente='".$_POST['ClienteUpdate']."', Origen='".$_POST['OrigenUpdate']."', Departamento='".$_POST['DepartamentoUpdate']."', Tipo='".$_POST['TipoUpdate']."', Subtipo='".$_POST['SubtipoUpdate']."', Prioridad='".$_POST['PrioridadUpdate']."', AsignarA='".$_POST['AsignarAUpdate']."', Estado='".$_POST['EstadoUpdate']."' WHERE IdTickets= ".$_POST['idUpdateTicket'];
	$run = new Method;
	$data = $run->update($query);
	echo $query;
 ?>