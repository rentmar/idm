<main>
	<br><br>
	<?php echo validation_errors(); ?>
	<?php
	/** @noinspection PhpLanguageLevelInspection */
	$atr_form =[
		'id' => 'formulario_ciudadania_edit' ,
	]
	;?>
	<?php echo form_open('veeduria/capturarEditDatos/', $atr_form);?>
	<div class="contenedores_divididos">
		<div class="contenedor_superior1" id="contenedor_pequeño">
		</div>
		<div class="contenedor_inferior">
			<h3 id="Título_formulario"> <?php echo $formulario->nombre; ?> </h3>
		</div>
	</div>
	<br>

	<div class="contenedores">
		<div class="card">
			<div class="card-header cuest1">
				<h4>
					Datos Generales
				</h4>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label for="">Area:</label>
					<?php //echo $respuestas->area;?>
					<?php if($respuestas->area == 'urbana'): ?>
						<div>
							<div class="custom-control custom-radio custom-control-inline">
								<input checked type="radio" class="custom-control-input" id="<?php echo 'opcionareag1'; ?>" name="areageneral" value="urbana">
								<label class="custom-control-label" for="<?php echo 'opcionareag1'; ?>">Urbana</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" class="custom-control-input" id="<?php echo 'opcionarea2g'; ?>" name="areageneral" value="rural">
								<label class="custom-control-label" for="<?php echo 'opcionarea2g'; ?>">Rural</label>
							</div>
						</div>
					<?php elseif ($respuestas->area == 'rural'): ?>

						<div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" class="custom-control-input" id="<?php echo 'opcionareag1'; ?>" name="areageneral" value="urbana">
								<label class="custom-control-label" for="<?php echo 'opcionareag1'; ?>">Urbana</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input checked type="radio" class="custom-control-input" id="<?php echo 'opcionarea2g'; ?>" name="areageneral" value="rural">
								<label class="custom-control-label" for="<?php echo 'opcionarea2g'; ?>">Rural</label>
							</div>
						</div>

					<?php else: ?>

						<div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" class="custom-control-input" id="<?php echo 'opcionareag1'; ?>" name="areageneral" value="urbana">
								<label class="custom-control-label" for="<?php echo 'opcionareag1'; ?>">Urbana</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" class="custom-control-input" id="<?php echo 'opcionarea2g'; ?>" name="areageneral" value="rural">
								<label class="custom-control-label" for="<?php echo 'opcionarea2g'; ?>">Rural</label>
							</div>
						</div>
					<?php endif; ?>
				</div>
				<div class="form-group">
					<label for="grupo">Grupo:</label>
					<input id="grupo" name="grupo" class="form-control" type="text" value="<?php echo $respuestas->grupo;?>">
				</div>
				<div class="form-group">
					<input id="idusuario" name="idusuario" class="form-control" type="hidden" placeholder="idusuario" value="<?php echo $usuario->id; ?>">
					<input id="idformulario" name="idformulario" class="form-control" type="hidden" value="<?php echo $formulario->idfv ?>">
					<input id="idformresp" name="idformresp" class="form-control" type="hidden" value="<?php echo $formulario->idfvresp; ?>">
				</div>
			</div>

			</div>
		</div>
	</div>
	<br>


	<?php foreach ($secciones as $s): ?>
		<div class="contenedores">
			<div class="card">
				<div class="card-header cuest1">
					<h4>
						<?php echo $s->nombre_seccion; ?>
					</h4>
				</div>
				<div class="card-body">
					<?php foreach ($preguntas as $p): ?>
						<?php $datos['pregunta'] = $p; ?>
						<?php $datos['respuesta'] = $respuestas_encuesta[$p->codigo_pregunta];  ?>
						<?php if($s->idfvsec == $p->idseccion ):?>
							<?php if($p->tipo_pregunta == 1): ?>
								<?php $this->load->view('cuestionarios/svresp_tipo1', $datos); ?>
							<?php elseif($p->tipo_pregunta == 2): ?>
								<?php $this->load->view('cuestionarios/svresp_tipo2', $datos); ?>
							<?php elseif($p->tipo_pregunta == 3): ?>
								<?php $this->load->view('cuestionarios/svresp_tipo3', $datos); ?>
							<?php elseif($p->tipo_pregunta == 4): ?>
								<?php $this->load->view('cuestionarios/svresp_tipo4', $datos); ?>
							<?php elseif($p->tipo_pregunta == 5): ?>
								<?php $this->load->view('cuestionarios/svresp_tipo5', $datos); ?>
							<?php elseif($p->tipo_pregunta == 6): ?>
								<?php $this->load->view('cuestionarios/svresp_tipo6', $datos); ?>
							<?php elseif($p->tipo_pregunta == 7): ?>
								<?php $this->load->view('cuestionarios/svresp_tipo7', $datos); ?>
							<?php elseif($p->tipo_pregunta == 8): ?>
								<?php $this->load->view('cuestionarios/svresp_tipo8', $datos); ?>
							<?php elseif($p->tipo_pregunta == 9): ?>
								<?php $this->load->view('cuestionarios/svresp_tipo9', $datos); ?>
							<?php else: ?>
								<?php ?>
							<?php endif; ?>

						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<br>
	<?php endforeach; ?>
	<div id="contenedor-submit">
		<button id="BOTON" type="submit" name="action" value="1" >
			ENVIAR
		</button>
		<a href="<?php echo site_url('');?>">
			<input type="button" class="BOTON" value="CANCELAR">
		</a>
	</div>
	<?php echo form_close();?>

</main>

