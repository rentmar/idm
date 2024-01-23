<main role="main">
	<br>
	<div id="esquinas_redondeadas">		
		<div id="Caja_de_orden" class="Caja_de_datos">
			<h3 id="Título_central"> Actualizar Ley</h3>
		</div>
		<div id="Caja_de_datos" class="Caja_de_datos">
			<form action="<?php echo site_url('Ley/actualizarLey/'.$idley); ?>" method="post">
				<select class="combo" id='cuadro' name='idestadoley' required>
					<option value="">Elegir Estado</option>
					<?php foreach ($estados as $e): ?>
					<?php foreach ($estadose as $el) {?>
					<?php $h=1; if ($e->idestadoley==$el->rel_idestadoley) {?>
					<?php $h=0;echo "Si<br>"; break;} ?>
					<?php } ?>
					<?php if ($h==1) {?>
					<option value="<?php echo $e->idestadoley; ?>">
						<?php echo $e->nombre_estadoley; ?>
					</option>
					<?php } ?>
					<?php endforeach; ?>
				</select>
				<div class="form-row">
					<div class="col">
						<hr>
					</div>
				</div>
				<div class="form-group">
					<label>Fecha de la Ley:</label><br>
					<input type="date" id="fechaestado" name="fechaestado" class="form-control">
				</div>
				<div class="form-group">
					<label>Descripcion de la Ley:</label><br>
					<textarea id="titulo" name="titulo" class="form-control" required>
					</textarea>
				</div>
				<div class="form-group">
					<label>Codigo de la Ley:</label><br>
					<input type="text" id="codigo" name="codigo" class="form-control" required>
				</div>
				<div class="form-group">
					<label>URL de la Ley:</label><br>
					<input type="text" id="url" name="url" class="form-control" required>
				</div>
			    <input type="submit" id="BOTON" value="ACTUALIZAR">
				<a href="<?php echo site_url('Ley/');?>"><input type="button" class="BOTONROJO" value="CANCELAR"></a>
			</form>
		</div>
	</div>
</main>
