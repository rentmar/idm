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
			<a class="nav-link" href="<?php echo site_url('formulario/cerrar/'.$formulario_resp->idformresp);?>">Cerrar Formulario</a>
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
		</div>

	</div>
</div>
<div class="container">
	<div class="card-deck">
		<?php foreach ($items as $i): ?>
		<div class="col-md-3">
			<div class="card">
				<img class="card-img-top  " src="<?php echo base_url($i->imagen);?>" alt="Card image">
				<div class="card-body>">
					<h4 class="card-title"><?php echo $i->nombre_item;?></h4>
					<p class="card-text">
						Codigo: <?php echo $i->codigo_item; ?>.
					</p>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#item-<?php echo $i->iditem; ?>">
						Registrar
					</button>
				</div>
			</div>
		</div>

			<!-- MODAL --->
			<div class="modal fade" id="item-<?php echo $i->iditem; ?>">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">

						<!-- Modal Header -->
						<div class="modal-header">
							<h4 class="modal-title">
								<?php echo $i->nombre_item;?>

							</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

						<!-- Modal body -->
						<div class="modal-body">
							<?php $codigo_item = ' '.$i->codigo_item.' ';  ?>
							<?php $marcaPrecios = $this->Formulario_model->getMarcasPrecios($formulario_resp->idformresp, $codigo_item); ?>
							<?php

							//var_dump($marcaPrecios);
							$marcas_json = $marcaPrecios['marca'];
							//var_dump($marcas_json);
							$marcas = json_decode($marcas_json);
							//var_dump($marcas);
							?>

							<?php echo form_open('formulario/procesaritemf/');?>
							<?php if(!empty($marcas)):?>
								<?php foreach ($marcas as $m): ?>
									<?php if (!$m->es_otro): ?>
									<div class="form-group">
										<label for="precio-<?php echo $m->marca; ?>">
											<?php echo $m->marca; ?>
										</label>
										<input type="number" step="0.01" placeholder="Costo mas bajo"   class="form-control" value="<?php echo $m->precio_bajo; ?>" id="precio-bajo-<?php echo $m->idmarca; ?>" name="precio-bajo-<?php echo $m->idmarca; ?>">
										<input type="number" step="0.01" placeholder="Costo mas alto"  class="form-control" value="<?php echo $m->precio_alto; ?>" id="precio-alto-<?php echo $m->idmarca; ?>" name="precio-alto-<?php echo $m->idmarca; ?>">
									</div>
									<?php else: ?>
										<div class="form-group">
											<label for="precio-<?php echo $m->marca; ?>">
												<?php echo $m->marca; ?>
											</label>
											<input placeholder="Escriba la marca" type="text"  class="form-control" value="" id="nombre-otro-<?php echo $m->idmarca; ?>" name="nombre-otro-<?php echo $m->idmarca; ?>">
											<input type="number" step="0.01" placeholder="Costo mas bajo"   class="form-control" value="<?php echo $m->precio_bajo; ?>" id="precio-bajo-<?php echo $m->idmarca; ?>" name="precio-bajo-<?php echo $m->idmarca; ?>">
											<input type="number" step="0.01" placeholder="Costo mas alto"  class="form-control" value="<?php echo $m->precio_alto; ?>" id="precio-alto-<?php echo $m->idmarca; ?>" name="precio-alto-<?php echo $m->idmarca; ?>">
										</div>
									<?php endif;?>
								<?php endforeach; ?>
							<?php endif; ?>
							<div class="form-group">
								<input type="hidden" class="form-control" id="idformresp" name="idformresp" value="<?php echo $formulario_resp->idformresp; ?>" >
								<input type="hidden" class="form-control" id="codigo" name="codigo" value="<?php echo $i->codigo_item; ?>" >
								<input type="hidden" class="form-control" id="idflia_url" name="idflia_url" value="<?php echo $idflia_url;?>">
								<input type="hidden" class="form-control" id="idformulario_url" name="idformulario_url" value="<?php echo $idformulario_url; ?>">

							</div>
						</div>

						<!-- Modal footer -->
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary">
								Registrar
							</button>
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

