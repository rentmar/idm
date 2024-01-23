<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores Caja_de_datos">
				<div id="esquinas_redondeadas">
					<div id="Caja_de_orden" class="Caja_de_datos">
						<h3 id="Título_central"> Editar Registro: <?php echo $form->idformcomp.' / '.$form->hash_fc; ?> </h3>
					</div>
					<div id="Caja_de_datos" class="Caja_de_datos">
						<?php echo form_open('encuesta/procesarModificarRegistro')?>
						<div class="form-group">
							<input type="hidden" id="idformcomp" name="idformcomp" value="<?php echo $form->idformcomp; ?>">
							<input type="hidden" id="idencuesta" name="idencuesta" value="<?php echo $form->rel_iduiencuesta;?>">
						</div>

						<div class="form-group">
							<label for="nombrearea">
								Area:
								<span class="text-danger"> * </span>
							</label>
							<select id="nombrearea" name="nombrearea" class="form-control" required>
								<option value="">Selecciones un Area</option>
								<?php if($form->area == "urbana"):  ?>
									<option value="urbana" selected>Urbana</option>
									<option value="rural">Rural</option>
								<?php elseif ($form->area == "rural"):  ?>
									<option value="urbana">Urbana</option>
									<option value="rural" selected>Rural</option>
								<?php endif; ?>


							</select>
						</div>

						<div class="form-group">
							<label for="nombrelocalizacion" >
								Ciudad:
								<span class="text-danger"> * </span>
							</label>
							<input required value="<?php echo $form->ciudad;?>" type="text"
								   id="nombreciudad" class="form-control" name="nombreciudad">
						</div>
						<div class="form-group">
							<label for="nombrezona" >
								Zona:
								<span class="text-danger"> * </span>
							</label>
							<input required value="<?php echo $form->zona;?>" type="text"
								   id="nombrezona" class="form-control" name="nombrezona">
						</div>
						<div class="form-group">
							<label for="latitud" >
								Latitud:
								<span class="text-danger"> * </span>
							</label>
							<input required value="<?php echo $form->latidud_fc;?>" type="number" step="any"
								   id="latitud" class="form-control" name="latitud">
						</div>
						<div class="form-group">
							<label for="longitud" >
								Longitud:
								<span class="text-danger"> * </span>
							</label>
							<input required value="<?php echo $form->longitud_fc;?>" type="number" step="any"
								   id="longitud" class="form-control" name="longitud" >
						</div>
						<div class="form-group">
							<input type="submit" id="BOTON" value="EDITAR">
							<a href="<?php echo site_url('encuesta/administrar/'.$form->rel_iduiencuesta);?>">
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

