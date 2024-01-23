<main role="main" >
	<br><br>
	<div class="container" style="background-color:#EF9600;">
		<br>
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores" >
				<br>
				<div class="card">
					<div class="card-header">
						<h4>Editar Plenaria</h4>
					</div>
					<div class="card-body ">

						<div class="form-row">
							<div class="col-10">
								<label for="instanciaseguimiento" >
									Instancia de seguimiento:
								</label>
								<input class="form-control" type="text" id="instanciaseguimiento" name="instanciaseguimiento" class="form-control" disabled="true"
									   value="<?php echo $plenaria->instancia; ?>" >
							</div>
						</div>
						<div class="form-row">
							<div class="col">
								<hr>
							</div>
						</div>


						<?php if($plenaria->idinsseg == 2 ): ?>
							<div class="form-row">
								<div class="col-10">
									<label for="instanciadepartamento" >
										Departamento:
									</label>
									<input class="form-control" type="text" id="instanciadepartamento" name="instanciadepartamento" class="form-control" disabled="true"
										   value="<?php echo $plenaria->nombre_departamento; ?>" >
								</div>
							</div>
							<div class="form-row">
								<div class="col">
									<hr>
								</div>
							</div>
						<?php elseif($plenaria->idinsseg == 3): ?>
							<div class="form-row">
								<div class="col-10">
									<label for="instanciamunicipio" >
										Municipio:
									</label>
									<input class="form-control" type="text" id="instanciamunicipio" name="instanciamunicipio" class="form-control" disabled="true"
										   value="<?php echo $plenaria->municipio_nombre; ?>" >
								</div>
							</div>
							<div class="form-row">
								<div class="col">
									<hr>
								</div>
							</div>
						<?php endif; ?>


						<div class="form-row">
							<div class="col-10">
								<label for="fecha_plenaria" >
									Fecha de la plenaria:
								</label>
								<input type="date" id="fecha_plenaria" name="fecha_plenaria" class="form-control" disabled="true"
									   value="<?php echo mdate('%Y-%m-%d', $plenaria->fecha_plenaria);?>" >
							</div>
							<div class="col-2">
								<button type="submit" data-toggle="modal" data-target="#plenariamodaldatos" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
									Cambiar Datos
								</button>
							</div>
							<div class="col-10">
								<label for="puntos_agenda" >
									Puntos de la agenda:
								</label>
								<textarea class="form-control" rows="4" id="puntos_agenda" name="puntos_agenda" disabled="true" ><?php echo $plenaria->plenaria_puntos_agenda; ?></textarea>
							</div>
							<div class="col-2"></div>
							<div class="col-10">
								<label for="cumplimiento">
									Cumplimiento de la agenda(%):
								</label>
								<input class="form-control" id="cumplimiento" name="cumplimiento" disabled="true" value="<?php echo $plenaria->plenaria_agenda_cumplida; ?>" >
							</div>
							<div class="col-2"></div>
							<div class="col-10">
								<label for="asunto_pendiente">
									Descripcion del asunto sin tratamiento:
								</label>
								<textarea class="form-control" rows="4" id="asunto_pendiente" name="asunto_pendiente" disabled="true" ><?php echo $plenaria->plenaria_puntos_pendientes; ?></textarea>
							</div>
							<div class="col-2"></div>
							<div class="col-10">
								<label for="puntos_varios">
									Describa puntos varios (maximo 30 palabras):
								</label>
								<textarea class="form-control" rows="4" id="puntos_varios" name="puntos_varios" disabled="true" ><?php echo $plenaria->plenaria_puntos_varios; ?></textarea>
							</div>
							<div class="col-2"></div>
							<div class="col-10">
								<label for="asunto_pendiente">
									Monitores:
								</label>
								<textarea class="form-control" rows="4" id="asunto_pendiente" name="asunto_pendiente" disabled="true" ><?php echo $plenaria->monitores_seguimiento; ?></textarea>
							</div>
							<div class="col-2"></div>
						</div>

						<div class="form-row">
							<div class="col">
								<hr>
							</div>
						</div>
						<div class="form-row">
							<div class="col-10">
								<div class="form-group">
									<label for="tipoplenaria" >
										Tipo de Plenaria
									</label>
									<input class="form-control" type="text" id="tipoplenaria" name="tipoplenaria" disabled="true" value="<?php echo $tipo_plenaria->tipo_plenaria_nombre;  ?>">
								</div>
							</div>
							<div class="col-2">
								<button type="submit" data-toggle="modal" data-target="#tipoplenariamodal" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
									Cambiar Tipo de Plenaria
								</button>
							</div>
						</div>

						<div class="form-row">
							<div class="col">
								<hr>
							</div>
						</div>

						<div class="form-row">
							<div class="col-10">
								<div class="form-group">
									<label for="titular" >
										Norma Extraordinaria
									</label>
									<input type="text" id="titular" name="titular" class="form-control" disabled="true"
										   value="<?php
										   if($norma_incluida == false){

										   }else{
										   		echo $norma_incluida->plne_datos;
										   }

										   ?>" required>
								</div>
							</div>
							<div class="col-2">
								<button type="submit" data-toggle="modal" data-target="#normaextraordinariamodal" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
									Cambiar Norma Extraordinaria
								</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	</div>
