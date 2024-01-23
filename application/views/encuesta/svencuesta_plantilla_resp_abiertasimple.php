<?php if($r->iduipregunta==$p->iduipregunta): ?>
	<?php $input_simple = json_decode($r->pregunta_datos) ; ?>
	<div class="form-group">
		<input type="text" class="form-control"
			   id="pregunta<?php echo $p->iduipregunta; ?>"
			   name="pregunta<?php echo $p->iduipregunta; ?>"
			   placeholder="Escriba su respuesta" >
	</div>
<?php endif; ?>
