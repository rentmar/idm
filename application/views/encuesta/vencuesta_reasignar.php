<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores Caja_de_datos">
				<div id="esquinas_redondeadas">
					<div id="Caja_de_orden" class="Caja_de_datos"><br>
						<h3 id="Título_central"> Re Asignacion de Encuesta </h3>
					</div>
					<div id="Caja_de_datos" class="Caja_de_datos">

						<?php echo form_open('encuesta/procesarReasignacion');?>
						<div>
							<input type="hidden" id="idencuesta" class="form-control" name="idencuesta" value="<?php echo $encuesta->idencuesta; ?>"
						</div>
						<div class="form-group">
							<p>Usuario actual: <input type="text" id="usuario1" name="usuario1" value="<?php echo $usuario_actual->username;?>" readonly></p>
						</div>
						<div class="form-group">
							<p>Departamento: <input type="text" id="depto1" name="depto1" value="<?php echo $usuario_actual->nombre_departamento;?>" readonly></p>
						</div>
						<div class="form-group">
							<p>Area de Trabajo: <input type="text" id="depto1" name="depto1" value="<?php echo $area_trabajo->nombre_geolocal;?>" readonly></p>
						</div>
						<div>
							<hr>
						</div>
						<div class="form-group">
							<label for="nuevousuario">Reasignar al usuario: </label><span class="text-danger"> * </span>
							<select required id="idusuario" name="idusuario" class="form-control cuadro simple" required>
								<option value="">Seleccione el nuevo usuario</option>
								<?php foreach ($encuestadores as $e): ?>
									<option value="<?php echo $e->id;?>" >
										<?php echo $e->username;  ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label for="geolocalizacion">Re Asignar Area de trabajo (geolocalizacion)</label><span class="text-danger"> * </span>
							<select required id="idgeolocal" name="idgeolocal" class="form-control cuadro simple" required>
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

