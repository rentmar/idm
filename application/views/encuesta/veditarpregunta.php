<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<div id="esquinas_redondeadas">
					<div id="Caja_de_orden" class="Caja_de_datos">
						<h3 id="Título_central"> Editar Pregunta</h3>
					</div>
					<div id="Caja_de_datos" class="Caja_de_datos">
						<form action="<?php echo site_url('Encuesta/modificarPreguntaUI/'.$pregunta->iduipregunta);?>" method="post">
							<label for="idseccion" class="form-group"> Elegir Seccion </label>
							<span class="rojo"> * </span>
							<br>
							<select name="idseccion" id="idseccion">
								<option value="">Elegir Seccion</option>
								<?php foreach ($secciones as $s) {?>
									<?php if($pregunta->rel_iduiseccion==$s->iduiseccion) {?>
										<option selected="true" value="<?php echo $s->iduiseccion;?>">
										<?php echo "Encuesta: ".$s->uinombre_encuesta.",Modulo:".$s->rel_iduimodulo.",Seccion".$s->iduiseccion;?>
										</option>
									<?php } ?>
									<?php if($pregunta->rel_iduiseccion!=$s->iduiseccion) {?>
										<option value="<?php echo $s->iduiseccion;?>">
										<?php echo "Encuesta: ".$s->uinombre_encuesta.",Modulo:".$s->rel_iduimodulo.",Seccion".$s->iduiseccion;?>
										</option>
									<?php } ?>
								<?php } ?>
							</select>
							<br><br>
							<label for="idtipo" class="form-group"> Elegir Tipo de Pregunta </label>
							<span class="rojo"> * </span>
							<br>
							<select name="idtipo" id="idtipo">
								<option value="">Elegir Tipo Pregunta</option>
								<?php foreach ($tipos as $t) {?>
									<?php if($tipo->rel_iduitipopregunta==$t->iduitipopregunta) {?>
										<option selected="true" value="<?php echo $t->iduitipopregunta;?>">
										<?php echo $t->nombre_tipopregunta;?>
										</option>
									<?php } ?>
									<?php if($tipo->rel_iduitipopregunta!=$t->iduitipopregunta) {?>
										<option value="<?php echo $t->iduitipopregunta;?>">
										<?php echo $t->nombre_tipopregunta;?>
										</option>
									<?php } ?>
								<?php } ?>
							</select>
							<br><br>
							<label for="nombre_pregunta" class="form-group"> Pregunta </label>
							<span class="rojo"> * </span>
							<br>
							<input type="text" id="cuadro" name="nombre_pregunta" value="<?php echo $pregunta->uipregunta_nombre;?>" required>
							<br><br>
							<label for="ordenpregunta" class="form-group">Orden Pregunta en la Seccion</label>
							<span class="rojo"> * </span>
							<br>
							<input type="number" id="cuadro" name="ordenpregunta" value="<?php echo $pregunta->uiorden_pregunta;?>" required>
							<br><br>
							<?php $e=0;foreach($respuestas as $r) {?>
								<?php foreach ($respuestas_pregunta as $rp) {?>
									<?php if ($r->iduirespuesta==$rp->rel_iduirespuesta) {
										$e=1;
									 break; } ?>
									<?php if ($r->iduirespuesta!=$rp->rel_iduirespuesta) { 
										$e=0;
									 } ?>
								<?php } ?>
								<?php if($e==1) { ?>
									<input checked="true" type="checkbox" id="resp<?php echo $r->iduirespuesta;?>" name="resp<?php echo $r->iduirespuesta;?>"
									value="<?php echo $r->iduirespuesta;?>">
									<label for="resp<?php echo $r->iduirespuesta;?>"><?php echo $r->uinombre_respuesta;?> </label><br>
								<?php } ?>
								<?php if($e==0) { ?>
									<input type="checkbox" id="resp<?php echo $r->iduirespuesta;?>" name="resp<?php echo $r->iduirespuesta;?>"
									value="<?php echo $r->iduirespuesta;?>">
									<label for="resp<?php echo $r->iduirespuesta;?>"><?php echo $r->uinombre_respuesta;?> </label><br>
								<?php } ?>
							<?php } ?>
							<br><br>
							<input type="submit" id="BOTON" value="EDITAR">
							<a href="<?php echo site_url('Encuesta/preguntaUI');?>"><input type="button" class="BOTONROJO" value="CANCELAR"></a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
</main>


