<div class="form-group">
	<?php var_dump($respuesta);?>
	<label for="<?php echo 'pregunta'.$pregunta->codigo_pregunta; ?>"><?php echo $pregunta->ordinal_pregunta.')'.$pregunta->pregunta; ?>:</label>
	<input id="<?php echo 'pregunta'.$pregunta->codigo_pregunta; ?>" name="<?php echo 'pregunta'.$pregunta->codigo_pregunta; ?>" type="text" class="form-control" value="<?php echo $respuesta->respuesta; ?>">
</div>
