<?php if($r->iduipregunta==$p->iduipregunta): ?>
	<?php $sel_multiple_cuantificada = json_decode($r->pregunta_datos) ; ?>
	<div class="form-group">
		<div class="form-group">
			<p class="bg-success text-white">
				Nota: Si la persona No sabe / No responde tiquea la casilla cuadrada pequeña.
			</p>
		</div>
	</div>
	<div class="form-group">
		<?php foreach ($sel_multiple_cuantificada as $rp): ?>
			<?php if($rp->idopcion != 8): ?>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<div class="input-group-text">
						<input type="checkbox"
							   id="pregunta<?php echo $p->iduipregunta; ?>"
							   name="pregunta<?php echo $p->iduipregunta; ?>[]"
							   value="<?php echo $rp->idopcion;?>"
						>
						<?php echo $rp->literal;?>
					</div>
				</div>
				<input type="number"
					   id="opcion<?php echo $rp->idopcion; ?>text"
					   name="opcion<?php echo $rp->idopcion; ?>text"
					   min="1" max="5" class="form-control"
					   value="1" required
					    >
			</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>

<?php endif; ?>
