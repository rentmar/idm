<!DOCTYPE html>
<html lang="es">
<head>
	<title>Formulario Encuesta</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-sm bg-light justify-content-center fixed-bottom">
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" href="#">Cerrar Formulario</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="<?php echo site_url('inicio/');?>">
				Inicio
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="<?php echo site_url('formulario/formulariocmp/'.$formulario_resp->idformresp);?>">
				Menu principal
			</a>
		</li>
	</ul>
</nav>

<div class="container">
	<div class="jumbotron">
		<h1 class="text-center"><?php  echo $formulario_resp->form_nombre; ?></h1>
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
				<hr>
			</div>
			<div>
				<h2><?php echo $familia->nombre_familia;?></h2>
			</div>
			<div>
				<hr>
			</div>
			<?php foreach ($subfamilias as $s): ?>
			<div class="card">
				<div class="card-header">
					<div class="d-flex ">
						<div class="p-2  "><h3><?php echo $s->nombre_subfamilia;?></h3></div>

						<?php $imagenes = $this->Formulario_model->getImagenesSubfamilia($s->idsubflia); ?>
						<?php foreach ($imagenes as $img): ?>
							<div class="p-2 ">
								<img src="<?php echo base_url($img->img_url); ?>" class="img-thumbnail" width="100" height="92" >
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="card-body">
					<div>
						<div class="card-deck">
							<?php $items = $this->Formulario_model->getItemPorSubfamilia($s->idsubflia); ?>

							<?php foreach ($items as $it):  ?>
							<div class="col-md-3">
								<div class="card">
									<div class="card-body">
										<h4 class="card-title">
											<?php echo $it->nombre_item;?>
										</h4>
										<p class="card-text">
											Codigo: <?php echo $it->codigo_item; ?>.
										</p>
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal<?php echo $it->iditem; ?>">
											Registrar
										</button>
									</div>
								</div>
							</div>

							<!-- MODAL --->
								<div class="modal fade" id="modal<?php echo $it->iditem; ?>">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">

											<!-- Modal Header -->
											<div class="modal-header">
												<h4 class="modal-title">
													<?php echo $it->nombre_item;?>

												</h4>
												<button type="button" class="close" data-dismiss="modal">&times;</button>
											</div>

											<!-- Modal body -->
											<div class="modal-body">
												<?php $codigo_item = ' '.$it->codigo_item.' ';  ?>
												<?php //$codigo_item = 'A1'; ?>
												<?php $marcaPrecios = $this->Formulario_model->getMarcasPrecios($formulario_resp->idformresp, $codigo_item); ?>
												<?php

														//var_dump($marcaPrecios);
														$marcas_json = $marcaPrecios['marca'];
														//var_dump($marcas_json);
														$marcas = json_decode($marcas_json);
														//var_dump($marcas);
												?>
												<?php echo form_open('formulario/procesar/'); ?>

													<?php if(!empty($marcas)):?>
													<?php foreach ($marcas as $m): ?>
													<div class="form-group">
														<label for="precio-<?php echo $m->marca; ?>">
															<?php echo $m->marca; ?>
														</label>
														<input type="number"  class="form-control" id="precio-<?php echo $m->marca; ?>" name="precio-<?php echo $m->marca; ?>">
													</div>
													<?php endforeach; ?>
													<?php endif; ?>
													<div class="form-group">
														<input type="text" class="form-control" id="idformresp" name="idformresp" value="<?php echo $formulario_resp->idformresp; ?>" >
														<input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo $it->codigo_item; ?>" >

													</div>
											</div>

											<!-- Modal footer -->
											<div class="modal-footer">
												<button type="submit" class="btn btn-primary">Registrar</button>
												<?php echo form_close(); ?>
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											</div>

										</div>
									</div>
								</div>


								<!-- FIN MODAL --->


							<?php endforeach; ?>



						</div>
					</div>


				</div>
			</div>
			<br>
			<?php endforeach; ?>






		</div>

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

<br><br><br><br><br><br><br><br><br><br>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('assets/js/formulario.js'); ?>"></script>
</body>
</html>
