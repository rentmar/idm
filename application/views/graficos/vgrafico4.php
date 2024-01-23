!DOCTYPE html>
	<html lang="es">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta http-equiv="X-UA-Compatible" content="ie=edge">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
			<title> OCD Graficos </title>
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
				.contenedor_gráficas {
					max-width:900px;
					margin-left:auto;
					margin-right:auto;
				}
				.contenedor_superior{
					border-top-left-radius:10px;
					border-top-right-radius: 10px;
					padding:20px 25px 15px 25px;
				}
				#reforma {
					background-color:#8cc63f;
				}
				#institucional {
					background-color:#ef9600;
				}				
				.gráfico{
					background-color:#ffffff;
					padding:20px 30px 25px 30px;
					border-bottom-left-radius:10px;
					border-bottom-right-radius: 10px;
				}
				.gráfico img{
					width:700px;
				}
				#table{
					overflow-x:auto;

				}
				h5 {
					color:#ffffff;
					font-family:Helvetica;
				}
				p {
					text-align:left;
				}
				@media (max-width:768px) {
					.contenedor_gráficas{
						column-count:1;
					}
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
							<a href="">	<span id="label" class="text-info">Analisis Graficos <b></b></span></a>
						</div>
					</div>
				</nav>
			</header>
			<br>
			<main>
				<nav class="menu">
					<ul>
						<li><a href="<?php echo site_url('graficos'); ?>">Volver</a></li>
					</ul>
				</nav>
				<br>
				<div class="contenedor_gráficas">
					<div class="contenedor_superior" id="institucional">
						<h5><b> Grafico Hexagon Map </b></h5>
					</div>
					<div class="gráfico">
						<div>
							<a href="<?php //echo site_url('formulario3/');?>" class="btn btn-info" role="button" style="background-color:#474142;">Opcion</a>
							<a href="<?php //echo site_url('formulario3/');?>" class="btn btn-info" role="button" style="background-color:#474142;">Opcion</a>
							<a href="<?php //echo site_url('formulario3/');?>" class="btn btn-info" role="button" style="background-color:#474142;">Opcion</a>
						</div>
						<div id="table">
							<img src="<?php echo base_url().'assets/img/hexamap.png'; ?>">
						</div>
						<br>
						<h6> Descripción de gráfica </h6>
						<p> Lorem ipsum dolor sit amet consectetur adipiscing elit scelerisque, aptent sapien a vivamus consequat fames.</p>
					</div>
					<br>
				</div>
			</main>
		</body>
	</html>
