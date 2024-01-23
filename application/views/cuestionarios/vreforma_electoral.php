
		<main>
			<br><br>
			<?php echo validation_errors(); ?>
			<?php
			/** @noinspection PhpLanguageLevelInspection */
			$atr_form =[
				'id' => 'formulario' ,
				]
			;?>
			<?php echo form_open('reformaelectoral/subtemas', $atr_form);?>
			<?php //echo form_open('reformaelectoral/capturarDatos', $atr_form);?>

			<div class="contenedores_divididos">
				<div class="contenedor_superior1" id="contenedor_pequeño">
				</div>
				<div class="contenedor_inferior">
					<h3 id="Título_formulario"> Reformas electorales </h3>
				</div>
			</div>
			<br>
			<div class="contenedores">
				<label for="fecha">Introduzca la fecha de publicación/difusión de la noticia:</label><br>
				<input type="date" id="fecha" name="fecha"
					   value="<?php
					   if(isset($noticia) && !empty($noticia->fecha_registro))
					   {
						   echo mdate('%Y-%m-%d', $noticia->fecha_registro);
					   };
					   ?>" required >
				<input type="hidden" id="idformulario" name="idformulario" value="<?php echo $idformulario; ?>" >
				<input type="hidden" id="idusuario" name="idusuario" value="<?php echo $idusuario;?>" >

			</div>
			<br>
			<div class="contenedores">

				<label for="tipo-medio">Tipo de Medio:</label><br>
				<select id="tipo-medio" name="idtipomedio" class="form-control" required>
					<option value="" >Seleccione el Tipo de Medio</option>
					<?php foreach ($tipo_medio as $key=>$element): ?>
						<option value="<?php echo $element['tipo_id']; ?>" >
							<?php echo $element['tipo_nombre']; ?>
						</option>
					<?php endforeach; ?>
				</select>

			</div>
			<br>
			<div class="contenedores">

				<label>Escoja el medio al cual hizo el seguimiento:</label><br>
				<select id="medio" name="idmedio" class="form-control" required >
					<option value="" selected >Seleccione medio</option>
				</select>
			</div>
			<br>



			<div class="contenedores">
				<label for="titular">Escriba el titular de la noticia:</label><br>
				<input type="text" id="titular" name="titular" required class="form-control"
					   value="<?php
					   if(isset($noticia) && !empty($noticia->titular) )
					   {
					   		echo $noticia->titular;
					   }

					   ?>"
				>
			</div>
			<br>

			<div class="contenedores">
				<label>Escriba un pequeño párrafo que resuma la noticia:</label><br>
				<input type="text" id="resumen" name="resumen" required  class="form-control"
					   value="<?php
					   if(isset($noticia) && !empty($noticia->resumen) ){
					   		echo $noticia->resumen;
					   }
					   ?>"
				>

			</div>
			<br>
			<div class="contenedores">
				<label>Pegue el link donde se encuentra la noticia:</label><br>
				<input type="text" id="url" name="url" class="form-control"
					   value="<?php
					   if(isset($noticia) && !empty($noticia->url_noticia) )
					   {
					   		echo $noticia->url_noticia;
					   }
					   ?>"
				>
			</div>
			<br>
			<div class="contenedores">
				<div class="card">
					<div class="card-header cuest1">
						<h4>
							ACTORES
						</h4>
					</div>
					<div class="card-body">
						<label>Escoja el tipo de actor que es la fuente de la noticia:</label><br>
						<?php $contador = 0; ?>
						<?php foreach ($actor as $a): ?>
							<?php if($contador==0):  ?>
								<div class="form-check">
									<label class="form-check-label">
										<input checked id="checkactor" name="idactor[]" type="radio" class="form-check-input"
											   value="<?php echo $a['idactor']; ?>"   >
										<?php echo $a['nombre_actor']; ?>
									</label>
								</div>
								<?php $contador++; ?>
							<?php else:  ?>
								<div class="form-check">
									<label class="form-check-label">
										<input id="checkactor" name="idactor[]" type="radio" class="form-check-input"
											   value="<?php echo $a['idactor']; ?>"   >
										<?php echo $a['nombre_actor']; ?>
									</label>
								</div>
							<?php endif; ?>


						<?php endforeach; ?>

					</div>
				</div>
			</div>
			<br>
			<div class="contenedores">
				<div class="card">
					<div class="card-header cuest1">
						<h4>
							TEMAS
						</h4>
					</div>
					<div class="card-body">
						<label>Escoge el tema al que está referido la nota :</label><br>
						<?php foreach ($tema as $a): ?>
							<div class="form-check">
								<label class="form-check-label">
									<input id="checktema" name="idtema[]" type="checkbox" class="form-check-input"
										   value="<?php echo $a['idtema']; ?>"   >
									<?php echo $a['nombre_tema']; ?>
								</label>
							</div>
						<?php endforeach; ?>
						<div class="form-check">
							<label class="form-check-label">
								<input id="checktema" name="idtema[]" type="checkbox" class="form-check-input"
									   value="0"   >
								Otro
							</label>
						</div>
					</div>
				</div>
			</div>

			<br>
			<div id="otrotemac">

			</div>

			<br>
			<div id="contenedor-submit">
				<button id="BOTON" type="submit" name="action" value="1" >
					SIGUIENTE
				</button>
				<a href="<?php echo site_url('reformaelectoral/cancelarNuevo/');?>">
					<input type="button" class="BOTON" value="CANCELAR">
				</a>
			</div>
			<?php echo form_close();?>
	</main>


