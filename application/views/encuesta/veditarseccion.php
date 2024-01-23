<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores Caja_de_datos">
				<div id="esquinas_redondeadas"><br>
					<div id="Caja_de_orden" class="Caja_de_datos">
						<h3 id="Título_central"> Editar Seccion </h3>
					</div>
					<div id="Caja_de_datos" class="Caja_de_datos">
						<?php echo form_open('encuesta/edicionEnUiseccion/')?>

						<div class="form-group">
							<label for="usuario">Orden de seccion:</label>
							<input type="text" id="ordenDseccion9" class="form-control" name="ordenDseccion9" value="<?php echo $seccion0[0]->uiorden_seccion;?>" readonly>
							<input required type="number" id="ordenDseccion" class="form-control" name="ordenDseccion" min="1" required>
							<input type="hidden" id="ordenDseccion0" name="ordenDseccion0" value="<?php echo $seccion0[0]->iduiseccion;?>">
						</div>
						<div class="form-group">
							<label for="grupo">Modulo:</label>
							<input type="text" id="ordenDseccion8" class="form-control" name="ordenDseccion8" value="<?php echo $seccion1[0]->uinombre_modulo;?>" readonly>
							<select required id="modulo" name="modulo" class="form-control" required>
								<option value="" selected disabled hidden></option>
								<?php foreach ($modulos as $e): ?>
									<option value="<?php echo $e->iduimodulo;?>" ><?php echo $e->uinombre_modulo;  ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label for="grupo">Subtema:</label>
							<input type="text" id="ordenDseccion7" class="form-control" name="ordenDseccion7" value="<?php echo $seccion2[0]->nombre_subtema;?>" readonly>
							<select required id="subtema" name="subtema" class="form-control" required>
								<option value="" selected disabled hidden></option>
								<?php foreach ($subtemas as $e): ?>
									<option value="<?php echo $e->idsubtema;?>" ><?php echo $e->nombre_subtema;  ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<br><br>

						<div class="form-group">
							<input type="submit" id="BOTON" value="ACTUALIZAR">
							<a href="<?php echo site_url('Encuesta/seccionUI');?>">
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