

<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
	<a class="navbar-brand mr-auto mr-lg-0" href="<?php echo site_url('/');?>">
		OCD
	</a>
	<button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div id="barra" class="navbar-collapse offcanvas-collapse" >
		<ul class="navbar-nav mr-auto">
			<!--<li class="nav-item active">
				<a class="nav-link" href="#">Dashboard <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Notifications</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Profile</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Switch account</a>
			</li>-->


<!--			<li class="nav-item dropdown">-->
<!--				<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--					Usuarios-->
<!--				</a>-->
<!--				<div class="dropdown-menu" aria-labelledby="dropdown01">-->
<!--					<a class="dropdown-item" href="--><?php //echo site_url('usuarios/listar/1');?><!--">Administradores</a>-->
<!--					<a class="dropdown-item" href="--><?php //echo site_url('usuarios/listar/2');?><!--">Docentes</a>-->
<!--					<a class="dropdown-item" href="--><?php //echo site_url('usuarios/listar/3');?><!--">Monitores</a>-->
<!--				</div>-->
<!--			</li>-->


			<!--<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Datos Formulario
				</a>
				<div class="dropdown-menu" aria-labelledby="dropdown02">
					<a class="dropdown-item" href="<?php /*echo site_url('formulario/');*/?>">Formularios</a>
					<a class="dropdown-item" href="<?php /*echo site_url('actor/');*/?>">Actores</a>
					<a class="dropdown-item" href="<?php /*echo site_url('departamento/');*/?>">Departamentos</a>
					<a class="dropdown-item" href="<?php /*echo site_url('universidad/');*/?>">Universidades</a>
					<a class="dropdown-item" href="<?php /*echo site_url('tipoMedio/');*/?>">Tipo de Medio</a>
					<a class="dropdown-item" href="<?php /*echo site_url('medioComunicacion/');*/?>">Medio de Comunicacion</a>
					<a class="dropdown-item" href="<?php /*echo site_url('tema/');*/?>">Tema</a>
					<a class="dropdown-item" href="<?php /*echo site_url('subTema/');*/?>">Subtema</a>
				</div>
			</li>-->


		</ul>


		<ul class="navbar-nav ml-auto">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<?php echo "Menu"; ?>
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown02">
					<a class="dropdown-item" href="<?php echo site_url('login/logout');?>">
						Salir
					</a>
				</div>
			</li>
		</ul>
	</div>
</nav>

<div >
	<div id="header">
		<img src="<?php echo base_url('assets/img/logo/logo-sin-fondo.png');?>" alt="Logo CD">
		<h4 id="Título_cabecera"> Monitor de Medios </h4>
	</div>
</div>
<div class="nav-scroller ">
	<nav class="nav nav-underline">
		<a class="nav-link " href="<?php echo site_url('inicio')?>">Inicio</a>
		<a class="nav-link " href="<?php echo site_url('repositorio/')?>">Nueva Busqueda</a>



	</nav>
</div>
