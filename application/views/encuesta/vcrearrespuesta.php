<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<div id="esquinas_redondeadas">
					<div id="Caja_de_orden" class="Caja_de_datos">
						<h3 id="Título_central"> Crear Nueva Respuesta</h3>
					</div>
					<div id="Caja_de_datos" class="Caja_de_datos">
						<form action="<?php echo site_url('Encuesta/agregarRespuestaUI');?>" method="post">
							<br>
							<label for="nombre_pregunta" class="form-group">Definir Repuesta </label>
							<span class="rojo"> * </span>
							<br>
							<input type="text" id="cuadro" name="nombre_respuesta"  required>
							<br><br>
							<br><br>
							<input type="submit" id="BOTON" value="CREAR">
							<a href="<?php echo site_url('Encuesta/respuestaUI');?>"><input type="button" class="BOTONROJO" value="CANCELAR"></a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
</main>


