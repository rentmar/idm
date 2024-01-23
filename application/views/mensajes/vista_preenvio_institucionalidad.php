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
			
			<title> Institucionalidad democrática </title>
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
				main{
					padding:0;
					width:100%;
					margin-top:30px;
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
				.contenedores_divididos {
					max-width:900px;
					margin-left:auto;
					margin-right:auto;
				}
				.contenedor_superior{
					background-color:#ef9600;
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
					text-align:left;
				}
				#table{
					background-color:#ffffff;
					overflow-x:auto;
					padding:10px;
				}
				table, th, td{
					border: 1px solid #e2e2e2;
					border-collapse: collapse;
					width: 100%;
				}

				#datos {
					background-color:#ffffff;
				}
				td {
					text-align: left;
					padding: 10px 15px;
					border-radius:4px;
				}
				#caja_boton{
					background-color:#ffffff;
					display:flex;
					padding:10px;
					justify-content:left;
					margin-top:1px;
					border-bottom-left-radius:10px;
					border-bottom-right-radius: 10px;
					border:#e2e2e2;
				}
				.BOTON{
					color:#ffffff;
					font-family: Verdana;
					width:150px;
					border-radius:10px;
					border: none;
					padding:10px 20px;
					margin-right:10px;
				}

				#send{
					background-color:#0066ff;
				}
				#cancel{
					background-color:#cc3333;					
				}
				@media (max-width:750px) {
					#caja_boton{
						width:100%;
						padding:0px 10px;
						display: flex;
						flex-direction: column;
						
					}	
					.BOTON{
						margin-top:5px;
						margin-bottom:5px;
						width:200px;
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
								<td><b>Fecha de registro:</b> 09/07/2021</td>
							</tr>
							<tr id="datos">
								<td><b>Fecha:</b> 09/07/2021</td>
							<tr id="datos">
								<td><b>Titular:</b>  </td>
							</tr>
							<tr id="datos">
								<td><b>Resumen:</b>  </td>
							</tr>
							<tr id="datos">
								<td><b>URL:</b>  </td>
							</tr>
							<tr id="datos">
								<td><b>Medio:</b>  </td>
							</tr>
							<tr id="datos">
								<td><b>Actor:</b>  </td>
							</tr>
							<tr id="datos">
								<td><b>Tema:</b>  </td>
							</tr>	
							<tr id="datos">
								<td><b>Subtema:</b>  </td>
							</tr>	
						</table>
					</div>
					<div id="caja_boton">
						<div id="contenedor-submit">
							<a href=""><input type="submit" id="send" class="BOTON" value="ENVIAR"></a>
						</div>
						<div id="contenedor-submit">
							<a href=""><input type="submit" id="cancel" class="BOTON" value="CANCELAR"></a>
						</div>
					</div>
				</div>
			</main>
		</body>
	</html>