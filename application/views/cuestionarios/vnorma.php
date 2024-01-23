
<main>
	<br><br>
	<?php echo validation_errors(); ?>
	<?php
	/** @noinspection PhpLanguageLevelInspection */
	$atr_form =[
		'id' => 'formulario_norma' ,
	]
	;?>
	<?php echo form_open('normativa/capturaDatos', $atr_form);?>

	<div class="contenedores_divididos">
		<div class="contenedor_superior2" id="contenedor_pequeño">
		</div>
		<div class="contenedor_inferior">
			<h3 id="Título_formulario"> Produccion Normativa </h3>
		</div>
	</div>
	<br>


	<div class="contenedores">
		<label for="instanciaseguimientonorma">Instancia de seguimiento:</label><br>
		<select id="instanciaseguimientonorma" name="instanciaseguimientonorma" class="form-control" required>
			<option value="" >Seleccione una instancia</option>
			<?php foreach ($instancias as $in): ?>
				<?php if($in->idinsseg != 1 ): ?>
				<option value="<?php echo $in->idinsseg; ?>"><?php echo $in->instancia; ?></option>
				<?php endif; ?>
			<?php endforeach; ?>
		</select>
	</div>
	<br>

	<div id="instancia_seguimiento_secundaria" >

	</div>
	<br>

	<div class="contenedores">
		<label for="estado_norma">Estado actual de la norma:</label><br>
		<select id="estado_norma" name="estado_norma" class="form-control" required>
			<option value="" >Seleccione el estado</option>
			<option value="1">Ley en Tratamiento</option>
			<option value="2">Ley Promulgada</option>
		</select>
	</div>
	<br>
	<div id="fechaprimerenvio" >

	</div>
	<br>

	<div class="contenedores">
		<label for="fecha">Introduzca la fecha de la norma:</label><br>
		<input type="date" id="fecha_norma" name="fecha_norma" value="" required >
		<input type="hidden" id="idcuestionario" name="idcuestionario" value="<?php echo $idformulario; ?>" >
		<input type="hidden" id="idusuario" name="idusuario" value="<?php echo $usuario->id;?>" >
	</div>
	<br>

	<!--
	<div class="contenedores">
		<label for="titular">Quién envía la norma para su tratamiento:</label><br>
		<input type="text" id="norma_remitente" name="norma_remitente" required class="form-control"
			   value=""
		>
	</div>
	<br>-->

	<!--
	<div class="contenedores">
		<label for="titular">A quién le llega la norma para su tratamiento:</label><br>
		<input type="text" id="norma_destinatario" name="norma_destinatario" required class="form-control"
			   value=""
		>
	</div>
	<br>-->

	<!--
	<div class="contenedores">
		<label for="titular">¿Existe un segundo envío/solicitud de la norma??</label><br>
		<div class="custom-control custom-radio custom-control-inline">
			<input type="radio" class="custom-control-input" id="norma_segundo1" name="norma_segundo" value="1" checked >
			<label class="custom-control-label" for="norma_segundo1">Si</label>
		</div>
		<div class="custom-control custom-radio custom-control-inline">
			<input type="radio" class="custom-control-input" id="norma_segundo2" name="norma_segundo" value="0">
			<label class="custom-control-label" for="norma_segundo2">No</label>
		</div>
	</div>

	<div id="segundodatos" class="contenedores">
		<label for="norma_segundo_datos">Registre quien y cuando realizo el segundo envio:</label><br>
		<input type="text" id="norma_segundo_datos" name="norma_segundo_datos" required class="form-control"
			   value="" placeholder="Si, Dip. xxxx">
	</div>
	<br> -->

	<div class="contenedores">
		<label for="titular">Codigo de la norma:</label><br>
		<input type="text" id="norma_codigo" name="norma_codigo" required class="form-control"
			   value=""
		>
	</div>
	<br>


	<div class="contenedores">
		<label for="norma_nombre">Nombre de la norma:</label><br>
		<input type="text" id="norma_nombre" name="norma_nombre" required class="form-control"
			   value=""
		>
	</div>
	<br>



	<div class="contenedores">
		<label for="norma_objeto">OBJETO DEL PROYECTO DE NORMA (COPIAR TEXTUALMENTE DEL PROYECTO):</label><br>
		<!--<input type="text" id="norma_objeto" name="norma_objeto" required class="form-control"
			   value=""> -->
		<textarea class="form-control" rows="5" id="norma_objeto" name="norma_objeto" required></textarea>	   
	</div>
	<br>


	<div class="contenedores">
		<div class="card">
			<div class="card-header cuest2">
				<h4>
					TEMA 1
				</h4>
			</div>
			<div class="card-body">
				<label>Escoge el tema:</label><br>
				<?php $contador = 0; ?>
				<?php foreach ($tema as $a): ?>
					<?php if($contador == 0): ?>
						<div class="custom-control custom-radio">
							<input id="checktema1norma<?php echo $a['idtema']; ?>" name="idtema" type="radio" value="<?php echo $a['idtema']; ?>" class="custom-control-input" checked>
							<label class="custom-control-label" for="checktema1norma<?php echo $a['idtema']; ?>" >
								<?php echo $a['nombre_tema']; ?>
							</label>
						</div>
						<?php $contador++; ?>
					<?php else: ?>
						<div class="custom-control custom-radio">
							<input id="checktema1norma<?php echo $a['idtema']; ?>" name="idtema" type="radio" value="<?php echo $a['idtema']; ?>" class="custom-control-input">
							<label class="custom-control-label" for="checktema1norma<?php echo $a['idtema']; ?>" >
								<?php echo $a['nombre_tema']; ?>
							</label>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
					<div class="custom-control custom-radio">
						<input id="checktema1norma0" name="idtema" type="radio" value="0" class="custom-control-input">
						<label class="custom-control-label" for="checktema1norma0" >
							Otro
						</label>
					</div>
					<div id="otrotema1normadatos">

					</div>
			</div>
		</div>
	</div>
	<br>

	<div class="contenedores">
		<div class="card">
			<div class="card-header cuest2">
				<h4>
					TEMA 2
				</h4>
			</div>
			<div class="card-body">
				<label>Escoge el tema:</label><br>
				<?php $contador2 = 0; ?>
				<?php foreach ($tema as $a): ?>
					<?php if($contador2 == 0): ?>
					<div class="custom-control custom-radio">
						<input id="checktema2norma<?php echo $a['idtema']; ?>" name="idtema2" type="radio" value="<?php echo $a['idtema']; ?>" class="custom-control-input" checked>
						<label class="custom-control-label" for="checktema2norma<?php echo $a['idtema']; ?>" >
							<?php echo $a['nombre_tema']; ?>
						</label>
					</div>
					<?php $contador2++; ?>
					<?php else: ?>
						<div class="custom-control custom-radio">
							<input id="checktema2norma<?php echo $a['idtema']; ?>" name="idtema2" type="radio" value="<?php echo $a['idtema']; ?>" class="custom-control-input">
							<label class="custom-control-label" for="checktema2norma<?php echo $a['idtema']; ?>" >
								<?php echo $a['nombre_tema']; ?>
							</label>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
				<div class="custom-control custom-radio">
					<input id="checktema2norma0" name="idtema2" type="radio" value="0" class="custom-control-input">
					<label class="custom-control-label" for="checktema2norma0" >
						Otro
					</label>
				</div>
				<!-- Informacion Otro tema 2 -->
				<div id="otrotema2normadatos">

				</div>
			</div>
		</div>
	</div>
	<br>



	<!--
	<div class="contenedores">
		<label for="proponente">Normativa propuesta por:</label><br>
		<select id="proponente" name="proponente" class="form-control" required>
			<option value="" >Seleccione el proponente</option>
			<option value="0">oficialismo</option>
			<option value="1">oposicion</option>
			<option value="2">otros</option>
		</select>
	</div>


	<div id="otroproponentedatos" >

	</div>
	<br>-->

	<div  class="contenedores">
		<label for="norma_obs">Observaciones:</label><br>
		<!--<input type="text" id="norma_obs" name="norma_obs" required class="form-control"
			   value="">-->
		<textarea class="form-control" rows="5" id="norma_obs" name="norma_obs" required></textarea>
	</div>
	<br>






	<div id="contenedor-submit">
		<button id="BOTON" type="submit" name="action" value="1" >
			SIGUIENTE
		</button>
		<a href="<?php echo site_url('');?>">
			<input type="button" class="BOTON" value="CANCELAR">
		</a>
	</div>

	<br>
	<?php echo form_close(); ?>

