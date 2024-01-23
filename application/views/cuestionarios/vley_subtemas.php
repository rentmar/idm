<main role="main">
	<br><br>
	<?php echo validation_errors(); ?>
	<?php
	/** @noinspection PhpLanguageLevelInspection */
	$atr_form =[
		'id' => 'formulariosub_ley' ,
	]
	;?>
	<?php echo form_open('ley/preenvio/', $atr_form);?>

	<div class="contenedores_divididos">
		<div class="contenedor_superior4" id="contenedor_pequeño">
		</div>
		<div class="contenedor_inferior">
			<h3 id="Título_formulario"> Ley </h3>
		</div>
	</div>

	<br>
	<div class="contenedores">
		<div class="card">
			<div class="card-header cuest4">
				<h4 class="text-white">
					Datos de la ley
				</h4>
			</div>
			<div class="card-body">
				<div class="list-group">
					<a href="#" class="list-group-item disabled">
						Fecha:
						<?php echo ' '.mdate('%m-%d-%Y', $ley->fecha_ley); ?>
					</a>
					<a href="#" class="list-group-item disabled">
						Fuente:
						<?php if(isset($fuente_ley)){ echo ' '.$fuente_ley->nombre_fuente;} ?>
					</a>
					<a href="#" class="list-group-item disabled">
						Codigo:
						<?php echo ' '.$ley->codigo; ?>
					</a>
					<a href="#" class="list-group-item disabled">
						Descripción:
						<?php echo ' '.$ley->titulo; ?>
					</a>
					<a href="#" class="list-group-item disabled">
						Resumen:
						<?php echo ' '.$ley->resumen; ?>
					</a>
					<a href="#" class="list-group-item disabled">
						URL:
						<?php echo ' '.$ley->url_ley; ?>
					</a>
					<a href="#" class="list-group-item disabled">
						Estado de la ley:
						<?php echo ' '.$estado_ley->nombre_estadoley." - ".$estado_ley->porcentaje_estadoley."%"; ?>
					</a>
				</div>

			</div>
		</div>
	</div>
	<br>
	<div class="contenedores">
		<div class="card">
			<div class="card-header cuest4">
				<h4 class="text-white">
					TEMAS
				</h4>
			</div>
			<div class="card-body">
				<h6>Temas</h6>
				<p>
				<ul>
					<?php foreach ($temas_sel as $temas): ?>
						<li type="circle" ><?php echo $temas['nombre_tema'] ?></li>
					<?php endforeach; ?>
				</ul>
				</p>

				<?php if(isset($ley->otro_tema) && !empty($ley->otro_tema) ): ?>
					<h7>Otro Tema</h7>
					<p>
					<ul>
						<li type="circle" > <?php echo $ley->otro_tema; ?> </li>
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
					<div class="card-header cuest4">
						<h4 class="text-white">
							<?php echo $tm['nombre_tema'] ?>
						</h4>
					</div>
					<div class="card-body">
						<?php foreach ($subtemas_sel as $st): ?>
							<?php if($st['idtema'] == $tm['idtema'] ): ?>
								<?php if(!is_null($st['idsubtema'])): ?>
								<div class="form-check">
									<label class="form-check-label">
										<input id="checkstema" name="<?php echo "tema".$tm['idtema']."[]"; ?>" type="checkbox" class="form-check-input"
											   value="<?php echo $st['idsubtema']; ?>" >
										<?php echo $st['nombre_subtema']; ?>
									</label>
								</div>
								<?php endif; ?>
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
		<a href="<?php echo site_url('ley/cancelarNuevo/');?>">
			<input type="button" class="BOTONROJO" value="CANCELAR">
		</a>
	</div>
	<?php echo form_close();?>
</main>


<!-- The Modal de alerta TEMAS SIN SELECCIONAR -->
<div class="modal fade" id="subtemasleyessinseleccion">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header bg-warning">
				<h4 class="modal-title text-white ">Alerta</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				Seleccionar por lo menos un subtema
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button id="BOTON" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>

		</div>
	</div>
</div>


