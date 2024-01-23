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
			<title> Grafico Cuerdas </title>
			
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
					<div class="contenedores">

					<div class="grafico">
						<div class=" text-dark" id="">
							<h4> <?php echo "Grafico de ".$titulo;?> </h4>
						</div>
						<form class="" >
							<label for="fecha_inicio">Fecha Inicio:</label>
							<input type="date" id="fecha_inicio" name="fecha_inicio"  class="form-control" required >
							<label for="fecha_fin">Fecha Fin:</label>
							<input type="date" id="fecha_fin" name="fecha_fin"  class="form-control" required >
							<label for="idactor">Actor</label>
							<select id="idactor" name="idactor" class="form-control d-inline-block" required >
								<option value="" selected >Seleccione Actor</option>
								<?php foreach ($actores as $a): ?>
								<option value="<?php echo $a->idactor ?>" >
									<?php echo $a->nombre_actor;?>
								</option>
								<?php endforeach; ?>
							</select>
							<?php $direccion="dibujar()";//"renderCuerdas('".base_url()."datos/cuerdas.xml')";?>
						
							<button id="graficar" class="btn btn-info" style="background-color:#474142;">Graficar</button>
								
							<!--<button id="graficar" type="submit" class="btn btn-primary" style="background-color:#474142;" >Graficar</button>-->
							<a class="btn btn-danger" href="<?php echo site_url('Graficos/seleccionCuerdas'); ?>">Atras</a>
						</form>
						<div>
							
<!--								--><?php //$direccion="renderCuerdas('".base_url()."datos/cuerdas.xml')";?>
<!--								<button onclick="--><?php //echo $direccion;?><!--" class="btn btn-info" style="background-color:#474142;">Graficar</button>-->
														
<!--							<a class="btn btn-danger" href="--><?php //echo site_url('Graficos/seleccionCuerdas'); ?><!--">Atras</a>-->
						</div>
						<br>
						<div id="contenedor-chart">
							<!-- aqui el chart -->
						</div>
						<br>
					</div>
					</div>
					<br>
				</div>

			</main>



			<!-- The Modal de alerta ACTOR SIN SELECCIONAR -->
			<div class="modal fade" id="actorsinseleccionar">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">

						<!-- Modal Header -->
						<div class="modal-header bg-warning">
							<h4 class="modal-title text-white ">Alerta</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

						<!-- Modal body -->
						<div class="modal-body">
							Seleccionar un Actor
						</div>

						<!-- Modal footer -->
						<div class="modal-footer">
							<button id="BOTON" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						</div>

					</div>
				</div>
			</div>

			<!-- The Modal de alerta ACTOR SIN SELECCIONAR -->
			<div class="modal fade" id="fechaintervalo">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">

						<!-- Modal Header -->
						<div class="modal-header bg-warning">
							<h4 class="modal-title text-white ">Alerta</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

						<!-- Modal body -->
						<div class="modal-body">
							Intervalo de fechas incorrecto
						</div>

						<!-- Modal footer -->
						<div class="modal-footer">
							<button id="BOTON" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						</div>

					</div>
				</div>
			</div>



		</body>
</html>
