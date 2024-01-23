<main role="main">
	<br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="card">
					<div class="card-header bg-primary text-white" >
						Editar Registro(CI): <?php echo ' '.$registro->numero_ci; ?>
					</div>
					<div class="card-body" >
						<?php
						/** @noinspection PhpLanguageLevelInspection */
						$att_ci = [
							'id' => 'formeditregistro',
							'name' => 'formeditregistro',
						]; ?>
						<?php echo form_open(site_url('padron/actualizarRegistro/'), $att_ci); ?>


						<div class="form-row">
							<input type="text" class="form-control" id="idpartida" name="idpartida"
								   value="<?php echo $registro->idpartida; ?>">
							<input type="text" class="form-control" id="idusuario" name="idusuario"
								   value="<?php echo $registro->rel_idusuario;?>">
						</div>
						<div class = "form-row">
							<div class = "form-group col-6">
								<label for = "num_libro">Libro:</label>
								<input type = "number" class =" form-control"
									   id = "num_libro" name="num_libro"
									   placeholder = "Numero de Libro"
									   value="<?php echo $datos->libro;?>"
									   required>
							</div>

							<div class = "form-group col-6">
								<label for = "num_partida">Partida:</label>
								<input type = "number" class = "form-control" min="1" max="100"
									   id = "num_partida" name="num_partida"
									   placeholder = "Numero de Partida"
									   value="<?php echo $datos->partida;?>"
									   required>
							</div>
						</div>

						<div class="form-row">
							<div class="col">
								<hr>
							</div>
						</div>

						<div class="form-row">
							<div class = "form-group col-6">
								<label for = "num_docid">Numero de CI:</label>
								<input type = "text" class = "form-control"
									   id = "num_docid" name="num_docid"
									   placeholder = "Numero de documento de identidad"
									   value="<?php echo $registro->numero_ci;?>"
									   required readonly >
							</div>
							<div class = "form-group col-6">
								<label for = "fecha_nacimiento" >Fecha de nacimiento:</label>
								<input type = "date" class = "form-control"
									   id = "fecha_nacimiento" name="fecha_nacimiento"
									   value="<?php echo $datos->fecha_nacimiento?>"
									   required>
							</div>
						</div>
						<div class="form-row">
							<div class="col">
								<hr>
							</div>
						</div>

						<div class = "form-row">
							<div class = "form-group col-3">
								<label for = "nombres" >Nombres:</label>
								<input type = "text" class =" form-control"
									   id = "nombres" name="nombres"
									   placeholder = "Nombres"
									   value="<?php echo $datos->nombres; ?>"
									   required>
							</div>
							<div class = "form-group col-3">
								<label for = "primer_apellido">Apellido Paterno:</label>
								<input type = "text" class = "form-control"
									   id = "primer_apellido" name="primer_apellido"
									   placeholder = "Primer apellido"
									   value="<?php echo $datos->primer_apellido?>"
								>
							</div>
							<div class = "form-group col-3">
								<label for = "segundo_apellido">Apellido Materno:</label>
								<input type = "text" class = "form-control"
									   id = "segundo_apellido" name="segundo_apellido"
									   placeholder = "Segundo apellido"
									   value="<?php echo $datos->segundo_apellido?>"
								>
							</div>
							<div class = "form-group col-3">
								<label for = "apellido_esposo">Apellido del Esposo:</label>
								<input type = "text" class = "form-control"
									   id = "apellido_esposo" name="apellido_esposo"
									   placeholder = "Apellido Esposo"
									   value="<?php echo $datos->apellido_esposo;?>"
								>
							</div>
						</div>
					</div>
					<div class="card-footer" >
						<button type="submit" id="BOTON" >
							Enviar
						</button>
						<a id="BOTON" href="<?php echo site_url('padron/listarregistros') ?>" class="btn btn-danger" role="button">
							Cancelar
						</a>

					</div>
						<?php echo form_close(); ?>
				</div>
			</div>

		</div>

	</div>



</main>

