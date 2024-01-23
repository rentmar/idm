<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<?php echo form_open('encuesta/procesarConsulta'); ?>
				<div class="contenedor_filtros">
				</div>
				<div class="contenedor">
					<div id="caja_boton">
						<div id="contenedor-submit">
							<a href=""><input type="submit" class="BOTON" value="GENERAR"></a>
						</div><br>
						<div id="contenedor-submit">
							<a href="<?php echo site_url('encuesta/encuestaInicio');?>"><input type="" class="BOTONROJO" value="CANCELAR"></a>
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
						<!--<h3>Intervalo de fecha </h3>
						<div class="form-row">
							<div class="col">
								<label for="fecha_inicio" >Inicial:</label>
								<input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required >
							</div>
							<div class="col">
								<label for="fech_fin" >Final:</label>
								<input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required >
							</div>
						</div>-->
					</div>

					<br>

					<h3>Encuesta </h3>
					<div class="form-row">
						<select id="iduiencuesta" name="iduiencuesta" class="form-control simple" required >
							<option value="" >Seleccione una opcion</option>
							<?php foreach ($encuesta as $fm): ?>
									<option value="<?php echo $fm->iduiencuesta; ?>" >
										<?php echo $fm->uinombre_encuesta; ?>
									</option>
							<?php endforeach;  ?>
						</select>
					</div>

					<br>
					<h3>Edad </h3>

					<div class="form-row">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">De:</span>
							</div>
							<input id="edadinicial" name="edadinicial" type="number" min="0" max="200" class="form-control" >
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">A:</span>
							</div>
							<input id="edadfinal" name="edadfinal" type="number" min="0" max="200" class="form-control" >
						</div>

					</div>

					<br>
					<h3>Sexo</h3>
					<div class="form-row">
						<select id="sexo" name="sexo" class="form-control simple"  >
							<option value="0" >Seleccione una opcion</option>
							<option value="1" >MASCULINO</option>
							<option value="2" >FEMENINO</option>

						</select>
					</div>

					<br>
					<h3>Area </h3>
					<div class="form-row">
						<select id="area" name="area" class="form-control simple"  >
							<option value="0">Seleccione una opcion</option>
							<option value="1">Urbana</option>
							<option value="2">Rural</option>

						</select>
					</div>

					<br>
					<h3>Departamento </h3>
					<div class="form-row">
						<select id="iddepartamento" name="iddepartamento" class="form-control simple" >
							<option value="0" >Seleccione una opcion</option>
							<?php foreach ($departamento as $a): ?>
								<option value="<?php echo $a->iddepartamento;?>">
									<?php echo $a->nombre_departamento; ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>




				</div>

				<?php echo form_close(); ?>

			</div>
		</div>
	</div>
	<br>

</main>

