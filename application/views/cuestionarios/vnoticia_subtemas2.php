<main role="main">
	<br><br>
	<?php echo validation_errors(); ?>
	<?php
	/** @noinspection PhpLanguageLevelInspection */
	$atr_form =[
		'id' => 'formulariosub' ,
	]
	;?>
	<?php echo form_open('censo/preenvio/', $atr_form);?>

	<div class="contenedores_divididos">
		<div class="contenedor_superior3" id="contenedor_pequeño">
		</div>
		<div class="contenedor_inferior">
			<h3 id="Título_formulario"> Institucionalidad democrática </h3>
		</div>
	</div>

	<br>
	<div class="contenedores">
		<div class="card">
			<div class="card-header cuest3">
				<h4 class="text-white">
					Datos de la noticia
				</h4>
			</div>
			<div class="card-body">
				<div class="list-group">
					<a href="#" class="list-group-item disabled">
						Fecha de la Noticia:
						<?php echo ' '.mdate('%m-%d-%Y', $noticia->fecha_noticia); ?>
					</a>
					<a href="#" class="list-group-item disabled">
						Titular:
						<?php echo ' '.$noticia->titular; ?>
					</a>
					<a href="#" class="list-group-item disabled">
						Resumen:
						<?php echo ' '.$noticia->resumen; ?>
					</a>
					<a href="#" class="list-group-item disabled">
						URL:
						<?php echo ' '.$noticia->url_noticia; ?>
					</a>
					<a href="#" class="list-group-item disabled">
						Medio:
						<?php echo $noticia->medio['nombre']; ?>
						<?php echo ' - '.$noticia->tipo_medio['nombre']; ?>
					</a>
				</div>

			</div>
		</div>
	</div>
	<br>
	<div class="contenedores">
		<div class="card">
			<div class="card-header cuest3">
				<h4 class="text-white">
					ACTORES Y TEMAS
				</h4>
			</div>
			<div class="card-body">
				<h6>Actores</h6>
				<p>
				<ul>
					<?php foreach ($actores_sel as $ac): ?>
						<li type="circle" ><?php echo $ac['nombre_actor'] ?></li>
					<?php endforeach; ?>
				</ul>

				</p>
				<h6>Temas</h6>
				<p>
				<ul>
					<?php foreach ($temas_sel as $temas): ?>
						<li type="circle" ><?php echo $temas['nombre_tema'] ?></li>
					<?php endforeach; ?>
				</ul>
				</p>

				<?php if(isset($noticia->otro_tema) && !empty($noticia->otro_tema) ): ?>
					<h7>Otro Tema</h7>
					<p>
					<ul>
						<li type="circle" > <?php echo $noticia->otro_tema; ?> </li>
					</ul>
					</p>
				<?php endif; ?>

			</div>
		</div>
	</div>


	<br>


	<?php if (isset($temas_sel)): ?>
		<?php foreach ($temas_sel as $tm): ?>
			<div class="contenedores">
				<div class="card">
					<div class="card-header cuest3">
						<h4 class="text-white">
							<?php echo $tm['nombre_tema'] ?>
						</h4>
					</div>
					<div class="card-body">
						<?php foreach ($subtemas_sel as $st): ?>
							<?php if($st['idtema'] == $tm['idtema'] ): ?>
								<div class="form-check">
									<label class="form-check-label">
										<input id="checkstema" name=" <?php echo "tema".$tm['idtema']."[]";?>" type="checkbox" class="form-check-input"
											   value="<?php echo $st['idsubtema']; ?>"   >
										<?php echo $st['nombre_subtema']; ?>
									</label>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
						<div class="form-check">
							<label class="form-check-label">
								<input id="checkstema" name=" <?php echo "tema".$tm['idtema']."[]";?>" type="checkbox" class="form-check-input"
									   value="0"   >
								Otro
							</label>
						</div>
						<br>
						<div class="form-group">
							<input type="text" id="<?php echo "otrosubtema".$tm['idtema'];?>"
								   name="<?php echo "otrosubtema".$tm['idtema']; ?>"
								   placeholder="Otro subtema" class="form-control"
							>

						</div>

					</div>
				</div>
			</div>
			<br>
		<?php  endforeach; ?>
	<?php endif; ?>


	<br>

	<div id="contenedor-submit">
		<button id="BOTON" type="submit" name="action" value="1" >
			SIGUIENTE
		</button>
		<a href="<?php echo site_url('censo/cancelarNuevo/');?>">
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
			<?php echo form_close(); ?>

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



