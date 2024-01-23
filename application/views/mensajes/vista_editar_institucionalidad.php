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
					background-color:#f7941d;
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
					max-width:900px;
					margin-left:auto;
					margin-right:auto;
				}
				#table{
					background-color:#ffffff;
					overflow-x:auto;
					padding:10px 15px 20px 15px;
					border-bottom-left-radius:10px;
					border-bottom-right-radius: 10px;
				}
				#datos {
					background-color: #f1f1f1;
				}
				table {
					width: 100%;
				}
				table th td{
					border-collapse: collapse;
					border: 1px solid #e2e2e2;
				}

				th {
					text-align: left;
					padding: 10px;
					border: 1px solid #e2e2e2;
				}
				td {
					text-align: left;
					padding: 10px;
					background-color:#ffffff;
					border: 1px solid #e2e2e2;
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
							<a href="">	<span id="label" class="text-info">Bienvenido, <b>Alejandro</b></span></a>
						</div>
					</div>
				</nav>
			</header>
			<br>
			<main>
				<div id="header">
					<img src="/img/OCD-bolivia-2.svg" alt="Logo CD">
					<h4 id="Título_cabecera"> <b>Monitor de Medios</b> </h4>
				</div>
				<nav class="menu">
					<ul>
						<li><a href="">Inicio</a></li>
					</ul>
				</nav>
				<br>
				<div class="contenedores_divididos">
					<div class="contenedor_superior" id="contenedor_pequeño">
						<h5 id="Título_formulario"> <b>Institucionalidad democrática</b> </h5>
					</div>
					<div id="table">
						<table>
							<tr id="datos">
								<th>Fecha de registro</th>
								<th>Fecha de la noticia</th>
								<th>Titular</th>
								<th>Medio</th>
								<th>Acción</th>
							</tr>
							<tr>
								<td>07/07/2021</td>
								<td>07/21/2021</td>
								<td>Covid 19 El Alto</td>
								<td>ATB</td>
								<td><a href="">Editar</a></td>
							</tr>
							<tr>
								<td>07/07/2021</td>
								<td>07/21/2021</td>
								<td>Covid 19 El Alto</td>
								<td>ATB</td>
								<td><a href="">Editar</a></td>
							</tr>
						</table>
					</div>
				</div>
			</main>
		</body>
	</html>