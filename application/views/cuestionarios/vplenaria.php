<main>
	<br><br>
	<?php echo validation_errors(); ?>
	<?php
	/** @noinspection PhpLanguageLevelInspection */
	$atr_form =[
		'id' => 'formulario_plenaria' ,
	]
	;?>
	<?php echo form_open('plenaria/capturaDatos', $atr_form);?>

	<div class="contenedores_divididos">
		<div class="contenedor_superior3" id="contenedor_pequeño">
		</div>
		<div class="contenedor_inferior">
			<h3 id="Título_formulario"> Seguimiento Agenda Legislativa </h3>
		</div>
	</div>
	<br>

	<div class="contenedores">
		<label for="instanciaseguimientoplenaria">Instancia de seguimiento:</label><br>
		<select id="instanciaseguimientoplenaria" name="instanciaseguimientoplenaria" class="form-control" required>
			<option value="" >Seleccione una instancia</option>
			<?php foreach ($instancias as $in): ?>
			<option value="<?php echo $in->idinsseg; ?>"><?php echo $in->instancia; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<br>

	<div id="instancia_seguimiento_secundaria" >

	</div>
	<br>

	<div class="contenedores">
		<label for="fecha">Introduzca la fecha de la plenaria:</label><br>
		<input type="date" id="fecha_plenaria" name="fecha_plenaria" value="" required >
		<input type="hidden" id="idcuestionario" name="idcuestionario" value="<?php echo $idformulario; ?>" >
		<input type="hidden" id="idusuario" name="idusuario" value="<?php echo $usuario->id;?>" >
	</div>
	<br>

	<div class="contenedores">
		<label for="titular">Puntos de la agenda:</label><br>
		<input type="text" id="puntos_agenda" name="puntos_agenda" required class="form-control"
			   value=""
		>
	</div>
	<br>

	<div class="contenedores">
		<label for="titular">Cumplimiento de la agenda(%):</label><br>
		<input type="number" id="agenda_cumplida" name="agenda_cumplida" required class="form-control"
			   min="0" max="100" step="1" value="0">
	</div>
	<br>

	<div class="contenedores">
		<label for="titular">Descripcion del asunto sin tratamiento:</label><br>
		<input type="text" id="puntos_pendientes" name="puntos_pendientes" required class="form-control"
			   value=""
		>
	</div>
	<br>

	<div class="contenedores">
		<label for="titular">Describa puntos varios (maximo 30 palabras):</label><br>
		<input type="text" id="puntos_varios" name="puntos_varios" required class="form-control"
			   value=""
		>
	</div>
	<br>

	<div class="contenedores">
		<label for="titular">Se incluyó el tratamiento de una norma en varios?</label><br>
		<div class="custom-control custom-radio custom-control-inline">
			<input type="radio" class="custom-control-input" id="tratamiento1" name="tratamiento" value="1" checked >
			<label class="custom-control-label" for="tratamiento1">Si</label>
		</div>
		<div class="custom-control custom-radio custom-control-inline">
			<input type="radio" class="custom-control-input" id="tratamiento2" name="tratamiento" value="0">
			<label class="custom-control-label" for="tratamiento2">No</label>
		</div>

	</div>
	<div id="norma" class="contenedores">
		<label for="titular">Número y nombre de la norma que ingresó sin estar en la agenda:</label><br>
		<input type="text" id="norma_extraordinaria" name="norma_extraordinaria" required class="form-control" value="">
	</div>
	<br>

	<div class="contenedores" >
		<label for="titular">Especificacion del tipo de plenaria:</label><br>
		<div id="tipos_de_plenaria">

		</div>

	</div>
	<br>

	<div class="contenedores">
		<label for="monitores">Observaciones:</label><br>
		<textarea class="form-control" rows="4" id="monitores" name="monitores"></textarea>
	</div>
	<br>


	<div id="contenedor-submit">
		<button id="BOTON" type="submit" name="action" value="1" >
			SIGUIENTE
		</button>
		<a href="<?php echo site_url('');?>">
			<input type="button" class="BOTON" value="CANCELAR">
		</a>
	</div>

	<br>
	<?php echo form_close(); ?>

