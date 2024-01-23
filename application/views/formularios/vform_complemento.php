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
		<h1 class="text-center"><?php //echo $encuesta->uinombre_encuesta; ?></h1>
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

			<div class="card">
				<div class="card-header"><h3>Informacion General</h3></div>
				<div class="card-body">
					<ul class="list-group list-group-flush ">
						<li class="list-group-item"><i class="font-weight-bold">Ciudad:</i>
							<?php echo $formulario_resp->nombre_ciudad;  ?>
						</li>
						<li class="list-group-item"><i class="font-weight-bold">Zona:</i>
							<?php echo $formulario_resp->nombre_zona;  ?>
						</li>
						<li class="list-group-item"><i class="font-weight-bold">Lugar:</i>
							<?php echo $formulario_resp->nombre_lugar;  ?>
						</li>
						<li class="list-group-item"><i class="font-weight-bold">Nombre del lugar:</i>
							<?php echo $formulario_resp->nombre  ?>
						</li>
					</ul>
					<input type="hidden" name="idformulario_resp" id="idformulario_resp" value="<?php echo $formulario_resp->idformresp; ?>" >
				</div>
			</div>

			<div>
				<div id="accordion">
					<?php foreach ($familias as $f): ?>
						<div class="card">
							<div class="card-header">
								<a class="card-link" data-toggle="collapse" href="#collapse-<?php echo $f->idflia; ?>">
									<?php echo $f->nombre_familia; ?>
								</a>
							</div>
							<div id="collapse-<?php echo $f->idflia; ?>" class="collapse" >
								<div class="card-body">
									<?php foreach ($subfamilias as $s): ?>
										<?php if(isset($s->idsubflia)): ?>
											<?php if($s->rel_idflia == $f->idflia): ?>
												<a href="">
													<?php echo $s->nombre_subfamilia; ?>
												</a>
											<?php endif; ?>
										<?php endif;?>
									<?php endforeach;  ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>




			<div>
				<input type="hidden" name="idformulario_resp" id="idformulario_resp" value="<?php //echo $datos_generales->rel_iduiencuesta; ?>" >
				<input type="hidden" name="iduiencuesta" id="iduiencuesta" value="<?php //echo $datos_generales->rel_iduiencuesta; ?>" >
				<input type="hidden" name="numero_formh" id="numero_formh" value="<?php //echo $datos_generales->hash_text; ?>" >
				<input type="hidden" name="idusuario" id="idusuario" value="<?php //echo $datos_generales->rel_idusuario;?>">
				<input type="hidden" name="idencuesta_asignada" id="idencuesta_asignada" value="<?php //echo $datos_generales->idencuesta?>"  >
				<input type="hidden" name="idgeolocal" id="idgeolocal" value="<?php //echo $datos_generales->rel_idgeolocal;?>"  >
				<input type="hidden" name="latitud_f" id="latitud_f">
				<input type="hidden" name="longitud_f" id="longitud_f" >
				<input type="hidden" id="tiempoinicio" name="tiempoinicio" value="<?php //echo $tiempo;?>">
			</div>
			<div>
				<hr>
			</div>
			<div class="form-group">
				<button id="enviarencuesta" type="submit" class="btn btn-primary">Enviar</button>
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
				<?php if(true):?>
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
    //var iduiencuesta = <?php //echo $datos_generales->rel_iduiencuesta;?>;
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
<script src="<?php echo base_url('assets/js/formulario.js'); ?>"></script>
</body>
</html>
