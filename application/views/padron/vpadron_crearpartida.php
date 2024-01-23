<main role="main">
	<br><br>
	<div class="container"  >
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" >
				<br>
				<div class="card">
					<div class="card-header bg-primary">
						<h4>REGISTRAR</h4>
					</div>
					<?php
					/** @noinspection PhpLanguageLevelInspection */
					$attrs_part = [
						'id' => 'formregpart',
						'name' => 'formregpart',
					];
					?>
					<?php echo form_open('padron/insertarPartida', $attrs_part); ?>
					<div class="card-body">
						<div class = "form-row">
							<div class = "form-group col-4">
								<label for = "num_libro">Libro:</label>
								<input type = "text" class =" form-control"
									   id = "num_libro" name="num_libro"
									   placeholder = "Numero de Libro" pattern="[0-9]+" required>
							</div>
							<div class = "form-group col-4">
								<label for = "num_folio">Folio:</label>
								<input type = "text" class = "form-control"
									   id = "num_folio" name="num_folio"
									   placeholder = "Numero de Folio" pattern="[0-9]+" required>
							</div>
							<div class = "form-group col-4">
								<label for = "num_partida">Partida:</label>
								<input type = "text" class = "form-control"
									   id = "num_partida" name="num_partida"
									   placeholder = "Numero de Partida" pattern="[0-9]+" required>
							</div>
						</div>

						<div class="form-row">
							<div class="col">
								<hr>
							</div>
						</div>

						<div class = "form-row">
							<div class = "form-group col-6">
								<label for = "nombres">Nombres:</label>
								<input type = "text" class =" form-control"
									   id = "nombres" name="nombres"
									   placeholder = ""  required>
							</div>
							<div class = "form-group col-6">
								<label for = "primer_apellido">Primer apellido:</label>
								<input type = "text" class = "form-control"
									   id = "primer_apellido" name="primer_apellido"
									   placeholder = ""  required>
							</div>
							<div class = "form-group col-6">
								<label for = "segundo_apellido">Segundo apellido:</label>
								<input type = "text" class = "form-control"
									   id = "segundo_apellido" name="segundo_apellido"
									   placeholder = ""  required>
							</div>
							<div class = "form-group col-6">
								<label for = "apellido_esposo">Apellido esposo:</label>
								<input type = "text" class = "form-control"
									   id = "apellido_esposo" name="apellido_esposo"
									   placeholder = ""  >
							</div>
						</div>

						<div class="form-row">
							<div class="col">
								<hr>
							</div>
						</div>

						<div class = "form-row">
							<div class = "form-group col-4">
								<label for = "numero_ci">No Documento:</label>
								<input type = "text" class =" form-control"
									   id = "numero_ci" name="numero_ci"
									   placeholder = "" pattern="[0-9]+"  required>
							</div>
							<div class = "form-group col-4">
								<label for = "complemento_ci">Complemento:</label>
								<input type = "text" class = "form-control"
									   id = "complemento_ci" name="complemento_ci"
									   placeholder = "" >
							</div>
							<div class = "form-group col-4">
								<label for = "fecha_nacimiento">Fecha de Nacimiento:</label>
								<input type = "date" class = "form-control"
									   id = "fecha_nacimiento" name="fecha_nacimiento"
									   placeholder = ""  required>
							</div>
						</div>

						<div class="form-row">
							<div class="col">
								<hr>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-12">
								<div class="custom-control custom-radio">
									<input type="radio" id="sexom" name="sexo" class="custom-control-input" value="M" checked>
									<label class="custom-control-label" for="sexom">Masculino</label>
								</div>
								<div class="custom-control custom-radio">
									<input type="radio" id="sexof" name="sexo" class="custom-control-input" value="F">
									<label class="custom-control-label" for="sexof">Femenino</label>
								</div>
							</div>
						</div>

						<div class="form-row">
							<div class="col">
								<hr>
							</div>
						</div>

						<div class="form-row">
							<div class = "form-group col-6">
								<label for = "domicilio">Lugar Domicilio/Residencia:</label>
								<input type = "text" class = "form-control"
									   id = "domicilio" name="domicilio"
									   placeholder = ""  required>
							</div>
							<div class = "form-group col-6">
								<label for = "zona">Zona/Barrio:</label>
								<input type = "text" class = "form-control"
									   id = "zona" name="zona"
									   placeholder = ""  required>
							</div>
							<div class = "form-group col-8">
								<label for = "calle">Avenida/Calle:</label>
								<input type = "text" class = "form-control"
									   id = "calle" name="calle"
									   placeholder = ""  required>
							</div>
							<div class = "form-group col-4">
								<label for = "num_dom">Numero:</label>
								<input type = "text" class = "form-control"
									   id = "num_dom" name="num_dom"
									   placeholder = ""  required>
							</div>
						</div>
						<div class="form-row">
							<div class="col">
								<hr>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-6">
								<div class="form-group">
									<label for="departamento" >Departamento:</label>
									<select id="departamento" name="departamento" class="form-control" required>
										<option value="" >Seleccione un Departamento</option>
										<?php foreach ($departamentos as $d): ?>
											<option value="<?php echo  $d->iddepartamento;?>"  >
												<?php echo $d->nombre_departamento;  ?>
											</option>
										<?php  endforeach;  ?>
									</select>
								</div>
							</div>
							<div class="form-group col-6">
								<label for = "provincia">Provincia:</label>
								<input type = "text" class = "form-control"
									   id = "provincia" name="provincia"
									   placeholder = ""  required>
							</div>
							<div class="form-group col-6">
								<label for = "localidad">Localidad:</label>
								<input type = "text" class = "form-control"
									   id = "localidad" name="localidad"
									   placeholder = ""  required>
							</div>
							<div class="form-group col-6">
								<label for = "localidad_otr">Otra Localidad:</label>
								<input type = "text" class = "form-control"
									   id = "localidad_otr" name="localidad_otr"
									   placeholder = ""  >
							</div>
						</div>
						<div class="form-row">
							<div class="col">
								<hr>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-6">
								<div class="form-group">
									<label for="departamento_adh" >Lugar de Adhesion:</label>
									<select id="departamento_adh" name="departamento_adh" class="form-control" required>
										<option value="" >Seleccione un Departamento</option>
										<?php foreach ($departamentos as $d): ?>
											<option value="<?php echo  $d->iddepartamento;?>"  >
												<?php echo $d->nombre_departamento;  ?>
											</option>
										<?php  endforeach;  ?>
									</select>
								</div>
							</div>
							<div class="form-group col-6">
								<label for = "fecha_adh">Fecha de Adhesion:</label>
								<input type = "date" class = "form-control"
									   id = "fecha_adh" name="fecha_adh"
									   placeholder = ""  required>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-12">
								<input id="idusuario" name="idusuario" type="hidden"
									   class="form-control"
									   value="<?php echo $usuario->id; ?>">
							</div>
						</div>
					</div>
					<div class="card-footer">
						<button type = "submit" class = "btn btn-primary">Enviar</button>
					</div>
					<?php echo form_close();?>

				</div>
			</div>
		</div>
	</div>
</main>