</main>



<!-- The Modal Preenvio de Normas -->
<div class="modal fade" id="preenvionorma">
	<div class="modal-dialog modal-xl modal-dialog-scrollable ">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header bg-info text-white ">
				<h4 class="modal-title">Norma a Registrar</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<!-- Modal body -->
			<div class="modal-body">
				<div class="container">
					<?php echo form_open('normativa/crearNorma', ['id' => 'formulario_norma_preenvio',]); ?>
					<div class="form-group">
						<input class="form-control" type="hidden" id="idcuestionario_pre" name="idcuestionario_pre">
						<input class="form-control" type="hidden" id="idusuario_pre" name="idusuario_pre" >
					</div>
					<div class="form-group">
						<label for="fecha_norma_pre">Fecha de la norma:</label>
						<input type="text" class="form-control" id="fecha_norma_pre" name="fecha_norma_pre" readonly>
						<input type="hidden" id="fecha_norma_unix_pre" name="fecha_norma_unix_pre">
					</div>
					<div class="form-group">
						<label for="instancia_seguimiento_pre">Instancia de seguimiento:</label>
						<input type="text" class="form-control" id="instancia_seguimiento_pre" name="instancia_seguimiento_pre" readonly required>
						<input type="hidden" class="form-control" id="idinstancia_seg_pre" name="idinstancia_seg_pre" >
					</div>

					<div id="instancia_secundaria" class="form-group">

					</div>

					<div class="form-group">
						<label for="estado_norma_pre">Estado actual de la norma:</label>
						<input type="text" class="form-control" id="estado_norma_pre" name="estado_norma_pre" required readonly>
						<input type="hidden" class="form-control" id="idestado_norma_pre" name="idestado_norma_pre">
					</div>
					<div id="fechaprimerenviopre" class="form-group">

					</div>
					
					<!--
					<div class="form-group">
						<label for="remitente_pre">Quién envía la norma para su tratamiento:</label>
						<input type="text" class="form-control" id="remitente_pre" name="remitente_pre" required >
					</div>
					<div class="form-group">
						<label for="destinatario_pre">A quién le llega la norma para su tratamiento:</label>
						<input type="text" class="form-control" id="destinatario_pre" name="destinatario_pre" required >
					</div>
					<div id="segundoenvio" class="form-group" >

					</div>
					-->


					<div  class="form-group">
						<label for="cod_norma_pre">Codigo de la norma:</label>
						<input type="text" class="form-control" id="cod_norma_pre" name="cod_norma_pre" required>
					</div>
					<div  class="form-group">
						<label for="nom_norma_pre">Nombre de la norma:</label>
						<input type="text" class="form-control" id="nom_norma_pre" name="nom_norma_pre" required>
					</div>
					<div  class="form-group">
						<label for="obj_norma_pre">OBJETO DEL PROYECTO DE NORMA:</label>
						<textarea class="form-control" rows="3" id="obj_norma_pre" name="obj_norma_pre" required></textarea>
					</div>

					<div id="tema1desp" class="form-group">

					</div>

					<div id="tema2desp" class="form-group">

					</div>

					<div id="propdesp" class="form-group">

					</div>

					<div class="form-group">
						<label for="observaciones_pre" >Observaciones:</label>
						<textarea class="form-control" rows="3" id="observaciones_pre" name="observaciones_pre" required></textarea>
					</div>
				</div>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button id="BOTON" type="submit" name="action" value="1" >
					GUARDAR
				</button>
				<button id="BOTON" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			</div>
			<?php form_close(); ?>
		</div>
	</div>
</div>


