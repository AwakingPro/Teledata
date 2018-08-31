<div class="modal fade" role="dialog" id="modalContactos">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title moda-title-contacto">Agregar Contacto</h4>
			</div>
			<div class="modal-body">
				<div class="row">
				<?php
                    include 'formContactos.php';
                ?>
				</div>
				<hr>
				<div class="panel">
					<!-- Panel body -->
					<div class="panel-body">
						<div class="dataContactos">
							<h4>No hay información</h4>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
