<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<div id="esquinas_redondeadas">
					<div id="Caja_de_orden" class="Caja_de_datos">
						<h3 id="Título_central"> Crear Nueva Pregunta</h3>
					</div>
					<div id="Caja_de_datos" class="Caja_de_datos">
						<form action="<?php echo site_url('Encuesta/agregarPreguntaUI');?>" method="post">
							<label for="idseccion" class="form-group"> Elegir Seccion </label>
							<span class="rojo"> * </span>
							<br>
							<select name="idseccion" id="idseccion" class="form-control simple" required >
								<option value="">Elegir Seccion</option>
								<?php foreach ($secciones as $s) {?>
									<option value="<?php echo $s->iduiseccion;?>">
										<?php echo "Encuesta: ".$s->uinombre_encuesta.",Modulo:".$s->rel_iduimodulo.",Seccion".$s->iduiseccion;?>
									</option>
								<?php } ?>
							</select>
							<br><br>
							<label for="idseccion" class="form-group"> Elegir Tipo de pregunta </label>
							<span class="rojo"> * </span>
							<br>
							<select name="idtipopregunta" id="idtipopregunta" class="form-control simple" required >
								<option value="">Seleccionar el tipo de pregunta</option>
								<?php foreach ($tipo_pregunta as $s) {?>
									<option value="<?php echo $s->iduitipopregunta;?>">
										<?php echo $s->nombre_tipopregunta;?>
									</option>
								<?php } ?>
							</select>
							<br><br>
							<label for="nombre_pregunta" class="form-group"> Pregunta </label>
							<span class="rojo"> * </span>
							<br>
							<input type="text" id="cuadro" name="nombre_pregunta"  required>
							<br><br>
							<label for="ordenpregunta" class="form-group"> Orden de Pregunta en la Seccion</label>
							<span class="rojo"> * </span>
							<br>
							<input min="0" type="number" id="cuadro" name="ordenpregunta"  required>
							<br><br>
							<label class="form-group"> Asignar Respuestas </label>
							<span class="rojo"> * </span>
							<br>
							<?php foreach($respuestas as $r) {?>
								<input type="checkbox" id="resp<?php echo $r->iduirespuesta;?>" name="resp<?php echo $r->iduirespuesta;?>"
								value="<?php echo $r->iduirespuesta;?>">
								<label for="resp<?php echo $r->iduirespuesta;?>"><?php echo $r->uinombre_respuesta;?> </label><br>
							<?php } ?>
							<br><br>
							<input type="submit" id="BOTON" value="CREAR">
							<a href="<?php echo site_url('Encuesta/preguntaUI');?>"><input type="button" class="BOTONROJO" value="CANCELAR"></a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
</main>


