<main role="main">
	<br>
	<div class="container">
		<div class="row">

			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<table>
					<thead>
					<tr id="datos">
						<th>Nro</th>
						<th>Encuesta</th>
						<th>Accion</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($encuestas as $e) {?>
						<tr>
							<td><?php echo $e->iduiencuesta;?></td>
							<td><?php echo $e->uinombre_encuesta;?></td>
							<td>
								<a href="<?php echo site_url('encuesta/verFormEncuesta/'.$e->iduiencuesta);?>" data-toggle="tooltip" title="Ver formulario de la encuesta"  >
									<i class="fas fa-eye"></i>
								</a>

								<a href="<?php echo site_url('encuesta/administrar/'.$e->iduiencuesta);?>" data-toggle="tooltip" title="Administrar encuesta" >
									<i class="fas fa-pencil-ruler"></i>
								</a>

								<?php if($e->encuesta_activa): ?>
									<a href="<?php echo site_url('encuesta/cambiarEstado/'.$e->iduiencuesta);?>" data-toggle="tooltip" title="Activa/Desactiva">
										<i class="fas fa-toggle-on"></i>
									</a>
								<?php else: ?>
									<a href="<?php echo site_url('encuesta/cambiarEstado/'.$e->iduiencuesta);?>" data-toggle="tooltip" title="Activa/Desactiva" >
										<i class="fas fa-toggle-off"></i>
									</a>
								<?php endif; ?>


							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>

		</div>
	</div>
	<br>
</main>