</main>

<!-- The Modal -->
<div class="modal fade" id="preenvioplenaria">
	<div class="modal-dialog modal-xl modal-dialog-scrollable ">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header bg-info text-white ">
				<h4 class="modal-title">Plenaria a Registrar</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<!-- Modal body -->
			<div class="modal-body">
				<div class="container">
					<?php echo form_open('plenaria/crearPlenaria', ['id' => 'formulario_plenaria_preenvio',]); ?>
					<div class="form-group">
						<input class="form-control" type="hidden" id="idcuestionario_pre" name="idcuestionario_pre">
						<input class="form-control" type="hidden" id="idusuario_pre" name="idusuario_pre" >
					</div>
					<div class="form-group">
						<label for="fecha_plenaria_pre">Fecha de la plenaria:</label>
						<input type="text" class="form-control" id="fecha_plenaria_pre" name="fecha_plenaria_pre">
						<input type="hidden" id="fecha_plenaria_unix_pre" name="fecha_plenaria_unix_pre">
					</div>
					<div class="form-group">
						<label for="instancia_seguimiento_pre">Instancia de seguimiento:</label>
						<input type="text" class="form-control" id="instancia_seguimiento_pre" name="instancia_seguimiento_pre" required>
						<input type="hidden" class="form-control" id="idinstancia_seg_pre" name="idinstancia_seg_pre" >
					</div>
					<div id="instancia_secundaria_plenaria" class="form-group">

					</div>
					<div class="form-group">
						<label for="puntos_agenda_pre">Puntos de la agenda</label>
						<textarea class="form-control" rows="5" id="puntos_agenda_pre" name="puntos_agenda_pre" required></textarea>
					</div>
					<div class="form-group">
						<label for="cumlimiento_agenda_pre">Cumplimiento de la agenda:</label>
						<input type="number" class="form-control" id="cumlimiento_agenda_pre" name="cumlimiento_agenda_pre" required >
					</div>
					<div class="form-group">
						<label for="asunto_sintratar_pre">Descripcion del asunto sin tratamiento:</label>
						<textarea class="form-control" rows="4" id="asunto_sintratar_pre" name="asunto_sintratar_pre" required></textarea>
					</div>
					<div class="form-group" >
						<label for="puntos_varios_pre" >Describa puntos varios:</label>
						<textarea class="form-control" rows="4" id="puntos_varios_pre" name="puntos_varios_pre" required ></textarea>
					</div>
					<div id="norma_extra_pre" class="form-group">

					</div>
					<div class="form-group">
						<label for="tipo_plenaria_pre" >Especificacion del tipo de plenaria:</label>
						<input type="text" class="form-control" id="tipo_plenaria_pre" name="tipo_plenaria_pre">
						<input type="hidden" class="form-control" id="id_tipo_plenaria_pre" name="id_tipo_plenaria_pre">
					</div>
					<div class="form-group">
						<label for="monitores_pre">Obervaciones:</label><br>
						<textarea class="form-control" rows="4" id="monitores_pre" name="monitores_pre"></textarea>
					</div>
					<br>
				</div>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button id="BOTON" type="submit" name="action" value="1" >
					GUARDAR
				</button>
				<button id="BOTON" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			</div>
			<?php form_close(); ?>
		</div>
	</div>
</div>


<!-- The Modal de alerta TEMAS SIN SELECCIONAR -->
<div class="modal fade" id="tipoplenariasinseleccionar">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header bg-warning">
				<h4 class="modal-title text-white ">Alerta</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				Seleccionar el tipo de plenaria
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button id="BOTON" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>

		</div>
	</div>
</div>



