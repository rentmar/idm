<main role="main">
	<br>
	<div class="container" >
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores Caja_de_datos">

				<div id="esquinas_redondeadas">
					<div id="Caja_de_orden" class="">
						<h3 class="text-center" >
							Modificar Contraseña del Usuario: <?php echo $usuario->username; ?>
						</h3>
					</div>
					<hr>
					<div id="Caja_de_datos" class="">
						<?php echo form_open('usuarios/procesarEditPwd');?>
						<div class="form-group">
							<label for="nombre" >Nombre<span class="text-danger"> *</span></label>
							<input id="nombre" name="nombre" class="form-control cuadro"
								   value="<?php echo $usuario->first_name;?>"  readonly >
							<input type="hidden" id="idusuario" name="idusuario"
								   value="<?php echo $usuario->id;?>" >
						</div>
						<div class="form-group">
							<label for="apellido" >Apellido<span class="text-danger"> *</span></label>
							<input id="apellido" name="apellido" class="form-control cuadro"
								   value="<?php echo $usuario->last_name;?>" readonly >
						</div>
						<div class="form-group">
							<label for="pass" >Contraseña</label>
							<input type="password" id="pass" name="pass" class="form-control cuadro" placeholder="Nueva Contraseña" >
						</div>
						<div class="form-group">
							<label for="pass1">Confirmar Contraseña</label>
							<input type="password" id="pass1" name="pass1" class="form-control cuadro" placeholder="Confirmar Contraseña" >
						</div>
						<div class="form-group">
							<button type="submit" class="boton btn btn-primary">Enviar</button>
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
