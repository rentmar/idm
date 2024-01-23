<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores Caja_de_datos">
				<div id="esquinas_redondeadas">
					<div id="Caja_de_orden" class="Caja_de_datos">
						<h3 id="Título_central"> Crear Seccion </h3>
					</div>
					<div id="Caja_de_datos" class="Caja_de_datos">
						<?php echo form_open('encuesta/escrituraEnUiseccion/')?>

						<div class="form-group">
							<label for="usuario" >
								Introducir Orden de seccion: 1..n
								<span class="text-danger"> * </span>
							</label>
							<input required type="number" id="ordenDseccion" class="form-control" name="ordenDseccion" min="1" required>
						</div>
						<div class="form-group">
							<label for="grupo" >
								Seleccionar Modulo:
							</label>
							<select id="modulo" name="modulo"  class="form-control simple" required>
								<option value="" >Seleccionar Modulo</option>
								<?php foreach ($modulos as $e): ?>
									<option value="<?php echo $e->iduimodulo;?>" ><?php echo $e->uinombre_modulo;  ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label for="grupo" >
								Seleccionar Subtema:
							</label>
							<select required id="subtema" name="subtema" class="form-control simple" required>
								<option value="" >Seleccionar Subtema</option>
								<?php foreach ($subtemas as $e): ?>
									<option value="<?php echo $e->idsubtema;?>" ><?php echo $e->nombre_subtema;  ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<br><br>

						<div class="form-group">
							<input type="submit" id="BOTON" value="CREAR">
							<a href="<?php echo site_url('inicio');?>">
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


