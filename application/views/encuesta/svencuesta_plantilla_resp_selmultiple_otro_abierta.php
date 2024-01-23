<?php if($r->iduipregunta==$p->iduipregunta): ?>
	<?php $sel_multiple_otro_abierto = json_decode($r->pregunta_datos) ; ?>
	<?php //var_dump($sel_multiple_otro_abierto); ?>
	<?php //var_dump($p); ?>
	<div class="card">
		<div class="card-body">
			<?php foreach ($sel_multiple_otro_abierto as $rp): ?>
				<?php if($rp->idopcion != 0): ?>
					<?php //echo $rp->idopcion."<br>"; ?>
					<?php //echo $rp->literal; ?>
					<?php //echo "<br><br>";?>
					<div class="form-check">
						<label class="form-check-label">
							<input type="checkbox"
								   id="pregunta<?php echo $p->iduipregunta; ?>"
								   name="pregunta<?php echo $p->iduipregunta; ?>[]"
								   class="form-check-input"
								   value="<?php echo $rp->literal; ?>">
							<?php echo $rp->literal; ?>
						</label>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
			<div class="form-check">
				<label class="form-check-label">
					<input type="checkbox"
						   id="pregunta<?php echo $p->iduipregunta; ?>"
						   name="pregunta<?php echo $p->iduipregunta; ?>[]"
						   class="form-check-input" value="OTRO" >
					OTRO

				</label>
			</div>
			<div class="form-check">
				<input type="text"
					   id="pregunta<?php echo $p->iduipregunta; ?>otro"
					   name="pregunta<?php echo $p->iduipregunta; ?>otro"
					   class="form-control"
					   placeholder="Especifique otro">
			</div>

		</div>
	</div>


<?php endif; ?>
