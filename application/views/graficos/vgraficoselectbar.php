<br>
	<div class="container">
		<div class="row">
			<div>
				<h1>Graficar Jerarquia de Barras </h1>
			</div>
		</div>
		<br>
		<?php echo form_open('Graficos/llenarDatosBarXml');?>
		<div class="row">
			<div class="col-sm-2">
				<button type="submit" name="accion" value="1" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
					Nacional
				</button>
			</div>
			<div class="col-sm-2">
				<button type="submit" name="accion" value="2" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
					Departamental
				</button>
			</div>
			<div class="col-sm-2">
				<a class="btn btn-danger" href="<?php echo site_url('Graficos'); ?>">Atras</a>
			</div>
		</div>
		<?php echo form_close();?>
		<br>
	</div>