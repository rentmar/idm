<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
	<meta name="generator" content="Hugo 0.80.0">
	<title>OCD</title>
	<link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/offcanvas/">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/select2.min.css');?>" >
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<!--	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">-->
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css">

	<style>
		.bd-placeholder-img {
			font-size: 1.125rem;
			text-anchor: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}

		@media (min-width: 768px) {
			.bd-placeholder-img-lg {
				font-size: 3.5rem;
			}
		}
		#table{
			overflow-x:auto;
		}
		table {
			border-collapse: separate;
			width: 100%;
		}
		#datos {
			background-color:#702082;
			color: white;
		}
		th, td {
			text-align: left;
			padding: 10px;
			border-radius:4px;
		}
		tr:nth-child(odd) {
			background-color: #f1f1f1;
		}
		tr:nth-child(even) {
			background-color: #ffffff;
		}
		#caja_boton{
			display:flex;
			justify-content:left;
			margin-top:10px;
		}

		#header {
					background:#662d91;
					padding:1px;
					width:100%;
				}
				
				div #contenedor_vacío{
					background-color:#7f182b;
					color:#ffffff;
					max-width:100%;
					height:40px;
					margin:0;
				}
				
				div #Caja_de_orden {
					padding-top:5px;
					padding-bottom:50px;
				}
				
				div .Caja_de_datos {
					background-color:#ffffff;
					margin-top:1px;
					max-width:750px;
					margin-left:auto;
					margin-right:auto;
					padding-right:40px; 
					padding-left:20px;
				}
				div #Caja_de_datos{	
					border-radius:5px;
					margin-top:1px;
					padding-top:40px;
					padding-bottom:20px;
				}
				
				#Título_cabecera {
					color:#ffffff;
				}
				input {
					padding:10px;
				}
				.form-group{
					font-family: Verdana;
					font-weight: Bold;
					font-size:12px;
				}
				#cuadro {
					width:100%;
					background-color:#e6edf7;
				}
				#BOTON {
					background-color:#474142;
					color:#ffffff;
					font-family: Verdana;
					border-radius:10px;
				}
				.rojo {
					color:#ff0000;
				}
				
				.contenedor_filtros {
					background-color:#7f182b;
					color:white;
					max-width:740px;
					margin-left:auto;
					margin-right:auto;
					height:30px;
					border-top-left-radius:10px;
					border-top-right-radius:10px;
				}
				.contenedor{
					background-color:#ffffff;
					max-width:740px;
					margin-left:auto;
					margin-right:auto;
					padding:20px 30px 20px 30px;
					border-bottom-left-radius:10px;
					border-bottom-right-radius:10px;
				}
				select {
					padding:6px 2px;
					border-radius:6px;
					background-color:#d3d3d3;
				}
				input[type=date] {
					border-top:1px #cccccc;
					border-left:none;
					border-right:none;
					font-family: Verdana;	
					font-size:12pt;
					color:#595959;
				}
				#send{
					background-color:#0066ff;
					color:#ffffff;
					font-family: Verdana;
					border-radius:10px;
					border-color:#005ce2;
					padding:10px 30px 10px 30px;
				}
				#contenedor-submit {
					max-width:740px;
					margin-left:auto;
					margin-right:auto;
				}
	</style>


	<!-- Custom styles for this template -->
	<link href="<?php echo base_url('assets/css/offcanvas.css');?>" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/interfaz.css');?>">
</head>
<body class="bg-light" >
