<!DOCTYPE html>
<html lang="es">
<head>
	<title>Formulario Encuesta</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
	<div class="jumbotron">
		<h1 class="text-center"><?php echo $encuesta->uinombre_encuesta; ?></h1>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<?php if(isset($encuesta->uiencuesta_nota)): ?>
			<div class="form-group">
				<div class="alert alert-success">
					<strong>Introduccion</strong>
					<?php echo $encuesta->uiencuesta_nota; ?>
				</div>
			</div>
			<?php endif; ?>
			<?php
			/** @noinspection PhpLanguageLevelInspection */
			$form_enc = [
				'id' => 'formencuesta',
			];
			?>
			<?php echo form_open('read/capturar', $form_enc); ?>

			<h3>Informacion General</h3>
			<?php if($idencuesta == 3): ?>
			<div class="form-group">
				<label for="ciudad">Ciudad</label>
				<input type="text" name="ciudad" class="form-control" id="ciudad" required >
			</div>
			<?php endif; ?>
			<div class="form-group">
				<label for="edad">Edad:</label>
				<input type="number" name="edad" class="form-control" id="edad" min="0" max="100" required>
			</div>

			<div><hr></div>

			<div class="form-check-inline">
				<label class="form-check-label">
					<input checked id="sexo" name="sexo" type="radio" class="form-check-input" value="F">
					Femenino
				</label>
			</div>
			<div class="form-check-inline">
				<label class="form-check-label">
					<input id="sexo" name="sexo" type="radio" class="form-check-input" value="M">
					Masculino
				</label>
			</div>

			<div>
				<hr>
			</div>
			<br>

			<?php if($idencuesta != 3):?>
			<div class="form-check-inline">
				<label class="form-check-label">
					<input checked id="area" name="area" type="radio" class="form-check-input" value="urbana">
					Urbana
				</label>
			</div>
			<div class="form-check-inline">
				<label class="form-check-label">
					<input id="area" name="area" type="radio" class="form-check-input" value="rural">
					Rural
				</label>
			</div>

			<div>
				<hr>
			</div>

			<div class="form-group">
				<!--
				<label for="edad">Ciudad/Poblacion:</label>
				<input type="text" name="ciudad" class="form-control" id="ciudad" required >
				-->
				<select name="ciudad" id="ciudad" class="custom-select" required>
					<option value="" selected>Ciudad/Poblacion</option>
					<option value="La Paz">La Paz</option>
					<option value="El Alto">El Alto</option>
					<option value="Santa Cruz">Santa Cruz</option>
					<option value="Cochabamba">Cochabamba</option>
					<option value="Oruro">Oruro</option>
					<option value="Chuquisaca">Chuquisaca</option>
					<option value="Tarija">Tarija</option>
					<option value="Beni">Beni</option>
					<option value="Pando">Pando</option>
					<option value="Potosi">Potosi</option>

				</select>
			</div>

			<div class="form-group">
				<label for="zona">Zona:</label>
				<input type="text" name="zona" class="form-control" id="zona" required >
			</div>

			<div>
				<hr>
			</div>

			<div class="form-group">
				<label for="sit_laboral">Situacion Laboral:</label>
			</div>

			<div class="form-check-inline">
				<label class="form-check-label">
					<input checked id="sit_laboral" name="sit_laboral" type="radio" class="form-check-input" value="empleado">
					Empleado
				</label>
			</div>
			<div class="form-check-inline">
				<label class="form-check-label">
					<input id="sit_laboral" name="sit_laboral" type="radio" class="form-check-input" value="desempleado">
					Desempleado
				</label>
			</div>
			<div class="form-check-inline">
				<label class="form-check-label">
					<input id="sit_laboral" name="sit_laboral" type="radio" class="form-check-input" value="independiente">
					Independiente
				</label>
			</div>

			<div>
				<hr>
			</div>

			<div class="form-group">
				<label for="sit_educativa">Situacion Educativa:</label>
			</div>

			<div class="form-check-inline">
				<label class="form-check-label">
					<input checked id="sit_educativa" name="sit_educativa" type="radio" class="form-check-input" value="estudia">
					Estudia
				</label>
			</div>
			<div class="form-check-inline">
				<label class="form-check-label">
					<input id="sit_educativa" name="sit_educativa" type="radio" class="form-check-input" value="no_estudia">
					No estudia
				</label>
			</div>
			<div class="form-check-inline">
				<label class="form-check-label">
					<input id="sit_educativa" name="sit_educativa" type="radio" class="form-check-input" value="no_corresponde">
					No corresponde
				</label>
			</div>
			<div>
				<hr>
			</div>
			<?php endif; ?>

			<?php if($idencuesta == 3): ?>
			<div class="form-group">
				<label for="sit_educativa">¿Cuál fue el último NIVEL EDUCATIVO que aprobó?</label>
			</div>

			<div class="form-check-inline">
				<label class="form-check-label">
					<input checked id="sit_educativa" name="sit_educativa" type="radio" class="form-check-input" value="ninguno">
					Ninguno
				</label>
			</div>
			<div class="form-check-inline">
				<label class="form-check-label">
					<input id="sit_educativa" name="sit_educativa" type="radio" class="form-check-input" value="primaria">
					Primaria
				</label>
			</div>
			<div class="form-check-inline">
				<label class="form-check-label">
					<input id="sit_educativa" name="sit_educativa" type="radio" class="form-check-input" value="secundaria">
					Secundaria
				</label>
			</div>
			<div class="form-check-inline">
				<label class="form-check-label">
					<input id="sit_educativa" name="sit_educativa" type="radio" class="form-check-input" value="bachiller">
					Bachiller
				</label>
			</div>
			<div class="form-check-inline">
				<label class="form-check-label">
					<input id="sit_educativa" name="sit_educativa" type="radio" class="form-check-input" value="tecnico">
					Técnico
				</label>
			</div>
			<div class="form-check-inline">
				<label class="form-check-label">
					<input id="sit_educativa" name="sit_educativa" type="radio" class="form-check-input" value="universitario">
					Universitario
				</label>
			</div>
			<div class="form-check-inline">
				<label class="form-check-label">
					<input id="sit_educativa" name="sit_educativa" type="radio" class="form-check-input" value="profesional">
					Profesional
				</label>
			</div>
			<div>
				<hr>
			</div>

				<div class="form-group">
					<label for="sit_laboral">¿Qué OCUPACIÓN tiene?</label>
				</div>

				<div class="form-check">
					<label class="form-check-label">
						<input checked id="sit_laboral" name="sit_laboral" type="radio" class="form-check-input" value="ama_de_casa">
						Ama de Casa
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input id="sit_laboral" name="sit_laboral" type="radio" class="form-check-input" value="estudiante">
						Estudiante
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input id="sit_laboral" name="sit_laboral" type="radio" class="form-check-input" value="jubilado">
						Jubilado
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input id="sit_laboral" name="sit_laboral" type="radio" class="form-check-input" value="desocupado">
						Desocupado
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input id="sit_laboral" name="sit_laboral" type="radio" class="form-check-input" value="empleado_privado">
						Empleado Privado
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input id="sit_laboral" name="sit_laboral" type="radio" class="form-check-input" value="empleado_publico">
						Empleado Público
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input id="sit_laboral" name="sit_laboral" type="radio" class="form-check-input" value="profesional_independiente">
						Profesional Independiente
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input id="sit_laboral" name="sit_laboral" type="radio" class="form-check-input" value="obrero">
						Obrero
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input id="sit_laboral" name="sit_laboral" type="radio" class="form-check-input" value="artesano">
						Artesano
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input id="sit_laboral" name="sit_laboral" type="radio" class="form-check-input" value="comerciante">
						Comerciante
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input id="sit_laboral" name="sit_laboral" type="radio" class="form-check-input" value="agricultor">
						Agricultor
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input id="sit_laboral" name="sit_laboral" type="radio" class="form-check-input" value="otro">
						Otro
					</label>
				</div>
				<div class="form-group">
					<input id="sit_laboral_otro" name="sit_laboral_otro" type="text" class="form-control" placeholder="Escriba otro">
				</div>
				<div>
					<hr>
				</div>


			<?php endif; ?>





			<!-- Seleccion de Modulos -->
			<?php echo $sel_modulos; ?>
			<!-- Fin Seleccion de Modulos -->

			<!-- Despliegue de Modulos -->
			<?php echo $cont_modulo; ?>
			<!-- Fin Despliegue de Modulos -->



			<?php if($no_es_vista_previa): ?>
				<div>
					<input type="hidden" name="iduiencuesta" id="iduiencuesta" value="<?php echo $datos_generales->rel_iduiencuesta; ?>" >
					<input type="hidden" name="numero_formh" id="numero_formh" value="<?php echo $datos_generales->hash_text; ?>" >
					<input type="hidden" name="idusuario" id="idusuario" value="<?php echo $datos_generales->rel_idusuario;?>">
					<input type="hidden" name="idencuesta_asignada" id="idencuesta_asignada" value="<?php echo $datos_generales->idencuesta?>"  >
					<input type="hidden" name="idgeolocal" id="idgeolocal" value="<?php echo $datos_generales->rel_idgeolocal;?>"  >
					<input type="hidden" name="latitud_f" id="latitud_f">
					<input type="hidden" name="longitud_f" id="longitud_f" >
					<input type="hidden" id="tiempoinicio" name="tiempoinicio" value="<?php echo $tiempo;?>">
				</div>
			<?php endif; ?>
			<div>
				<hr>
			</div>
			<div class="form-group">
				<?php if($no_es_vista_previa):?>
					<button id="enviarencuesta" type="submit" class="btn btn-primary">Enviar</button>
				<?php endif; ?>
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#salirencuesta">
					Salir
				</button>
			</div>
			<?php echo form_close(); ?>


		</div>
	</div>
</div>

<!-- The Modal -->
<div class="modal fade" id="salirencuesta">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header bg-danger text-white">
				<h4 class="modal-title">Salir de la encuesta?</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<?php if($no_es_vista_previa):?>
					<?php echo form_open('inicio/');?>
				<?php else: ?>
					<?php echo form_open('encuesta/formulariosEncuesta/');?>
				<?php endif; ?>
				Esta Seguro?. Toda la informacion se perdera.
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="submit" class="btn btn-secondary" >Si</button>
				<?php echo form_close();?>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
			</div>
		</div>
	</div>
</div>


<script>
	var iduiencuesta = <?php echo $datos_generales->rel_iduiencuesta;?>;
</script>
<script>var baseurl = "<?php echo site_url(); ?>";</script>
<!-- The Modal de alerta TEMAS SIN SELECCIONAR -->
<div class="modal fade" id="cuestionarioincompleto">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header bg-warning">
				<h4 class="modal-title text-white ">Alerta</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				Formulario incompleto, existen preguntas por llenar.
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button id="BOTON" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>

		</div>
	</div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('assets/js/geo.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/formulario.js'); ?>"></script>
</body>
</html>
