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
			<script type="text/javascript" src="<?php echo base_url().'assets/d3/d3.js';?>"></script>
			<script type="text/javascript" src="<?php echo base_url().'assets/d3/tsiyur.js';?>"></script>
			<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/d3/gestilo.css';?>">
			<title> Grafico BubleMap Bolivia </title>
			
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
				<?php echo form_open('Graficos/llenarDatosBubbleXml');?>
				<div class="contenedor_graficas">
					<div class="contenedor_superior" id="bublemap">
						<h5><b> <?php echo "Grafico de ".$titulo;?> </b></h5>
					</div>
					<div class="grafico">
						<div>
							<?php if($accion==1) { ?>
							<?php $direccion="opcionBubbleCuest('".base_url()."datos/cuestionariobubble.xml','".base_url()."datos/mBb.svg')";?>
							<select onchange="<?php echo $direccion;?>" id="idcuest" name="idcuest"  required >
								<option value="" selected >Seleccione Ambito</option>
								<?php foreach ($cuestionarios as $c): ?>
								<option value="<?php echo $c->idcuestionario;?>" >
									<?php echo $c->nombre_cuestionario;?>
								</option>
								<?php endforeach; ?>
							</select>
							<?php } ?>
							<?php if($accion==2) { ?>
								<?php $direccion="opcionBubbleTemas('".base_url()."datos/temabubble.xml','".base_url()."datos/mBb.svg')";?>
								<select onchange="<?php echo $direccion;?>" id="idcuesttema" name="idcuesttema"  required >
									<option value="" selected >Seleccione Ambito</option>
									<?php foreach ($cuestionarios as $c): ?>
									<option value="<?php echo $c->idcuestionario;?>" >
										<?php echo $c->nombre_cuestionario;?>
									</option>
									<?php endforeach; ?>
								</select>
							<?php } ?>
							<?php if($accion==3) { ?>
								<?php $direccion="opcionBubbleActor('".base_url()."datos/actorbubble.xml','".base_url()."datos/mBb.svg')";?>
								<select onchange="<?php echo $direccion;?>" id="idcuestactor" name="idcuestactor"  required >
									<option value="" selected >Seleccione Actor</option>
									<?php foreach ($actores as $a): ?>
									<option value="<?php echo $a->idactor;?>" >
										<?php echo $a->nombre_actor;?>
									</option>
									<?php endforeach; ?>
								</select>
							<?php } ?>
							<a class="btn btn-danger" href="<?php echo site_url('Graficos/seleccionBubble'); ?>">Atras</a>
							<br>
							<h4><?php echo $fi.' al '.$ff;?></h4>
						</div>
						<br>
						<div id="contenedor-chart">
							<!-- aqui el chart -->
						</div>
						<br>
					</div>
					<br>
				</div>
				<?php echo form_close();?>
		</body>
</html>