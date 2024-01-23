<main role="main">
	<br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores" >
				<h3 class="text-center" >
					PERSONAS REGISTRADAS
				</h3>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<div>
					<table id="padron-tabla" class="table table-striped table-hoover">
						<thead>
						<tr id="datos">
							<th>No</th>
							<th>Libro</th>
							<th>Partida</th>
							<th>CI</th>
							<th>Fecha de nacimiento</th>
							<th>Nombres</th>
							<th>Ap. Paterno</th>
							<th>Ap. Materno</th>
							<th>Ap. Esposo</th>
							<th>Accion</th>
						</tr>
						</thead>
						<tbody>
						<?php if(isset($registros)): ?>
							<?php foreach ($registros as $n): ?>
								<?php $reg = json_decode($n->datos_partida); ?>
								<tr>
									<td><?php echo $n->idpartida; ?></td>
									<td><?php echo $reg->libro; ?></td>
									<td><?php echo $reg->partida; ?></td>
									<td><?php echo $reg->numero_documento; ?></td>
									<td><?php echo $reg->fecha_nacimiento; ?></td>
									<td><?php echo $reg->nombres; ?></td>
									<td><?php echo $reg->primer_apellido; ?></td>
									<td><?php echo $reg->segundo_apellido; ?></td>
									<td><?php echo $reg->apellido_esposo; ?></td>
									<td>
										<a href="<?php echo site_url('padron/editarRegistro/'.$n->idpartida); ?>">
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
	</div>
</main>
