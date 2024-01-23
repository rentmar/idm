
<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores Caja_de_datos">
				<div id="esquinas_redondeadas">
					<div id="Caja_de_orden" class="Caja_de_datos">
						<h3 id="Título_central"> Crear Nuevo Usuario </h3>
					</div>
					<div id="Caja_de_datos" class="Caja_de_datos">
						<?php echo form_open('usuarios/procesarCrear/'.$grupo)?>

						<?php if(!empty(validation_errors())): ?>
						<div class="form-group">
							<div class="alert alert-warning">
								<strong>
									<?php echo validation_errors(); ?>
								</strong>
							</div>
						</div>
						<?php endif; ?>

						<div class="form-group">
							<label for="usuario" >
								Nombre de usuario
								<span class="text-danger"> * </span>
							</label>
							<input type="text" id="cuadro" class="form-control" name="usuario">
						</div>
						<div class="form-group">
							<label for="nombre" >
								Nombre
								<span class="text-danger"> * </span>
							</label>
							<input type="text" id="cuadro" name="nombre" class="form-control" >
						</div>
						<div class="form-group">
							<label for="apellido">
								Apellido
								<span class="text-danger"> * </span>
							</label>
							<input type="text" id="cuadro" name="apellido" class="form-group" >
						</div>
						<div class="form-group">
							<label for="carnet" >
								Carnet de identidad
								<span class="text-danger"> * </span>
							</label>
							<input type="text" id="cuadro" name="carnet"  class="form-control" >
						</div>
						<div class="form-group">
							<label for="email" >
								Correo electrónico
								<span class="text-danger"> * </span>
							</label>
							<input type="text" id="cuadro" name="email" class="form-control" >
						</div>
						<div class="form-group">
							<label for="password" >
								Contraseña
								<span class="text-danger"> * </span>
							</label>
							<input type="password" id="cuadro" name="password" class="form-control" >
						</div>
						<div class="form-group">
							<label for="password1" >
								Comprobar Contraseña
								<span class="text-red"> * </span>
							</label>
							<input type="password" id="cuadro" name="password1" class="form-control" >
						</div>
						<div class="form-group">
							<label for="grupo" >
								Tipo de Usuario
							</label>
							<select disabled="true" id="grupo" name="grupo" class="form-control">
								<?php foreach ($grupos as $g): ?>
									<?php if($g->id==$grupo) { ?>
										<option  selected="true" value="<?php echo $g->id; ?>"  >
										<?php echo $g->name; ?>
										</option>
									<?php } ?>
								<?php endforeach; ?>
							</select>
						</div>

						<?php if($grupo == 3): ?>
						<div class="form-group">
							<div class="form-check">
								<label class="form-check-label">
									<input id="grupoleyes" name="grupoleyes" type="checkbox" class="form-check-input" value="4">
									Habilitar Ingreso a Formulario LEYES
								</label>
							</div>
						</div>
						<?php endif; ?>
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
						<div class="form-group">
							<label for="direccion" >
								Direccion
							</label>
							<input type="text" id="direccion" name="direccion"  class="form-control cuadro" placeholder=""  >
						</div>
						<div class="form-group">
							<label for="ubicacion">Ubicacion </label>
							<input type="text" id="ubicacion" name="ubicacion"  class="form-control cuadro"
								   placeholder=""  >
						</div>
						<div class="form-group">
							<input type="submit" id="BOTON" value="CREAR USUARIO">
							<a href="<?php echo site_url('Usuarios/Listar/'.$grupo);?>">
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

