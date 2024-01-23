<main role="main">
	<br>
	<div class="container" >
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores Caja_de_datos">

				<div id="esquinas_redondeadas">
					<div id="Caja_de_orden" class="">
						<h3 class="text-center" >
							Modificar Datos del Usuario: <?php echo $usuario->username; ?>
						</h3>
					</div>
					<hr>
					<div id="Caja_de_datos" class="">
						<?php echo form_open('usuarios/procesarUsrLog');?>
						<div class="form-group">
							<label for="nombre" >Nombre<span class="text-danger"> *</span></label>
							<input id="nombre" name="nombre" class="form-control cuadro"
								   value="<?php echo $usuario->first_name;?>"  required >
							<input type="hidden" id="idusuario" name="idusuario"
								   value="<?php echo $usuario->id;?>" >
						</div>
						<div class="form-group">
							<label for="apellido" >Apellido<span class="text-danger"> *</span></label>
							<input id="apellido" name="apellido" class="form-control cuadro"
								   value="<?php echo $usuario->last_name;?>" required>
						</div>
						<div class="form-group">
							<label for="apellido" >Carnet de Identidad</label>
							<input id="carnet" name="carnet" class="form-control cuadro"
								   value="<?php echo $usuario->carnet_identidad;?>" >
						</div>
						<!--<div class="form-group">
							<label for="" >Departamento</label>
							<select id="departamento" name="departamento" class="form-control" >
								<option value="1">La Paz</option>
								<option value="2">Oruro</option>
							</select>
						</div>-->
						<div class="form-group">
							<label for="direccion">Direccion</label>
							<input id="direccion" name="direccion" class="form-control cuadro"
								   value="<?php echo $usuario->direccion;?>" >
						</div>
						<div class="form-group">
							<label for="ubicacion">Ubicacion</label>
							<input id="ubicacion" name="ubicacion" class="form-control cuadro"
								   value="<?php echo $usuario->geolocalizacion; ?>"  >
						</div>
						<div class="form-group">
							<button type="submit" class="boton btn btn-primary">Modificar</button>
							<a href="<?php echo site_url('/')?>" class="btn btn-danger botonsimple " role="button" >Cancelar</a>
						</div>
						<?php echo form_close(); ?>
						<br>
					</div>

				</div>

			</div>
		</div>
	</div>

<br>
</main>
