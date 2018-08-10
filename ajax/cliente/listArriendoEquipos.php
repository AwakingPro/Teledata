<?php
	require_once('../../class/methods_global/methods.php');
	$query = "	SELECT
					arriendo_equipos_datos.IdArriendoEquiposDatos,
					(
						CASE
						WHEN arriendo_equipos_datos.IdProducto IS NULL THEN
							CONCAT(
								mantenedor_modelo_producto.nombre,
								' ',
								mantenedor_marca_producto.nombre,
								' ',
								mantenedor_tipo_producto.nombre
							)
						ELSE
							'No hay producto asignado'
						END
					) AS Producto,
					arriendo_equipos_datos.Velocidad,
					arriendo_equipos_datos.Plan
				FROM
					arriendo_equipos_datos
				LEFT JOIN inventario_ingresos ON arriendo_equipos_datos.IdProducto = inventario_ingresos.id
				LEFT JOIN mantenedor_modelo_producto ON inventario_ingresos.modelo_producto_id = mantenedor_modelo_producto.id
				LEFT JOIN mantenedor_marca_producto ON mantenedor_modelo_producto.marca_producto_id = mantenedor_marca_producto.id
				LEFT JOIN mantenedor_tipo_producto ON mantenedor_marca_producto.tipo_producto_id = mantenedor_tipo_producto.id
				WHERE
					arriendo_equipos_datos.IdServicio = ".$_POST['id'];
	$run = new Method;
	$lista = $run->listViewDelete($query,$_POST['id'],1);
	echo $lista;
 ?>