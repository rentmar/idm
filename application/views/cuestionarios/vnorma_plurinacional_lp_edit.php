<main>
	<br><br>
	<?php echo validation_errors(); ?>
	<?php
	/** @noinspection PhpLanguageLevelInspection */
	$atr_form =[
		'id' => 'formulario_norma_plurinacional_lp' ,
	]
	;?>
	<?php echo form_open('normativa/capturaDatos', $atr_form);?>

	<div class="contenedores_divididos">
		<div class="contenedor_superior2" id="contenedor_pequeño">
		</div>
		<div class="contenedor_inferior">
			<h3 id="Título_formulario"> Produccion Normativa - Ley Promulgada (LP) </h3>
		</div>
	</div>
	<br>


	<div class="contenedores">
		<label for="instanciaseguimientonorma">Instancia de seguimiento:</label><br>
		<input type="text" id="instancia_plu_lp" name="instancia_plu_lp" class="form-control" readonly="readonly"
			   value="<?php echo $instancia->instancia;?>">
		<input type="hidden" id="idinstancia_plu_lp" name="idinstancia_plu_lp" class="form-control"
			   value="<?php echo $instancia->idinsseg; ?>" >

	</div>
	<br>



	<div class="contenedores">
		<div class="card">
			<div class="card-header cuest2">
				<h4>
					Datos Generales
				</h4>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label for="codigo_plu_lp">Codigo:</label>
					<input class="form-control" type="text" id="codigo_plu_lp" name="codigo_plu_lp">
				</div>
				<div class="form-group">
					<label for="nombre_plu_lp">Nombre de la norma:</label>
					<textarea rows="3" class="form-control" id="nombre_plu_lp" name="nombre_plu_lp"></textarea>
				</div>
				<div class="form-group">
					<label for="objeto_plu_lp">Objeto de la norma:</label>
					<textarea rows="5" class="form-control" id="objeto_plu_lp" name="objeto_plu_lp"></textarea>
				</div>
				<div class="form-group">
					<label for="fecha_plu_lp">Fecha de la norma</label>
					<input class="form-control" type="date" id="fecha_plu_lp" name="fecha_plu_lp">
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
						<select id="subtema1" name="subtema1" class="simple" style="width: 100%" required >
							<option value="n" selected >Sin seleccion</option>
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
						<select id="subtema2" name="subtema2" class="simple" style="width: 100%" required >
							<option value="n" selected >Sin Seleccion</option>
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
					Antecedentes de Ley:
				</h4>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label for="codigo_previo_plu_lp">Introduzca codigo de proyecto de ley:</label>
					<input class="form-control"  type="text" id="codigo_previo_plu_lp" name="codigo_previo_plu_lp">
				</div>
				<div class="form-group">
					<label for="observaciones_plu">Comentarios:</label>
					<textarea class="form-control" rows="2" id="comentarios_plu_lp" name="comentarios_plu_lp"></textarea>
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
<div class="modal fade" id="preenvionormaplurinacionallp">
	<div class="modal-dialog modal-xl modal-dialog-scrollable ">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header bg-info text-white ">
				<h4 class="modal-title">Norma a Registrar - Ley Promulgada</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<!-- Modal body -->
			<div class="modal-body">
				<div class="container">
					<?php echo form_open('normativa/crearNorma', ['id' => 'formulario_norma_pluricaional_preenvio',]); ?>

					<div class="card">
						<div class="card-header bg-info">
							<h4>
								Datos Generales
							</h4>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label for="codigo_plu_lp_pre">Codigo:</label>
								<input class="form-control" type="text" id="codigo_plu_lp_pre" name="codigo_plu_lp_pre">
							</div>
							<div class="form-group">
								<label for="nombre_plu_lp_pre">Nombre de la norma:</label>
								<textarea rows="3" class="form-control" id="nombre_plu_lp_pre" name="nombre_plu_lp_pre"></textarea>
							</div>
							<div class="form-group">
								<label for="objeto_plu_lp_pre">Objeto de la norma:</label>
								<textarea rows="5" class="form-control" id="objeto_plu_lp_pre" name="objeto_plu_lp_pre"></textarea>
							</div>
							<div class="form-group">
								<label for="fecha_plu_lp_pre">Fecha de la norma:</label>
								<input class="form-control" type="date" id="fecha_plu_lp_pre" name="fecha_plu_lp_pre" readonly>
								<input class="form-control" type="text" id="unixfecha_plu_lp_pre" name="unixfecha_plu_lp_pre">
							</div>
							<div id="tema1desp" class="form-group">
							</div>
							<div id="subtema1desp" class="form-group">
							</div>
							<div id="tema2desp" class="form-group">
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
								Antecedentes de ley:
							</h4>
						</div>
						<div class="card-body">

							<div class="form-group">
								<label for="codigo_previo_plu_lp_pre">Introduzca codigo de proyecto de ley:</label>
								<input class="form-control"  type="text" id="codigo_previo_plu_lp_pre" name="codigo_previo_plu_lp_pre">
							</div>
							<div class="form-group">
								<label for="observaciones_plu">Comentarios:</label>
								<textarea class="form-control" rows="2" id="comentarios_plu_lp_pre" name="comentarios_plu_lp_pre"></textarea>
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
								<label for="observaciones_plu_lp_pre">Observaciones:</label>
								<textarea class="form-control" rows="2" id="observaciones_plu_lp_pre" name="observaciones_plu_lp_pre"></textarea>
							</div>
							<div class="form-group">
								<label for="enlace_plu_lp_pre">Enlace/URL:</label>
								<textarea class="form-control" rows="2" id="enlace_plu_lp_pre" name="enlace_plu_lp_pre"></textarea>
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
								<label for="observaciones_met_plu_lp_pre">Observaciones metodologicas:</label>
								<textarea class="form-control" rows="2" id="observaciones_met_plu_lp_pre" name="observaciones_met_plu_lp_pre"></textarea>
							</div>
							<div class="form-group">
								<input class="form-control" type="hidden" id="idcuestionario_plu_lp_pre" name="idcuestionario_plu_lp_pre" value="<?php echo $idformulario; ?>">
								<input class="form-control" type="hidden" id="idusuario_plu_lp_pre" name="idusuario_plu_lp_pre" value="<?php echo $usuario->id; ?>">
								<input class="form-control" type="hidden" id="idinstancia_seg_pre" name="idinstancia_seg_pre" value="4">

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

