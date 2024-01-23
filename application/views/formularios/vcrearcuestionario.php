<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<div id="esquinas_redondeadas">
					<div id="Caja_de_orden" class="Caja_de_datos">
						<h3 id="Título_central"> Agregar Nuevo Formulario</h3>
					</div>
					<div id="Caja_de_datos" class="Caja_de_datos">

						<?php echo form_open('formulario/procesarCrearFOrmulario') ?>
							<div class="form-group">
								<label for="idformulario">Formulario:</label>
								<select id="idformulario" name="idformulario" class="form-control">
									<?php foreach ($formularios_base as $f): ?>
									<option value="<?php echo $f->idformulario;  ?>">
										<?php echo $f->form_nombre?>
									</option>
									<?php endforeach; ?>
								</select>
							</div>

							<div class="form-group">
								<label for="idciudad">Ciudad:</label>
								<select class="form-control " id="idciudad" name="idciudad" required>
									<option value="" >Seleccione una Ciudad</option>
									<?php foreach ($ciudad as $c): ?>
										<option value="<?php echo $c->idciudad; ?>">
											<?php echo $c->nombre_ciudad; ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<label for="idzona">Zona:</label>
								<select class="form-control " id="idzona" name="idzona" required>
									<option value="" >Seleccione una Zona</option>

								</select>
							</div>
							<div class="form-group">
								<label for="idlugar">Lugar:</label>
								<select class="form-control" id="idlugar" name="idlugar" required>
									<option value="" >Seleccione un lugar</option>
									<?php foreach ($lugar as $c): ?>
										<option value="<?php echo $c->idlugar; ?>">
											<?php echo $c->nombre_lugar; ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<label for="nombre_lugar">Nombre del Lugar:</label>
								<input type="text" class="form-control" id="nombre_lugar" name="nombre_lugar" placeholder="Escriba el nombre del lugar" required>
							</div>
							<div class="form-group">
								<label for="fecha_registro">Fecha:</label>
								<input type="date" class="form-control" id="fecha_registro" name="fecha_registro"  required>
							</div>
							<div>
								<input type="text" name="idusuario" id="idusuario" value="<?php echo $usuario->id;?>">
								<input type="text" name="latitud_f" id="latitud_f">
								<input type="text" name="longitud_f" id="longitud_f" >
							</div>

							<br><br>
							<input type="submit" id="BOTON" value="CREAR">
							<a href="<?php echo site_url('inicio/');?>"><input type="button" class="BOTONROJO" value="CANCELAR"></a>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
</main>

<script>var baseurl = "<?php echo site_url(); ?>";</script>






