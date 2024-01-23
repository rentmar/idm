<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title> ID&M Login </title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<style>
		body {
			background-color:#b7b7b7;
		}

		#Cabecera {
			background-color:#7f182b;
			padding:1px;
		}

		div #contenedor_vacío{
			background-color:#ffffff;
			color:#ffffff;
			width:100%;
			height:40px;
		}
		div #esquinas_redondeadas {
			max-width: 800px;
			margin-left:auto;
			margin-right:auto;
		}
		#Título_cabecera {
			color:#ffffff;
		}
		h3 {
			font-family: Verdana;
			line-height:140%;
			text-align:center;
		}
		#Título_central {
		}
		#Título_secundario {
			text-align:left;
		}
		p {
			text-align:center;
			font-family: Helvetica;
			line-height:120%;
		}
		#Caja_principal {
			background-color:#ffffff;
			padding-top:5px;
			padding-bottom:50px;
		}
		#Caja_secundaria {
			background-color:#ffffff;
			margin-top:1px;
			border-radius:5px;
			padding-top:5px;
			padding-right:40px;
			padding-bottom:20px;
			padding-left:20px;
		}
		input {
			padding:10px;
		}
		.form-group{
			font-family:Verdana;
			font-weight:Bold;
			font-size:12px;
		}
		#identidad {
			width:100%;
			background-color:#e6edf7;
		}
		#password {
			width: 100%;
			background-color:#e6edf7;
		}
		#INICIAR {
			background-color:#474142;
			color:#ffffff;
			font-family: Verdana;
			border-radius:10px;
		}
		.red {
			color:#ff0000;
		}




		#header{
			background:#000000;
			text-align:center;
			padding-bottom:10px;
			width:100%;

		}
		#barra{
			background-color:#343a40;
			padding:30px 15px 10px 15px;
			text-align:right;
		}
		.text-info h2{
			color: #ffffff;
			font-size:13pt;
		}
		#header img{
			max-width:280px;
			display: block;
			padding:20px 10px 0px 10px;
			margin-left: auto;
			margin-right: auto;
		}
		#Título_cabecera{
			font-family: Verdana;
			line-height:140%;
			color:#ffffff;
			font-size:14pt;
			text-align:center;
		}


	</style>
</head>
<body>
<div>


	<div>
		<div>
			<div id="header">
				<img src="<?php echo base_url('assets/img/logo/logo-removebg.png')?>  " alt="Logo CD">
				<h4 id="Título_cabecera">  </h4>
			</div>
		<div>
	</div>


	<!--<div id="contenedor_vacío">	</div>
	<div>-->
		<br>
		<div id="esquinas_redondeadas">
			
			<div id="Caja_principal">
				<h3 id="Título_central"> Investigacion Desarrollo & Multimedia </h3>
			</div>

			<!-- Mensaje de error -->
			<?php if(!empty($this->session->flashdata())): ?>
			<div id="Caja_secundaria" class="contenedor">
				<div id="mensaje-loggin" class="bg-warning">
					<div class="alert alert-warning">
						<?php echo $this->session->flashdata('log_mensaje') ?>
					</div>
				</div>
			</div>
			<?php endif; ?>


			<div id="Caja_secundaria" class="contenedor">
				<h3 id="Título_secundario"> Inicio de sesión </h3>

				<?php echo form_open('login/validar'); ?>
				<label for="identidad" class="form-group"> Nombre de usuario </label>
				<span class="red"> * </span>
				<br>
				<input type="text" id="identidad" name="identidad" class="form-control" required>
				<br><br>
				<label for="password" class="form-group"> Contraseña </label>
				<span class="red"> * </span>
				<br>
				<input type="password" id="password" name="password" class="form-control" required>
				<br><br>
				<input type="submit" id="INICIAR" value="INICIAR SESIÓN">
				<?php echo form_close(); ?>
			</div>
		</div>

		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

	</div></div></div></div>
	<br><br><br>



</body>
</html>
