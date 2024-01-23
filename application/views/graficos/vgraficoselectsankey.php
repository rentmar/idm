<br>
	<div class="container">
		<div class="row">
			<div>
				<h1>Graficar Sankey Encuesta </h1>
			</div>
		</div>
		<br>
		<?php echo form_open('Graficos/llenarDatosSankey');?>
		<div class="row">
			<div class="col-sm-4">
				<select class="form-control" id="idencuestaSank" name="idencuestaSank"  required >
<!--					<option value="0" selected disabled>Seleccione Encuesta</option>-->
					<?php foreach ($encuestas as $e): ?>
					<option value="<?php echo $e->iduiencuesta;?>" >
						<?php echo $e->uinombre_encuesta;?>
					</option>
					<?php endforeach; ?>
				</select>
			</div>
			<button type="submit" name="accion" value="1" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
				Graficar
			</button>
			<div class="col-sm-2">
				<a class="btn btn-danger" href="<?php echo site_url('Graficos'); ?>">Atras</a>
			</div>
		</div>
		<?php echo form_close();?>
		<br>
	</div>