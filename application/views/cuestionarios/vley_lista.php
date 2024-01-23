<main role="main">
<br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores" >
				<h3 class="text-center" >
					<?php echo $cuestionario->nombre_cuestionario;?>
				</h3>
			</div>

			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<table class="table table-striped table-hover ">
					<thead>
						<tr>
							<th>No</th>
							<th>Fecha de Registro</th>
							<th>Resumen</th>
							<th>Fuente</th>
							<th>Accion</th>
						</tr>
					</thead>
					<tbody>
					<?php if(isset($leyes)): ?>
						<?php foreach ($leyes as $l): ?>
						<tr>
							<td><?php echo $l->idleyes; ?></td>
							<td><?php echo mdate('%d-%m-%Y', $l->fecha_registro); ?></td>
							<td><?php echo $l->resumen; ?></td>
							<td><?php echo $l->nombre_fuente;?></td>
							<td>
								<a href="<?php echo site_url('Ley/editarLey/'.$l->idleyes); ?>">
									Editar<i class="fas fa-edit"></i>
								</a>
							</td>
						</tr>
						<?php endforeach; ?>
					<?php endif; ?>
					</tbody>
				</table>

			</div>

		</div>
	</div>
</main>
