<main role="main">
	<br><br>
	<?php echo validation_errors(); ?>
	<?php
	/** @noinspection PhpLanguageLevelInspection */
	$atr_form =[
		'id' => 'formulario_ley' ,
	]
	;?>
	<?php echo form_open('ley/subtemas', $atr_form);?>

	<div class="contenedores_divididos">
		<div class="contenedor_superior4" id="contenedor_pequeño">
		</div>
		<div class="contenedor_inferior">
			<h3 id="Título_formulario"> Ley </h3>
		</div>
	</div>
	<br>
	<div class="contenedores">
		<label for="fecha">Introduzca la fecha:</label><br>
		<input type="date" id="fecha" name="fecha"
			   value="<?php
			   if(isset($ley) && !empty($ley->fecha_ley))
			   {
				   echo mdate('%Y-%m-%d', $ley->fecha_ley);
			   };
			   ?>" required >
		<input type="hidden" id="idformulario" name="idformulario" value="<?php echo $idformulario; ?>" >
		<input type="hidden" id="idusuario" name="idusuario" value="<?php echo $idusuario;?>" >
	</div>
	<br>

	<?php if(isset($ley) && empty($ley->fuente) ): ?>
	<div class="contenedores">
		<label>Escoja la fuente:</label><br>
		<select id="idfuente" name="idfuente" class="form-control" required >
			<option value="" selected >Seleccione fuente</option>
			<?php foreach ($fuente_ley as $f): ?>
				<option value="<?php echo $f->idfuente;?>" >
					<?php echo $f->nombre_fuente;?>
				</option>
			<?php endforeach; ?>
		</select>
	</div>
	<br>
	<?php else: ?>
	<div class="contenedores">
		<label>Escoja la fuente:</label><br>
		<select id="idfuente" name="idfuente" class="form-control" required >
			<option value="" >Seleccione fuente</option>
			<?php foreach ($fuente_ley as $f): ?>
				<?php if($f->idfuente == $ley->fuente): ?>
				<option selected value="<?php echo $f->idfuente;?>" >
					<?php echo $f->nombre_fuente;?>
				</option>
				<?php else: ?>
				<option value="<?php echo $f->idfuente;?>" >
					<?php echo $f->nombre_fuente;?>
				</option>
				<?php endif; ?>
			<?php endforeach; ?>
		</select>
	</div>
	<?php endif; ?>

	<?php if(isset($ley)&&empty($ley->estado)): ?>
	<div class="contenedores">
		<label>Estado actual de la ley pertenece a:</label>
		<div class="card">
			<div class="card-body">
				<?php $contador = 1; ?>
				<?php foreach ($estado_ley as $el): ?>
					<?php if($contador == 1): ?>
						<div class="form-check">
							<label class="form-check-label">
								<input id="idestadoley" name="idestadoley" checked type="radio" class="form-check-input" value="<?php echo $el->idestadoley;?>">
								<?php echo $el->nombre_estadoley." - ".$el->porcentaje_estadoley."%"; 	   ?>
							</label>
							<?php $contador++; ?>
						</div>
					<?php else: ?>
						<div class="form-check">
							<label class="form-check-label">
								<input id="idestadoley" name="idestadoley" type="radio" class="form-check-input" value="<?php echo $el->idestadoley;?>">
								<?php echo $el->nombre_estadoley." - ".$el->porcentaje_estadoley."%"; 	   ?>
							</label>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<br>
	<?php else: ?>
	<div class="contenedores">
		<label>Estado actual de la ley pertenece a:</label>
		<div class="card">
			<div class="card-body">
				<?php foreach ($estado_ley as $el): ?>
					<?php if($el->idestadoley == $ley->estado): ?>
						<div class="form-check">
							<label class="form-check-label">
								<input id="idestadoley" name="idestadoley" checked type="radio" class="form-check-input" value="<?php echo $el->idestadoley;?>">
								<?php echo $el->nombre_estadoley." - ".$el->porcentaje_estadoley."%"; 	   ?>
							</label>
						</div>
					<?php else: ?>
						<div class="form-check">
							<label class="form-check-label">
								<input id="idestadoley" name="idestadoley" type="radio" class="form-check-input" value="<?php echo $el->idestadoley;?>">
								<?php echo $el->nombre_estadoley." - ".$el->porcentaje_estadoley."%"; 	   ?>
							</label>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<br>
	<?php endif; ?>

	<div class="contenedores">
		<label for="titular">Escriba el codigo de la ley:</label><br>
		<input type="text" id="codigo_ley" name="codigo_ley" required class="form-control"
			   value="<?php
			   if(isset($ley) && !empty($ley->codigo) )
			   {
				   echo $ley->codigo;
			   }
			  ?>"
		>
	</div>
	<br>
	<div class="contenedores">
		<label for="titular">Escriba la descripción de la ley:</label><br>
		<input type="text" id="nombreley" name="nombreley" required class="form-control"
			   value="<?php
			   if(isset($ley) && !empty($ley->titulo) )
			   {
				   echo $ley->titulo;
			   }

			   ?>"
		>
	</div>
	<br>
	<div class="contenedores">
		<label for="resumen">Escriba un pequeño párrafo que resuma la ley:</label><br>
		<input type="text" id="resumen" name="resumen" required class="form-control"
			   value="<?php
			   if(isset($ley) && !empty($ley->resumen) )
			   {
				   echo $ley->resumen;
			   }

			   ?>"
		>
	</div>
	<br>
	<div class="contenedores">
		<label>Pegue el link donde se encuentra la ley:</label><br>
		<input type="text" id="url_ley" name="url_ley" class="form-control" required
			   value="<?php
			   if(isset($ley) && !empty($ley->url_ley) )
			   {
				   echo $ley->url_ley;
			   }
			   ?>"
		>
	</div>
	<br>


	<?php if(isset($ley) && empty($ley->temas)): ?>
	<div class="contenedores">
		<div class="card">
			<div class="card-header cuest4">
				<h4 class="text-white">
					TEMAS
				</h4>
			</div>
			<div class="card-body">
				<label>Escoge el tema al que está referida la ley :</label><br>
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
	<?php else: ?>
	<div class="contenedores">
		<div class="card">
			<div class="card-header cuest4">
				<h4 class="text-white">
					TEMAS
				</h4>
			</div>
			<div class="card-body">
				<label>Escoge el tema al que está referida la ley :</label><br>
				<?php foreach ($tema as $a): ?>
					<?php if(in_array($a['idtema'], $ley->temas)){ ?>
					<div class="form-check">
						<label class="form-check-label">
							<input id="checktema" name="idtema[]" type="checkbox" class="form-check-input"
								   value="<?php echo $a['idtema']; ?>"  checked  >
							<?php echo $a['nombre_tema']; ?>
						</label>
					</div>
					<?php }else{ ?>
					<div class="form-check">
						<label class="form-check-label">
							<input id="checktema" name="idtema[]" type="checkbox" class="form-check-input"
								   value="<?php echo $a['idtema']; ?>"   >
							<?php echo $a['nombre_tema']; ?>
						</label>
					</div>

					<?php } ?>

				<?php endforeach; ?>

				<?php if(in_array(0, $ley->temas)): ?>
				<div class="form-check">
					<label class="form-check-label">
						<input id="checktema" name="idtema[]" type="checkbox" class="form-check-input"
							   value="0" checked  >
						Otro
					</label>
				</div>
				<?php else: ?>
				<div class="form-check">
					<label class="form-check-label">
						<input id="checktema" name="idtema[]" type="checkbox" class="form-check-input"
							   value="0"   >
						Otro
					</label>
				</div>
				<?php endif; ?>

			</div>
		</div>
	</div>
	<?php endif; ?>

	<br>
	<?php if(in_array(0, $ley->temas)): ?>
	<div id="otrotemac" class="contenedores">
		<label for="otrotema" >Especifique  otra :</label><br>
		<input type="text" id="otrotema" name="tema0" placeholder="Otro tema"
			   class="form-control" required
			   value="<?php
			   if(isset($ley) && !empty($ley->otro_tema) )
			   {
				   echo $ley->otro_tema;
			   }
			   ?>"
		>
	</div>
	<?php else: ?>
		<div id="otrotemac">

		</div>
	<?php endif; ?>

	<br>
	<div id="contenedor-submit">
		<button id="BOTON" type="submit" name="action"  >
			SIGUIENTE
		</button>
		<a href="<?php echo site_url('ley/cancelarNuevo/');?>">
			<input type="button" class="BOTONROJO" value="CANCELAR">
		</a>
	</div>

	<?php echo form_close();?>

	<br>
</main>



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

