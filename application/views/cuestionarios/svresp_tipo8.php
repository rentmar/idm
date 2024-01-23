<div class="form-group">
	<?php //var_dump($respuesta);?>
	<label for="<?php echo 'pregunta'.$pregunta->codigo_pregunta; ?>"><?php echo $pregunta->ordinal_pregunta.')'.$pregunta->pregunta; ?>:</label>
	<textarea class="form-control" id="<?php echo 'pregunta'.$pregunta->codigo_pregunta; ?>" name="<?php echo 'pregunta'.$pregunta->codigo_pregunta; ?>" rows="4" cols="50"><?php echo $respuesta->respuesta;?></textarea>
</div>
