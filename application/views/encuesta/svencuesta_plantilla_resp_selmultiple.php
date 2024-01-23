<?php if($r->iduipregunta==$p->iduipregunta): ?>
	<div class="form-check">
		<label class="form-check-label" for="radio">
			<input type="checkbox" class="form-check-input" id="pregunta<?php echo $p->iduipregunta; ?>" name="pregunta<?php echo $p->iduipregunta; ?>[]" value="<?php echo $r->iduirespuesta; ?>">
			<?php echo $r->uinombre_respuesta; ?>
		</label>
	</div>
<?php endif; ?>
