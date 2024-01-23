<br>
	<div class="container">
		<div class="row">
			<div>
				<h1>Grafico Cuerdas </h1>
			</div>
		</div>
		<br>
		<?php echo form_open('Graficos/llenarDatosChordXml');?>
		<div class="row">
			<div class="col-sm-2">
				<button type="submit" name="accion" value="1" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
					Actores
				</button>
			</div>
			<!--<div class="col-sm-2">
				<button type="submit" name="accion" value="2" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
					NO definido
				</button>
			</div>-->
			<div class="col-sm-2">
				<a class="btn btn-danger" href="<?php echo site_url('Graficos'); ?>">Atras</a>
			</div>
		</div>
		<?php echo form_close();?>
		<br>
	</div>