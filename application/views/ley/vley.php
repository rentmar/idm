<main role="main"><br>
	<div class="container">
		<div class="row">

			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<div id="caja_boton">
					<div id="contenedor-submit">
						<?php if($this->session->es_nueva_ley): ?>
							<?php if($this->session->ley_nueva !== null){  ?>
								<?php if($this->session->ley_nueva->es_preenvio && $this->session->ley_nueva->es_segundo_paso ){ ?>
									<a href="<?php echo site_url('Ley/preenvio');?>">
										<input type="submit" class="BOTON" value="CONTINUA" data-toggle="tooltip" title="Existe una registro pendiente" >
									</a>
								<?php } ?>
								<?php if($this->session->ley_nueva->es_segundo_paso && !$this->session->ley_nueva->es_preenvio ){ ?>
									<a href="<?php echo site_url('Ley/subtemas');?>">
										<input type="submit" class="BOTON" value="CONTINUA" data-toggle="tooltip" title="Existe una registro pendiente" >
									</a>
								<?php } ?>
								<?php if($this->session->es_nueva_ley && !$this->session->ley_nueva->es_segundo_paso && !$this->session->ley_nueva->es_preenvio ){ ?>
									<a href="<?php echo site_url('Ley/crearLey');?>" data-toggle="tooltip" title="Existe una registro pendiente" >
										<input type="submit" class="BOTON" value="CONTINUA">
									</a>
								<?php } ?>

							<?php } ?>

						<?php else: ?>
							<a href="<?php echo site_url('Ley/iniciarCreacion');?>">
								<input type="submit" class="BOTON" value="CREAR">
							</a>
						<?php endif; ?>
						<a href="<?php echo site_url('Ley/cancelarNuevo'); ?>">
							<input type="button" class="BOTONROJO" value="CANCELAR">
						</a>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<p>
				<table>
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
									</div>
								<?php endif; ?>

							</td>
							<td>
								<a href="<?php echo site_url('Ley/estadoLey/'.$l['idley']);?>" >
									<i class="fas fa-pencil-alt"></i>
									Actualiza
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
					<?php endif; ?>
				</table>
			</div>
		</div>
	</div>
	<br>
</main>




