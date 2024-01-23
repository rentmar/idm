<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<?php echo form_open('manejoDB/procesarConsulta'); ?>
				<div class="contenedor_filtros">
				</div>
				<div class="contenedor">
					<div id="caja_boton">
						<div id="contenedor-submit">
							<a href=""><input type="submit" class="BOTON" value="GENERAR"></a>
						</div><br>
						<div id="contenedor-submit">
							<a href="<?php echo site_url('manejoDB');?>"><input type="" class="BOTONROJO" value="CANCELAR"></a>
						</div>
					</div>
				</div>
				<br>
				<div class="contenedor">
					<!--Mensaje de Error-->
					<?php if(!empty($this->session->flashdata())): ?>
						<br>
						<div>
							<div id="mensaje-error">
								<div class="alert alert-<?php echo $this->session->flashdata('clase')?>">
									<?php echo $this->session->flashdata('mensaje') ?>
								</div>
							</div>
						</div>
						<br>
					<?php endif; ?>


					<div>
						<h3>Intervalo de fecha </h3>
						<div class="form-row">
							<div class="col">
								<label for="fecha_inicio" >Inicial:</label>
								<input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required >
							</div>
							<div class="col">
								<label for="fech_fin" >Final:</label>
								<input type="date" class="form-control" id="fech_fin" name="fecha_fin" required >
							</div>
						</div>
					</div>

					<br>

					<h3>Formulario </h3>
					<div class="form-row">
						<select id="idcuestionario" name="idcuestionario" class="form-control simple"  >
							<option value="0" >Seleccione una opcion</option>
							<?php foreach ($forms as $fm): ?>
								<?php if($fm->idcuestionario != 4): ?>
									<option value="<?php echo $fm->idcuestionario; ?>" >
										<?php echo $fm->nombre_cuestionario; ?>
									</option>
								<?php endif; ?>
							<?php endforeach;  ?>
						</select>
					</div>

					<br>
					<h3>Departamento </h3>

					<div class="form-row">
						<?php if($this->ion_auth->is_admin()): ?>
							<select id="iddepartamento" name="iddepartamento" class="form-control simple " >
								<option value="0" >Seleccione una opcion</option>
								<?php foreach ($dep as $d): ?>
									<option value="<?php echo $d->iddepartamento; ?>">
										<?php echo $d->nombre_departamento;?>
									</option>
								<?php endforeach; ?>
							</select>
						<?php elseif ($this->ion_auth->in_group(2)): ?>
							<input class="form-control" value="<?php echo $this->session->departamento;?>" readonly >
							<input type="hidden" id="iddepartamento" name="iddepartamento"
								   value="<?php echo $this->session->iddepartamento; ?>"
							>
						<?php endif; ?>

					</div>

					<br>
					<h3>Tipo de Medio </h3>
					<div class="form-row">
						<select id="idtipomedio" name="idtipomedio" class="form-control simple"  >
							<option value="0" >Seleccione una opcion</option>
							<?php foreach ($tipo_medio as $tm): ?>
								<option value="<?php echo $tm->idtipomedio; ?>" >
									<?php echo $tm->nombre_tipo; ?>
								</option>
							<?php endforeach;  ?>
						</select>
					</div>

					<br>
					<h3>Medio de Comunicación </h3>
					<div class="form-row">
						<select id="idmedio" name="idmedio" class="form-control simple"  >
							<option value="0">Seleccione una opcion</option>

							<?php /*foreach ($medio as $m): */?><!--
								<option value="<?php /*echo $m->idmedio;*/?>">
									<?php /*echo $m->nombre_medio; */?>
								</option>
							--><?php /*endforeach; */?>
						</select>
					</div>

					<br>
					<h3>Actor </h3>
					<div class="form-row">
						<select id="idactor" name="idactor" class="form-control simple" >
							<option value="0" >Seleccione una opcion</option>
							<?php foreach ($actor as $a): ?>
								<option value="<?php echo $a->idactor;?>">
									<?php echo $a->nombre_actor; ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>

					<br>
					<h3>Universidad </h3>
					<div class="form-row">
						<?php if($this->ion_auth->is_admin()): ?>
							<select id="iduniversidad" name="iduniversidad" class="form-control simple"  >
								<option value="0" >Seleccione una opcion</option>
								<?php foreach ($universidad as $u): ?>
									<?php if($u->iduniversidad != 1): ?>
										<option value="<?php echo $u->iduniversidad; ?>">
											<?php echo $u->nombre_universidad;?>
										</option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
						<?php elseif ($this->ion_auth->in_group(2)): ?>
							<input class="form-control" value="<?php echo $un->nombre_universidad;?>" readonly 	>
							<input type="hidden" id="iduniversidad" name="iduniversidad"
								   value="<?php echo $un->iduniversidad; ?>"
							>
						<?php endif; ?>

					</div>

					<br>
					<h3>Tema </h3>
					<div class="form-row">
						<select id="idtema" name="idtema" class="form-control simple" >
							<option value="0" >Seleccione una opcion</option>
							<?php foreach ($tema as $tm): ?>
								<option value="<?php echo $tm->idtema; ?>" >
									<?php echo $tm->nombre_tema;?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>

					<br>
					<h3>Subtema </h3>
					<div class="form-row">
						<select id="idsubtema" name="idsubtema" class="form-control simple" >
							<option value="0">Seleccione una opcion</option>
							<?php /*foreach ($stema as $st): */?><!--
								<option value="<?php /*echo $st->idsubtema;*/?>" >
									<?php /*echo $st->nombre_subtema;*/?>
								</option>
							--><?php /*endforeach; */?>
						</select>
					</div>
					<br>



				</div>

				<?php echo form_close(); ?>

			</div>
		</div>
	</div>
	<br>

</main>

