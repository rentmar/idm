<!DOCTYPE html>
	<html lang="es">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta http-equiv="X-UA-Compatible" content="ie=edge">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
			<title> Formularios </title>
			<style>
				body {
					background-color:#d3d3d3;
					margin:0;
				}
				header {
					background-color:#343a40;
					position:fixed;
					width:100%;
					padding:0;
				}
				.navbar-brand {
					color:#ffffff;
				}
				.contenedor_superior{
					background-color:#66cc00;
					border-top-left-radius:10px;
					border-top-right-radius: 10px;
					padding:20px 30px 10px 30px;
				}
				#header{
					background:#662d91;
					text-align:center;
					padding-bottom:10px;
					width:100%;
				}
				#header img{
					max-width:280px;
					display: block;
					padding:20px 10px 0px 10px;
					margin:10px auto;
				}	
				h5 {
					font-family: Verdana;
					color:#ffffff;
					line-height:140%;
					text-align:center;
				}
				#Título_cabecera{
					font-family: Verdana;
					line-height:140%;
					color:#ffffff;
					font-size:14pt;
					text-align:center;
				}
				.menu {
					width:100%;
					background-color:#7f182b;
					}
				.menu ul {
					margin:0;
					list-style:none;
					padding:0;
					display:flex;
				}

				.menu li :hover{
					background:rgba(0,0,0,0.2);
				}
				.menu li a {
					display:block;
					padding: 15px 20px;
					color: #ffffff;
					text-decoration:none;
				}				
				main {	
					padding:0;
					width:100%;
					margin-top:30px;
				}
				.contenedores_divididos {
					max-width:570px;
					margin-left:auto;
					margin-right:auto;
				}
				.contenedor_inferior{
					background-color:#ffffff;
					padding:20px 30px 25px 30px;
					border-bottom-left-radius:10px;
					border-bottom-right-radius: 10px;
					display:flex;
					justify-content:center;
				}
				.contenedor_inferior img{
					width:200px;
					padding-right:30px;
					display:flex;
				}
				.text{
					font-size:13pt;
				}
			</style>
		</head>
		<body>
			<header>
				<nav class="navbar navbar-inverse navbar-fixed-top">
					<div class="container-fluid">
						<div class="navbar-header">
						  <a class="navbar-brand" href="#">OCD</a>
						</div>
						<div class="visible-xs">

						</div>
					</div>
				</nav>
			</header>
			<br>
			<main>
				<div id="header">
					<img src="<?php echo base_url('assets/img/logo/logo-sin-fondo.png'); ?>" alt="Logo CD">
					<h4 id="Título_cabecera"> <b>Encuesta Completada</b> </h4>
				</div>
				<nav class="menu">
					<ul>
						<li><a href="<?php echo site_url('inicio');?>">
								Regresar al Inicio
							</a>
						</li>
					</ul>
				</nav>
				<br>
				<div class="contenedores_divididos">
					<div class="contenedor_superior" id="contenedor_pequeño">
						<h5 id="Título_mensaje"> <b> Envío con éxito</b> </h5>
					</div>
					<div class="contenedor_inferior">
						<img src="<?php echo base_url('/assets/img/de_confirmacion.svg') ?>" alt="">
						<div class="text">
							<p>Los datos han sido enviados con éxito. </p>
							<br>
							<br>
							<a href=""></a>
						</div>
					</div>
				</div>
			</main>
		</body>
	</html>
