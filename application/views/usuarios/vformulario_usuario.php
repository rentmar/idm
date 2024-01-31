<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<h3 class="text-center">
					Crear Usuario:
					<?php if ($grupo ==1){
						echo 'Administradores';
					}elseif ($grupo == 2){
						echo 'Supervisores';
					} elseif ($grupo == 3){
						echo 'Encuestadores';
					} ?>
				</h3>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<?php if(!empty(validation_errors())): ?>
					<div class="form-group">
						<div class="alert alert-warning">
							<strong>
								<?php echo validation_errors(); ?>
							</strong>
						</div>
					</div>
				<?php endif; ?>
				<?php echo form_open('usuarios/procesarCrear/'.$grupo); ?>
					<div class="form-group">
						<label for="usuario" >
							Nombre de usuario
							<span class="text-danger"> * </span>
						</label>
						<input type="text" id="usuario" class="form-control" name="usuario" required>
					</div>
					<div class="form-group">
						<label for="nombre" >
							Nombre
							<span class="text-danger"> * </span>
						</label>
						<input type="text" id="nombre" name="nombre" class="form-control" required >
					</div>
					<div class="form-group">
						<label for="apellido">
							Apellido
							<span class="text-danger"> * </span>
						</label>
						<input type="text" id="apellido" name="apellido" class="form-control" required >
					</div>
					<div class="form-group">
						<label for="email" >
							Correo electrónico
						</label>
						<input type="text" id="email" name="email" class="form-control" >
					</div>
					<div class="form-group">
						<label for="password" >
							Contraseña
							<span class="text-danger"> * </span>
						</label>
						<input type="password" id="password" name="password" class="form-control" required >
					</div>
					<div class="form-group">
						<label for="password1" >
							Comprobar Contraseña
							<span class="text-red"> * </span>
						</label>
						<input type="password" id="password1" name="password1" class="form-control" required >
					</div>
					<div></div>
					<div>
						<input class="form-control" id="tipo" name="tipo" type="hidden" value="<?php echo $grupo; ?>">
					</div>
					<div class="form-group">
						<label for="departamento" >Departamento</label>
						<select id="departamento" name="departamento" class="form-control" required>
							<option value="" >Seleccione un Departamento</option>
							<?php foreach ($departamentos as $d): ?>
								<option value="<?php echo  $d->iddepartamento;?>"  >
									<?php echo $d->nombre_departamento;  ?>
								</option>
							<?php  endforeach;  ?>
						</select>
					</div>


					<button type="submit" class="btn btn-primary">Enviar</button>
					<a href="<?php echo site_url('usuarios/listar/'.$grupo); ?>" class="btn btn-danger" role="button">Cancelar</a>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>

	<br><br>

</main>