<!-- Modal de seleccion de medios -->
<div class="modal fade" id="modalmediocomm">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header cuest1">
				<h4 class="modal-title">
					Seleccionar el Tipo y Medio de Comunicacion
				</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">

				<?php echo form_open('reformaelectoral/seleccionarMedio'); ?>
				<div class="form-group">
					<label for="tipo-medio">Tipo de Medio:</label><br>
					<select id="tipo-medio" name="idtipomedio" class="form-control" >
						<option value="" >Seleccione el Tipo de Medio</option>
						<?php foreach ($tipo_medio as $key=>$element): ?>
							<option value="<?php echo $element['tipo_id']; ?>" ><?php echo $element['tipo_nombre']; ?></option>
						<?php endforeach; ?>
					</select>
					<br>
					<label for="medio" >Escoja el medio al cual hizo el seguimiento:</label><br>
					<select id="medio" name="idmedio" class="form-control" required >
						<option value="" selected >Seleccione medio</option>
					</select>
				</div>


			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button id="BOTON" type="submit">Seleccionar</button>
				<button id="BOTON" type="button" class="" data-dismiss="modal">Cancelar</button>
			</div>
				<?php echo form_close(); ?>

		</div>
	</div>
</div>



<!-- Modal de seleccion de temas -->
<div class="modal fade" id="modaltemas">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header cuest1">
				<h4 class="modal-title">
					Escoge el tema al que está referido la nota
				</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">




			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button id="BOTON" type="submit">Seleccionar</button>
				<button id="BOTON" type="button" class="" data-dismiss="modal">Cancelar</button>
			</div>


		</div>
	</div>
</div>


		<!-- The Modal de alerta ACTORES SIN SELECCIONAR -->
		<div class="modal fade" id="actorsinseleccionar">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">

					<!-- Modal Header -->
					<div class="modal-header bg-warning">
						<h4 class="modal-title text-white ">Alerta</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">
						Al menos debe seleccionar un actor
					</div>

					<!-- Modal footer -->
					<div class="modal-footer">
						<button id="BOTON" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					</div>

				</div>
			</div>
		</div>

		<!-- The Modal de alerta TEMAS SIN SELECCIONAR -->
		<div class="modal fade" id="mediosinseleccionar">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">

					<!-- Modal Header -->
					<div class="modal-header bg-warning">
						<h4 class="modal-title text-white ">Alerta</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">
						Seleccionar el medio de comunicacion
					</div>

					<!-- Modal footer -->
					<div class="modal-footer">
						<button id="BOTON" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					</div>

				</div>
			</div>
		</div>

		<!-- The Modal de alerta TEMAS SIN SELECCIONAR -->
		<div class="modal fade" id="temasinseleccionar">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">

					<!-- Modal Header -->
					<div class="modal-header bg-warning">
						<h4 class="modal-title text-white ">Alerta</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">
						Seleccionar por lo menos un tema
					</div>

					<!-- Modal footer -->
					<div class="modal-footer">
						<button id="BOTON" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					</div>

				</div>
			</div>
		</div>

