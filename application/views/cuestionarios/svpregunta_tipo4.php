<div class="form-group">
	<label for=""><?php echo $pregunta->ordinal_pregunta.')'.$pregunta->pregunta;?></label>
	<div>
		<div class="custom-control custom-radio custom-control-inline">
			<input type="radio" class="custom-control-input" id="<?php echo 'opcionarea1'.$pregunta->idpregunta; ?>" name="<?php echo 'pregunta'.$pregunta->codigo_pregunta.'-area'; ?>">
			<label class="custom-control-label" for="<?php echo 'opcionarea1'.$pregunta->idpregunta; ?>">Urbana</label>
		</div>
		<div class="custom-control custom-radio custom-control-inline">
			<input type="radio" class="custom-control-input" id="<?php echo 'opcionarea2'.$pregunta->idpregunta; ?>" name="<?php echo 'pregunta'.$pregunta->codigo_pregunta.'-area'; ?>">
			<label class="custom-control-label" for="<?php echo 'opcionarea2'.$pregunta->idpregunta; ?>">Rural</label>
		</div>
	</div>
	<div>
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="<?php echo 'opcion1'.$pregunta->idpregunta; ?>" name="<?php echo 'pregunta'.$pregunta->codigo_pregunta; ?>" >
			<label class="custom-control-label" for="<?php echo 'opcion1'.$pregunta->idpregunta; ?>">Si</label>
		</div>
		<div class="custom-control custom-radio">
			<input type="radio" class="custom-control-input" id="<?php echo 'opcion2'.$pregunta->idpregunta; ?>" name="<?php echo 'pregunta'.$pregunta->codigo_pregunta; ?>" >
			<label class="custom-control-label" for="<?php echo 'opcion2'.$pregunta->idpregunta; ?>">No</label>
		</div>
	</div>
</div>
