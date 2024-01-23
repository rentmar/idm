<main role="main">
	<br>
	<div class="container" >
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<?php echo form_open('repositorio/noticias'); ?>
				<div class="contenedor_filtros">
				</div>
				<div class="contenedor">
					<div id="caja_boton">
						<div id="contenedor-submit">
							<a href=""><input type="submit" class="BOTON" value="BUSCAR"></a>
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
								<label for="fecha_fin" >Final:</label>
								<input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required >
							</div>
						</div>
					</div>

					<br>

					<h3>Ambito de Registro </h3>
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
					<h3>Tema </h3>
					<div class="form-row">
						<select id="tema" name="idtema" class="form-control simple" >
							<option value="0" >Seleccione una opcion</option>

						</select>
					</div>

					<br>
					<h3>Departamento </h3>

					<div class="form-row">
							<select id="iddepartamento" name="iddepartamento" class="form-control simple " >
								<option value="0" >Seleccione una opcion</option>
								<?php foreach ($dep as $d): ?>
									<option value="<?php echo $d->iddepartamento; ?>">
										<?php echo $d->nombre_departamento;?>
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
	<br>
	<br>
</main>
