<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<div id="esquinas_redondeadas">
					<div id="Caja_de_orden" class="Caja_de_datos">
						<h3 id="Título_central"> Crear Nueva Encuesta</h3>
					</div>
					<div id="Caja_de_datos" class="Caja_de_datos">
						<?php echo form_open('encuesta/procesarCrearEncuesta');?>
							<label for="nombre_cuestionario" class="form-group"> Nombre de la Encuesta </label>
							<span class="rojo"> * </span>
							<br>
							<input type="text" id="cuadro" name="nombre_cuestionario"  required>
							<br><br>
							<input type="submit" id="BOTON" value="CREAR">
							<a href="<?php echo site_url('encuesta/');?>"><input type="button" class="BOTONROJO" value="CANCELAR"></a>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
</main>
