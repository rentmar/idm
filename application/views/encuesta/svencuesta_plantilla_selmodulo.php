<ul class="nav nav-tabs">
	<?php foreach ($modulos as $m): ?>
		<?php if($m->uiorden_modulo == $orden_mod_min): ?>
			<li class="nav-item">
				<a class="nav-link active" data-toggle="tab" href="#<?php echo 'modulo'.$m->iduimodulo; ?>">
					<?php echo $m->uinombre_modulo; ?>
				</a>
			</li>
		<?php else: ?>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#<?php echo 'modulo'.$m->iduimodulo; ?>">
					<?php echo $m->uinombre_modulo; ?>
				</a>
			</li>
		<?php endif; ?>
	<?php endforeach; ?>
</ul>