</main>


<!-- Cambiar datos de la plenaria -->
<div class="modal" id="plenariamodaldatos">
	<div class="modal-dialog modal-lg ">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title">Editar Informacion plenaria</h1>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
			<?php echo form_open('plenaria/editarPlenariaDatos/'.$plenaria->idplenaria);?>
			<div class="modal-body">
				<div class="form-group">
					<label for="fechaplenaria">Fecha de la plenaria:</label><br>
					<input type="date" id="fechaplenaria" name="fechaplenaria"
						   class="form-control"
						   value="<?php echo mdate('%Y-%m-%d', $plenaria->fecha_plenaria); ?>" required>
				</div>
				<div class="form-group" >
					<label for="puntosagenda" >Puntos de la agenda</label>
					<textarea class="form-control" rows="4" id="puntosagenda" name="puntosagenda" required ><?php echo $plenaria->plenaria_puntos_agenda; ?></textarea>
				</div>
				<div class="form-group">
					<label for="cumplimientoagenda">Cumplimiento de la agenda(%):</label>
					<input type="number" min="0" max="100"  class="form-control" id="cumplimientoagenda" name="cumplimientoagenda" required
					 	value="<?php echo $plenaria->plenaria_agenda_cumplida; ?>" >
				</div>
				<div class="form-group">
					<label for="asuntopendiente">Descripcion del asunto sin tratamiento:</label>
					<textarea class="form-control" rows="4" id="asuntopendiente" name="asuntopendiente" required ><?php echo $plenaria->plenaria_puntos_pendientes; ?></textarea>
				</div>
				<div class="form-group">
					<label for="puntosvarios" >Describa puntos varios (maximo 30 palabras):</label>
					<textarea class="form-control" rows="4" id="puntosvarios" name="puntosvarios" required ><?php echo $plenaria->plenaria_puntos_varios; ?></textarea>
				</div>
				<div class="form-group">
					<label for="monitores" >Monitores</label>
					<textarea class="form-control" rows="4" id="monitores" name="monitores" ><?php echo $plenaria->monitores_seguimiento; ?></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" name="accion" value="1" class="btn btn-primary" style="background-color:#474142; color:#ffffff">Editar</button>
				<?php echo form_close();?>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="tipoplenariamodal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title">Editar Tipo de Plenaria</h1>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
			<?php echo form_open('plenaria/editarPlenariaTipo/'.$plenaria->idplenaria);?>
			<div class="modal-body">
				<div class="form-group">
					<input type="hidden" id="idnoticia" name="idnoticia"
						   value="">
				</div>
				<div class="form-group">
					<label for="instanciaseguimientoplenaria">Instancia de seguimiento:</label>
					<select id="instanciaseguimientoplenaria" name="instanciaseguimientoplenaria" class="form-control" required>
						<option value="" >Seleccione una instancia</option>
						<?php foreach ($tipos as $in): ?>
							<?php if($plenaria->idtipoplenaria == $in->idtpl ): ?>
							<option value="<?php echo $in->idtpl; ?>" selected > <?php echo $in->tipo_plenaria_nombre; ?>  </option>
							<?php else: ?>
							<option value="<?php echo $in->idtpl; ?>"> <?php echo $in->tipo_plenaria_nombre; ?>  </option>
							<?php endif; ?>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" name="accion" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
					Continuar
				</button>
				<?php echo form_close();?>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="normaextraordinariamodal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title">Editar Norma Extraordinaria</h1>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
			<?php echo form_open('plenaria/editarNormaExtraordinaria/'.$plenaria->idplenaria);?>
			<div class="modal-body">
				<div class="form-group">
					<label for="normaextraordinaria" >
					</label>

					<?php if($norma_incluida == false): ?>
						<!-- Norma no existe -->
						<textarea rows="3" id="normaextraordinaria" name="normaextraordinaria" class="form-control"><?php if($norma_incluida == false){}else{echo $norma_incluida->plne_datos;}?></textarea>
						<input type="hidden" id="idplne" name="idplne" value="0">
					<?php else: ?>
						<textarea rows="3" id="normaextraordinaria" name="normaextraordinaria" class="form-control"><?php if($norma_incluida == false){}else{echo $norma_incluida->plne_datos;}?></textarea>
						<input type="hidden" id="idplne" name="idplne" value="<?php echo $norma_incluida->idplne; ?>">
					<?php endif;  ?>
				</div>

			</div>
			<div class="modal-footer">
				<button type="submit" name="accion" value="3" class="btn btn-primary" style="background-color:#474142; color:#ffffff">Editar</button>
				<?php echo form_close();?>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>



</main>
