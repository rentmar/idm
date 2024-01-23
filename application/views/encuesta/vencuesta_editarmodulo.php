<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores Caja_de_datos">
				<div id="esquinas_redondeadas">
					<div id="Caja_de_orden" class="Caja_de_datos">
						<h3 id="Título_central"> Editar Modulo </h3>
					</div>
					<div id="Caja_de_datos" class="Caja_de_datos">
						<?php echo form_open('encuesta/procesarEditarModulo/')?>
						<div class="form-group">
							<input type="hidden" name="idmodulo" id="idmodulo"
								value="<?php echo $modulo->iduimodulo ?>"
							>

						</div>

						<div class="form-group">
							<label for="usuario" >
								Nombre del Modulo
								<span class="text-danger"> * </span>
							</label>
							<input required type="text" id="nombre_modulo"
								   class="form-control" name="nombre_modulo"
									value="<?echo $modulo->uinombre_modulo;  ?>"
							>
						</div>
						<div class="form-group">
							<label for="usuario" >
								Orden
								<span class="text-danger"> * </span>
							</label>
							<input required type="number" min="1" max="100"
								   id="orden_modulo" class="form-control"
								   value="<?php echo $modulo->uiorden_modulo;  ?>"
								   name="orden_modulo">
						</div>
						<div class="form-group">
							<label for="grupo" >
								Encuesta a la que pertenece:
							</label>
							<select required id="idencuesta" name="idencuesta" class="form-control">
								<option value="" >Seleccione una Encuesta </option>
								<?php foreach ($encuestas as $e): ?>
									<?php if($e->iduiencuesta == $modulo->rel_iduiencuesta ): ?>
									<option selected value="<?php echo $e->iduiencuesta;?>" ><?php echo $e->uinombre_encuesta;  ?></option>
									<?php else:  ?>
										<option  value="<?php echo $e->iduiencuesta;?>" ><?php echo $e->uinombre_encuesta;  ?></option>

									<?php endif;  ?>
								<?php endforeach; ?>
							</select>
						</div>

						<div class="form-group">
							<input type="submit" id="BOTON" value="APLICAR">
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



