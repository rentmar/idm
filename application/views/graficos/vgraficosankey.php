<!DOCTYPE html>
	<html lang="es">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta http-equiv="X-UA-Compatible" content="ie=edge">
			
			<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
			<script>var baseurl = "<?php echo site_url(); ?>";</script>
			<script type="text/javascript" src="<?php echo base_url().'assets/d3/d3.js';?>"></script>
			<script type="text/javascript" src="<?php echo base_url().'assets/d3/tsiyur.js';?>"></script>
			<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/d3/gestilo.css';?>">
			<title> Grafico Sankey</title>
			
		</head>
		<body>
			<header>
				<nav class="navbar navbar-inverse navbar-fixed-top">
					<div class="container-fluid">
						<div class="navbar-header">
						  <a class="navbar-brand" href="#">OCD</a>
						</div>
						<div class="visible-xs">
							<a href="">	<span id="label" class="text-info">Analisis Graficos <b></b></span></a>
						</div>
					</div>
				</nav>
			</header>
			<br>
			<main>
				<nav class="menu">
					<ul>
						<li><a href="<?php echo site_url('Graficos'); ?>">Volver</a></li>
					</ul>
				</nav>
				<br>
				<div class="contenedor_graficas">
					<div class="contenedor_superior" id="bublemap">
						<h5><b> <?php echo "Grafico ".$encuesta->uinombre_encuesta;?> </b></h5>
					</div>
					<div class="grafico">

						<div class="row">
							<div class="col-sm-4">
								<select class="form-control" id="iduipreguntasank" name="iduipreguntasank"  required >
									<option value="0" selected disabled>Seleccione Pregunta</option>
									<?php foreach ($preguntas as $e): ?>
										<option value="<?php echo $e->iduipregunta;?>" data-idencuesta="<?php echo $e->iduiencuesta;?>" >
											<?php echo $e->uipregunta_nombre;?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>
							<div>
								<a class="btn btn-danger" href="<?php echo site_url('Graficos/seleccionSankey'); ?>">Atras</a>
							</div>
						</div>

<!--						<div>
							<button id="encuesta" name="encuesta" onclick="renderSankeyChart()" type="button" class="btn btn-secondary">Ver</button>
							<a class="btn btn-danger" href="<?php //echo site_url('Graficos/seleccionSankey'); ?>">Atras</a>
						</div>-->
						<br>
						<div id="contenedor-chart">
							<!-- aqui el chart -->
						</div>
						<br>
					</div>
					<br>
				</div>

			</main>

		</body>
</html>