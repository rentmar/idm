<br>
	<div class="container">
		<div class="row">
			<div>
				<h1>Graficar BubbleMaps</h1>
			</div>
		</div>
		<br>
		<?php echo form_open('Graficos/llenarDatosBubbleXml');?>
		<div class="row">
				<label for="fecha_inicio">Fecha Inicio:</label>
				<input type="date" id="fecha_inicio" name="fecha_inicio"  required >
				<label for="fecha_fin">Fecha Fin:</label>
				<input type="date" id="fecha_fin" name="fecha_fin"  required >
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2">
				<button type="submit" name="accion" value="1" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
					Cuestionarios
				</button>
			</div>
			<div class="col-sm-2">
				<button type="submit" name="accion" value="2" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
					Temas
				</button>
			</div>
			<div class="col-sm-2">
				<!--<button type="submit" name="accion" value="3" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
					Actores
				</button>-->
			</div>
			<div class="col-sm-2">
				<a class="btn btn-danger" href="<?php echo site_url('Graficos'); ?>">Atras</a>
			</div>
		</div>
		<?php echo form_close();?>
		<br>
	</div>

		