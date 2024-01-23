<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores Caja_de_datos">
				<div id="esquinas_redondeadas">
					<div id="Caja_de_orden" class="Caja_de_datos">
						<h3 id="Título_central"> Editar Localizacion </h3>
					</div>
					<div id="Caja_de_datos" class="Caja_de_datos">
						<?php echo form_open('encuesta/modificarLocalizacion/'.$localizacion->idgeolocal)?>

						<div class="form-group">
							<label for="nombrelocalizacion" >
								Nombre de Localizacion
								<span class="text-danger"> * </span>
							</label>
							<input required value="<?php echo $localizacion->nombre_geolocal;?>" type="text" id="nombrelocalizacion" class="form-control" name="nombrelocalizacion">
						</div>
						<div class="form-group">
							<label for="latitud" >
								Latitud
								<span class="text-danger"> * </span>
							</label>
							<input required value="<?php echo $localizacion->latitud_geolocal;?>" type="text" id="latitud" class="form-control" name="latitud">
						</div>
						<div class="form-group">
							<label for="longitud" >
								Longitud
								<span class="text-danger"> * </span>
							</label>
							<input required value="<?php echo $localizacion->longitud_geolocal;?>" type="text" id="longitud" class="form-control" name="longitud">
						</div>
						<div class="form-group">
							<input type="submit" id="BOTON" value="EDITAR">
							<a href="<?php echo site_url('encuesta/geolocalizacionUI');?>">
								<input type="button" class="BOTONROJO" value="CANCELAR">
							</a>
						</div>
						<?php echo form_close()?>
					</div>
				</div>
			</div>

		</div>
	</div>
	<br>



</main>


