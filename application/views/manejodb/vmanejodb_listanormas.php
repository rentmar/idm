<main role="main">
	<br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores" >
				<h3 class="text-center" >
					Normas Registradas
				</h3>
			</div>

			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores ">
				<div>
					<table id="normas-tabla" class="table table-striped table-hoover">
						<thead>
						<tr id="datos">
							<th>No</th>
							<th>Fecha</th>
							<th>Fecha norma</th>
							<th>Instancia</th>
							<th>Estado de la norma</th>
							<th>Codigo</th>
							<th>Nombre</th>
							<th>Usuario</th>
							<th>Estado</th>
							<th>Accion</th>
						</tr>
						</thead>
						<tbody>
						<?php if(isset($normas)): ?>
							<?php foreach ($normas as $n): ?>
								<tr>
									<td><?php echo $n->idnormag; ?></td>
									<td><?php echo mdate('%m-%d-%Y', $n->fecha_registro); ?></td>
									<td><?php echo mdate('%m-%d-%Y', $n->fecha_norma); ?></td>
									<td><?php echo $n->instancia; ?></td>
									<td><?php echo $n->estado_norma ?></td>
									<td><?php echo $n->norma_codigo; ?></td>
									<td><?php echo $n->norma_nombre; ?></td>
									<td><?php echo $n->username; ?></td>
									<?php if($n->activo): ?>
										<td class="table-info" >Activa</td>
									<?php else: ?>
										<td class="table-danger" >Inactiva</td>
									<?php endif; ?>

									<td>
										<?php if($n->activo): ?>
											<a href="<?php echo site_url('manejoDB/cambiarEstadoNorma/'.$n->idnormag);?>" data-toggle="tooltip" title="Activa/Desactiva">
												<i class="fas fa-toggle-on"></i>
											</a>
										<?php else: ?>
											<a href="<?php echo site_url('manejoDB/cambiarEstadoNorma/'.$n->idnormag);?>" data-toggle="tooltip" title="Activa/Desactiva" >
												<i class="fas fa-toggle-off"></i>
											</a>
										<?php endif; ?>
										<a href="<?php echo site_url('normativa/editarNorma/'.$n->idnormag); ?>">
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
	<br>
</main>


