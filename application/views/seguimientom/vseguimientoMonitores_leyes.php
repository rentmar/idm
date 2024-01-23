<main role="main">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores" >
				<h3 class="text-center" >
					Leyes Registradas
				</h3>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores ">
				<div>
					<table id="leyes-tabla" class="table table-striped table-hoover">
						<thead>
						<tr id="datos">
							<th>No</th>
							<th>Descripcion Ley</th>
							<th>En Tratamiento</th>
							<th>Sancionada</th>
							<th>Aprobada</th>
							<th>Con Modificacion</th>
							<th>Promulgada</th>
							<th>Accion</th>
						</tr>
						</thead>

						<tbody>
						<?php if(isset($leyes)): ?>
							<?php foreach ($leyes as $l):?>
								<tr>
									<td><?php echo $l['idley'];?></td>
									<td><?php echo $l['descripcion'];?></td>
									<td>
										<?php if(empty($l['tratamiento'])): ?>
											<div class="form-check">
												<label class="form-check-label">
													<i class="far fa-square"></i>
													S/N
												</label>
											</div>
										<?php else: ?>
											<?php $estado = $l['tratamiento'];  ?>
											<div class="form-check">
												<label>
													Fecha: <?php echo mdate('%m-%d-%Y', $estado->fecha_estadoley); ?>
												</label>
											</div>
											<div class="form-check">
												<label class="form-check-label">
													<i class="far fa-check-square"></i>
													<!--											<input disabled checked type="checkbox" class="form-check-input" value="">-->
													<?php echo $estado->codigo_ley; ?>
												</label>
												<hr class="hrrojooscuro" >
											</div>
										<?php endif; ?>
									</td>
									<td>
										<?php if(empty($l['sancionado'])): ?>
											<div class="form-check">
												<label class="form-check-label">
													<i class="far fa-square"></i>
													S/N
												</label>
											</div>
										<?php else: ?>
											<?php $estado = $l['sancionado'];  ?>
											<div class="form-check">
												<label>
													Fecha: <?php echo mdate('%m-%d-%Y', $estado->fecha_estadoley); ?>
												</label>
											</div>
											<div class="form-check">
												<label class="form-check-label">
													<i class="far fa-check-square"></i>
													<?php echo $estado->codigo_ley; ?>
												</label>
												<hr class="hrrojo" >
											</div>
										<?php endif; ?>
									</td>
									<td>
										<?php if(empty($l['aprobado'])): ?>
											<div class="form-check">
												<label class="form-check-label">
													<i class="far fa-square"></i>
													S/N
												</label>
											</div>
										<?php else: ?>
											<?php $estado = $l['aprobado'];  ?>
											<div class="form-check">
												<label>
													Fecha: <?php echo mdate('%m-%d-%Y', $estado->fecha_estadoley); ?>
												</label>
											</div>
											<div class="form-check">
												<label class="form-check-label">
													<i class="far fa-check-square"></i>
													<?php echo $estado->codigo_ley; ?>
												</label>
												<hr class="hramarillo">
											</div>
										<?php endif; ?>

									</td>
									<td>
										<?php if(empty($l['modificacion'])): ?>
											<div class="form-check">
												<label class="form-check-label">
													<i class="far fa-square"></i>
													S/N
												</label>
											</div>
										<?php else: ?>
											<?php $estado = $l['modificacion'];  ?>
											<div class="form-check">
												<label>
													Fecha: <?php echo mdate('%m-%d-%Y', $estado->fecha_estadoley); ?>
												</label>
											</div>
											<div class="form-check">
												<label class="form-check-label">
													<i class="far fa-check-square"></i>
													<?php echo $estado->codigo_ley; ?>
												</label>
												<hr class="hrverde" >
											</div>
										<?php endif; ?>
									</td>
									<td>
										<?php if(empty($l['promulgada'])): ?>
											<div class="form-check">
												<label class="form-check-label">
													<i class="far fa-square"></i>
													S/N
												</label>
											</div>
										<?php else: ?>
											<?php $estado = $l['promulgada'];  ?>
											<div class="form-check">
												<label>
													Fecha: <?php echo mdate('%m-%d-%Y', $estado->fecha_estadoley); ?>
												</label>
											</div>
											<div class="form-check">
												<label class="form-check-label">
													<i class="far fa-check-square"></i>
													<?php echo $estado->codigo_ley; ?>
												</label>
												<hr class="hrverdeoscuro">
											</div>
										<?php endif; ?>

									</td>
									<td>
										<a href="<?php echo site_url('Seguimientomonitores/leyInformacion/'.$l['idley']); ?>" data-toggle="tooltip" title="Ver informacion del Registro" >
											<i class="fas fa-book"></i>
										</a>
										<a href="<?php echo site_url('ley/editarLey/'.$l['idley']); ?>"  data-toggle="tooltip" title="Editar Registro" >
											<i class="fas fa-edit"></i>
										</a>

										<?php if($l['esta_activa']): ?>
											<a href="<?php echo site_url('Seguimientomonitores/cambiarEstadoLey/'.$l['idley']);?>" data-toggle="tooltip" title="Activa/Desactiva" >
												<i class="fas fa-toggle-on"></i>
											</a>
										<?php else: ?>
											<a href="<?php echo site_url('Seguimientomonitores/cambiarEstadoLey/'.$l['idley']);?>" data-toggle="tooltip" title="Activa/Desactiva">
												<i class="fas fa-toggle-off"></i>
											</a>
										<?php endif; ?>



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
