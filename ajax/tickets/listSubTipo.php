<?php
	switch ($_POST['tipo']) {
		case 'Correo':
				echo "<option value=''>Seleccione...</option>
					<option>Creacion de Correo</option>
					<option>Configuracion Correo</option>
					<option>Lista Negra,Spam</option>
					<option>Poco manejo computacional</option>";
				break;
		case 'Problemas de Equipos con Visita':
				echo "<option value=''>Seleccione...</option>
					<option>Desconfiguracion equipos</option>
					<option>Reinicio de equipos</option>
					<option>Interferencia</option>
					<option>Equipos desconectados</option>";
				break;
		case 'Problemas de Equipos con Visita':
				echo "<option value=''>Seleccione...</option>
					<option>Desconfiguracion equipos</option>
					<option>Reinicio de equipos</option>
					<option>Interferencia</option>
					<option>Equipos desconectados</option>";
				break;
		case 'Problemas Red Interna':
				echo "<option value=''>Seleccione...</option>
					<option>Poco conocimiento</option>
					<option>Equipo cliente</option>
					<option>Equipos desconectados</option>
					<option>Desconocido</option>";
				break;
		case 'Coordinacion':
				echo "<option value=''>Seleccione...</option>
					<option>Visita tecnica</option>
					<option>Reagendamientos</option>";
				break;
		case 'Consultas tecnicas':
				echo "<option value=''>Seleccione...</option>
					<option>Informacion del servicio</option>
					<option>Informacion estado</option>";
				break;
		case 'Falla Masiva':
				echo "<option value=''>Seleccione...</option>
					<option>Estacion sin energia</option>
					<option>Interferencia</option>
					<option>Corte de fibra</option>
					<option>Tormenta Solar</option>
					<option>Desconfiguracion de equipos</option>";
				break;
}
 ?>