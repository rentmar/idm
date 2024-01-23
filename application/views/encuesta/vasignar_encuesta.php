
<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores Caja_de_datos">
				<div id="esquinas_redondeadas">
					<div id="Caja_de_orden" class="Caja_de_datos"><br>
						<h3 id="Título_central"> Asignacion de Encuesta a Usuario </h3>
					</div>
					<div id="Caja_de_datos" class="Caja_de_datos">

						<?php echo form_open('encuesta/guardarAsignacionDencuesta');?>
						<input type="text" id="idusuario1" class="form-control" name="idusuario1" value="<?php echo $usuario->id;?>" hidden>
						<div class="form-group">
							<p>Nombre de Usuario: <input type="text" id="usuario1" name="usuario1" value="<?php echo $usuario->username;?>" readonly></p>
						</div>
						<div class="form-group">
							<p>Carnet de identidad: <input type="text" id="carnetid1" name="carnetid1" value="<?php echo $usuario->carnet_identidad;?>" readonly></p>
						</div>
						<div class="form-group">
							<p>Departamento: <input type="text" id="depto1" name="depto1" value="<?php echo $usuario->nombre_departamento;?>" readonly></p>
						</div>
					<div class="form-group">
							<label for="aencuesta">Asignar encuesta</label><span class="text-danger"> * </span>
							<select required id="idencuesta1" name="idencuesta1" class="form-control cuadro" required>
								<option value="" selected disabled hidden></option>
								<?php foreach ($encuestas as $e): ?>
									<option value="<?php echo $e->iduiencuesta;?>" ><?php echo $e->uinombre_encuesta;  ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label for="nencuestass">Asignar Nro de Encuestas</label><span class="text-danger"> * </span>
							<input type="number" id="nencuestas1" name="nencuestas1"  class="form-control cuadro" min="1" required="">
						</div>
						<div class="form-group">
							<label for="geolocalizacion">Asignar Area de trabajo (geolocalizacion)</label><span class="text-danger"> * </span>
							<select required id="idgeolocal" name="idgeolocal" class="form-control cuadro" required>
								<option value="">Seleccione un area de trabajo</option>
								<?php foreach ($geolocal as $e): ?>
									<option value="<?php echo $e->idgeolocal;?>" ><?php echo $e->nombre_geolocal ;  ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<input type="submit" id="BOTON" value="ASIGNAR">
							<a href="<?php echo site_url('Encuesta/encuestaAusuarios');?>">
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

