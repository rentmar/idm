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
		<h1 class="text-center"><?php  echo $formulario_resp->form_nombre; ?></h1>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h2><?php echo $familia->nombre_familia; ?></h2>
		</div>
	</div>
</div>
<div class="container">
	<div class="row row-cols-1 row-cols-md-3">
		<?php foreach ($items as $i): ?>
			<div class="col mb-4">
				<div class="card h-100">
					<!--Card image-->
					<div class="view overlay">
						<img class="card-img-top" src="<?php echo base_url($i->imagen); ?>" alt="Imagen-item">
						<a href="#!">
							<div class="mask rgba-white-slight"></div>
						</a>
					</div>

					<!--Card content-->
					<div class="card-body">

						<!--Title-->
						<h4 class="card-title"><?php echo $i->nombre_item; ?></h4>
						<!--Text-->
						<p class="card-text">
							<?php ?>
						</p>
						<!-- Provides extra visual weight and identifies the primary action in a set of buttons -->

						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#item<?php echo $i->iditem;?>">
							Registrar
						</button>
					</div>

				</div>
				<!-- Card -->
			</div>
		<?php endforeach; ?>
	</div>
	<div class="form-group">
		<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#salirencuesta">
			Salir
		</button>
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
				<?php echo form_open('formulario/formulariocmp/'.$formulario_resp->idformresp);?>

				Desa salir?
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


<!-- Modal para el registro de items-->
<?php foreach ($items as $i): ?>
<div class="modal" id="item<?php echo $i->iditem;?>">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title"><?php echo $i->nombre_item; ?></h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				Modal body..
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>

		</div>
	</div>
</div>
<?php endforeach; ?>




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

