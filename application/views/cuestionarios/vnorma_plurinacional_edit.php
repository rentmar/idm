<main>
	<br><br>
	<?php echo validation_errors(); ?>
	<?php
	/** @noinspection PhpLanguageLevelInspection */
	$atr_form =[
		'id' => 'formulario_norma_plurinacional' ,
	]
	;?>
	<?php echo form_open('normativa/capturaDatos', $atr_form);?>

	<div class="contenedores_divididos">
		<div class="contenedor_superior2" id="contenedor_pequeño">
		</div>
		<div class="contenedor_inferior">
			<h3 id="Título_formulario"> Produccion Normativa - Proyecto de Ley (PL) </h3>
		</div>
	</div>
	<br>


	<div class="contenedores">
		<label for="instanciaseguimientonorma">Instancia de seguimiento:</label><br>
		<input type="text" id="instancia_plu" name="instancia_plu" class="form-control" readonly="readonly"
			   value="<?php echo $instancia->instancia;?>">
		<input type="hidden" id="idinstancia_plu" name="idinstancia_plu" class="form-control"
			   value="<?php echo $instancia->idinsseg; ?>" >

	</div>
	<br>


	<!--<div class="contenedores">
		<label for="estado_norma">Estado actual de la norma:</label><br>
		<select id="estado_norma" name="estado_norma" class="form-control" required>
			<option value="" >Seleccione el estado</option>
			<option value="1">Ley en Tratamiento</option>
			<option value="2">Ley Promulgada</option>
		</select>
	</div>
	<br>-->

	<div class="contenedores">
		<div class="card">
			<div class="card-header cuest2">
				<h4>
					Datos Generales del Proyecto de ley
				</h4>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label for="codigo_plu">Codigo:</label>
					<input class="form-control" type="text" id="codigo_plu" name="codigo_plu" value="<?php echo $codigo;?>">
				</div>
				<div class="form-group">
					<label for="nombre_plu">Nombre de la norma:</label>
					<textarea rows="3" class="form-control" id="nombre_plu" name="nombre_plu"><?php echo $nombre_norma;?></textarea>
				</div>
				<div class="form-group">
					<label for="objeto_plu">Objeto de la norma:</label>
					<textarea rows="5" class="form-control" id="objeto_plu" name="objeto_plu"><?php echo $objeto_norma;?></textarea>
				</div>
			</div>
		</div>
		<div class="contenedores">
			<div class="card">
				<div class="card-header cuest2">
					<h4>
						TEMA 1
					</h4>
				</div>
				<div class="card-body">
					<div id="tema1-contenido">
						<label>Escoja el Tema1:</label><br>
						<select id="tema1" name="tema1" class="simple" style="width: 100%" >
							<option value="n" selected >Sin seleccion</option>
							<?php if(isset($tema)):?>
								<?php foreach ($tema as $a): ?>
									<option value="<?php echo $a['idtema']; ?>"><?php echo $a['nombre_tema']; ?></option>
								<?php endforeach; ?>
							<?php endif;?>
							<option value="0">Otro</option>
						</select>
					</div>
					<div id="otrotema1normadatos">

					</div>
				</div>
			</div>
		</div>

		<div class="contenedores">
			<div class="card">
				<div class="card-header cuest2">
					<div id="subtema1-titulo">
						<h4>
							SUBTEMA 1
						</h4>
					</div>
				</div>
				<div class="card-body">
					<div id="subtema1-contenido">
						<label>Escoja el subtema:</label><br>
						<select id="subtema1" name="subtema1" class="simple" style="width: 100%" >
							<option value="n" selected >Sin Seleccion</option>
						</select>
					</div>
				</div>
			</div>
		</div>

		<div class="contenedores">
			<div class="card">
				<div class="card-header cuest2">
					<h4>
						TEMA 2
					</h4>
				</div>
				<div class="card-body">
					<div id="tema2-contenido">
						<label>Escoja el Tema 2:</label><br>
						<select id="tema2" name="tema2" class="simple" style="width: 100%"  >
							<option value="n" selected >Sin seleccion</option>
							<?php if(isset($tema)):?>
								<?php foreach ($tema as $a): ?>
									<option value="<?php echo $a['idtema']; ?>"><?php echo $a['nombre_tema']; ?></option>
								<?php endforeach; ?>
							<?php endif;?>
							<option value="0">Otro</option>
						</select>
					</div>
					<!-- Informacion Otro tema 2 -->
					<div id="otrotema2normadatos">

					</div>
				</div>
			</div>
		</div>
		<div class="contenedores">
			<div class="card">
				<div class="card-header cuest2">
					<div id="subtema2-titulo">
						<h4>
							SUBTEMA 2
						</h4>
					</div>
				</div>
				<div class="card-body">
					<div id="subtema2-contenido">
						<label>Escoja el subtema:</label><br>
						<select id="subtema2" name="subtema2" class="simple" style="width: 100%"  >
							<option value="n" selected >Sin seleccion</option>
						</select>
					</div>
				</div>
			</div>
		</div>

	</div>
	<br>
	<div class="contenedores">
		<div class="card">
			<div class="card-header cuest2">
				<h4>
					Propuesta por:
				</h4>
			</div>
			<div class="card-body">
				<div class="contenedores">
					<label for="proponente">Normativa propuesta por:</label><br>
					<select id="proponente" name="proponente" class="form-control">
						<?php if($proponente->idproponente == 0): ?>
							<option value="ninguno" >Seleccione el proponente</option>
							<option selected value="0">oficialismo</option>
							<option value="1">oposicion</option>
							<option value="2">otros</option>
						<?php elseif ($proponente->idproponente == 1):?>
							<option value="ninguno" >Seleccione el proponente</option>
							<option value="0">oficialismo</option>
							<option selected value="1">oposicion</option>
							<option value="2">otros</option>
						<?php elseif ($proponente->idproponente == 2):?>
							<option value="ninguno" >Seleccione el proponente</option>
							<option value="0">oficialismo</option>
							<option value="1">oposicion</option>
							<option selected value="2">otros</option>
						<?php else:?>
							<option selected value="ninguno" >Seleccione el proponente</option>
							<option selected value="0">oficialismo</option>
							<option value="1">oposicion</option>
							<option value="2">otros</option>
						<?php endif;?>


					</select>
				</div>
				<div id="otroproponentedatos" >

				</div>

			</div>
		</div>
	</div>
	<br>
	<div class="contenedores">
		<div class="card">
			<div class="card-header cuest2">
				<h4>
					Presentacion del proyecto de ley:
				</h4>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label for="remitente_plu" >Quien presenta el proyecto de ley:</label>
					<textarea class="form-control" rows="3" id="remitente_plu" name="remitente_plu"><?php echo $remitente;?></textarea>
				</div>
				<div class="form-group">
					<label for="destinatario_plu" >A quien se presenta el proyecto de ley:</label>
					<textarea class="form-control" rows="3" id="destinatario_plu" name="destinatario_plu"><?php echo $destinatario;?></textarea>
				</div>
				<div class="form-group">
					<label for="fecha_norma_plu" >Fecha de presentacion:</label>
					<input class="form-control" type="date" id="fecha_norma_plu" name="fecha_norma_plu" >
				</div>

			</div>
		</div>
	</div>
	<br>
	<div class="contenedores">
		<div class="card">
			<div class="card-header cuest2">
				<h4>
					Ultima reposicion del proyecto de ley:
				</h4>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label for="remitente_solrep_plu" >Quien presenta solicitud de reposicion:</label>
					<textarea class="form-control" rows="3" id="remitente_solrep_plu" name="remitente_solrep_plu"></textarea>
				</div>
				<div class="form-group">
					<label for="destinatario_solrep_plu" >A quien se presenta solicitud de reposicion:</label>
					<textarea class="form-control" rows="3" id="destinatario_solrep_plu" name="destinatario_solrep_plu"></textarea>
				</div>
				<div class="form-group">
					<label for="fecha_norma_solrep_plu" >Fecha de solicitud de reposicion:</label>
					<input class="form-control" type="date" id="fecha_norma_solrep_plu" name="fecha_norma_solrep_plu">
				</div>

			</div>
		</div>
	</div>
	<br>
	<div class="contenedores">
		<div class="card">
			<div class="card-header cuest2">
				<h4>
					Otros:
				</h4>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label for="observaciones_plu">Observaciones:</label>
					<textarea class="form-control" rows="2" id="observaciones_plu" name="observaciones_plu"></textarea>
				</div>
				<div class="form-group">
					<label for="enlace_plu">Enlace/URL:</label>
					<textarea class="form-control" rows="2" id="enlace_plu" name="enlace_plu"></textarea>
				</div>

			</div>
		</div>
	</div>
	<br>
	<div class="contenedores">
		<div class="card">
			<div class="card-header cuest2">
				<h4>
					Datos del registro:
				</h4>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label for="observaciones_met_plu">Observaciones metodologicas:</label>
					<textarea class="form-control" rows="2" id="observaciones_met_plu" name="observaciones_met_plu"></textarea>
				</div>
				<div class="form-group">
					<input class="form-control" type="hidden" id="idcuestionario" name="idcuestionario" value="<?php echo $idformulario; ?>">
					<input class="form-control" type="hidden" id="idusuario" name="idusuario" value="<?php echo $usuario->id; ?>">
				</div>
			</div>
		</div>
	</div>
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
<div class="modal fade" id="preenvionormaplurinacional">
	<div class="modal-dialog modal-xl modal-dialog-scrollable ">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header bg-info text-white ">
				<h4 class="modal-title">Norma a Registrar - Proyecto de Ley</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<!-- Modal body -->
			<div class="modal-body">
				<div class="container">
					<?php echo form_open('normativa/crearNorma', ['id' => 'formulario_norma_pluricaional_preenvio',]); ?>

					<div class="card">
						<div class="card-header bg-info">
							<h4>
								Datos Generales del Proyecto de ley
							</h4>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label for="codigo_plu_pre">Codigo:</label>
								<input class="form-control" type="text" id="codigo_plu_pre" name="codigo_plu_pre">
							</div>
							<div class="form-group">
								<label for="nombre_plu_pre">Nombre de la norma:</label>
								<textarea rows="3" class="form-control" id="nombre_plu_pre" name="nombre_plu_pre"></textarea>
							</div>
							<div class="form-group">
								<label for="objeto_plu_pre">Objeto de la norma:</label>
								<textarea rows="5" class="form-control" id="objeto_plu_pre" name="objeto_plu_pre"></textarea>
							</div>
							<div id="tema1desp" class="form-group">
							</div>
							<div id="tema2desp" class="form-group">
							</div>
							<div id="subtema1desp" class="form-group">
							</div>
							<div id="subtema2desp" class="form-group">
							</div>

							<div id="propdesp" class="form-group">

							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header bg-info">
							<h4>
								Presentacion del proyecto de ley:
							</h4>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label for="remitente_plu_pre" >Quien presenta el proyecto de ley:</label>
								<textarea class="form-control" rows="3" id="remitente_plu_pre" name="remitente_plu_pre"></textarea>
							</div>
							<div class="form-group">
								<label for="destinatario_plu_pre" >A quien se presenta el proyecto de ley:</label>
								<textarea class="form-control" rows="3" id="destinatario_plu_pre" name="destinatario_plu_pre"></textarea>
							</div>
							<div class="form-group">
								<label for="fecha_norma_plu_pre" >Fecha de presentacion:</label>
								<input class="form-control" type="text" id="fecha_norma_plu_pre" name="fecha_norma_plu_pre" readonly>
								<input class="form-control" type="hidden" id="unixfecha_norma_plu_pre" name="unixfecha_norma_plu_pre" >
							</div>

						</div>
					</div>
					<div class="card">
						<div class="card-header bg-info">
							<h4>
								Ultima reposicion del proyecto de ley:
							</h4>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label for="remitente_solrep_plu_pre" >Quien presenta solicitud de reposicion:</label>
								<textarea class="form-control" rows="3" id="remitente_solrep_plu_pre" name="remitente_solrep_plu_pre"></textarea>
							</div>
							<div class="form-group">
								<label for="destinatario_solrep_plu_pre" >A quien se presenta solicitud de reposicion:</label>
								<textarea class="form-control" rows="3" id="destinatario_solrep_plu_pre" name="destinatario_solrep_plu_pre"></textarea>
							</div>
							<div class="form-group">
								<label for="fecha_norma_solrep_plu_pre" >Fecha de solicitud de reposicion:</label>
								<input class="form-control" type="text" id="fecha_norma_solrep_plu_pre" name="fecha_norma_solrep_plu_pre" readonly>
								<input class="form-control" type="hidden" id="unixfecha_norma_solrep_plu_pre" name="fecha_norma_solrep_plu_pre">
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header bg-info">
							<h4>
								Otros:
							</h4>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label for="observaciones_plu_pre">Observaciones:</label>
								<textarea class="form-control" rows="2" id="observaciones_plu_pre" name="observaciones_plu_pre"></textarea>
							</div>
							<div class="form-group">
								<label for="enlace_plu_pre">Enlace/URL:</label>
								<textarea class="form-control" rows="2" id="enlace_plu_pre" name="enlace_plu_pre"></textarea>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header bg-info">
							<h4>
								Datos del registro:
							</h4>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label for="observaciones_met_plu_pre">Observaciones metodologicas:</label>
								<textarea class="form-control" rows="2" id="observaciones_met_plu_pre" name="observaciones_met_plu_pre"></textarea>
							</div>
							<div class="form-group">
								<input class="form-control" type="hidden" id="idcuestionario_pre" name="idcuestionario_pre" value="<?php echo $idformulario; ?>">
								<input class="form-control" type="hidden" id="idusuario_pre" name="idusuario_pre" value="<?php echo $usuario->id; ?>">
								<input class="form-control" type="hidden" id="idinstancia_seg_pre" name="idinstancia_seg_pre" value="1">

							</div>
						</div>
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


