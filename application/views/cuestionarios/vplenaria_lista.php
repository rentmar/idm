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
						<th>Fecha Registro</th>
						<th>Fecha Plenaria</th>
						<th>Instancia</th>
						<th>Cumplimiento de Agenda</th>
						<th>Tipo</th>
						<th>Accion</th>
					</tr>
					</thead>
					<tbody>
					<?php if(isset($plenarias)): ?>
						<?php foreach ($plenarias as $n): ?>
							<tr>
								<td> <?php echo mdate('%m-%d-%Y', $n->fecha_registro); ?> </td>
								<td> <?php echo mdate('%m-%d-%Y', $n->fecha_plenaria); ?> </td>
								<td> <?php echo $n->instancia; ?> </td>
								<td> <?php echo $n->plenaria_agenda_cumplida; ?> </td>
								<td> <?php echo $n->tipo_plenaria_nombre; ?> </td>
								<td>
									<a href="<?php echo site_url('plenaria/editarPlenaria/'.$n->idplenaria); ?>">
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

