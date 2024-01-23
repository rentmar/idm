<main role="main">
	<br><br>
	<div class="container"  >
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" >
				<br>
				<div class="card">
					<div class="card-header bg-primary">
						<h4>REGISTRO</h4>
					</div>
					<div class="card-body">
						<ul class="list-group">
							<li class="list-group-item">Libro:<?php echo ' '.$registro->libro;?></li>
							<li class="list-group-item">Folio:<?php echo ' '.$registro->folio;?></li>
							<li class="list-group-item">Partida:<?php echo ' '.$registro->partida;?></li>
							<li class="list-group-item">Nombres:<?php echo ' '.$registro->nombres;?></li>
							<li class="list-group-item">Primer apellido:<?php echo ' '.$registro->primer_apellido;?></li>
							<li class="list-group-item">Segundo apellido:<?php echo ' '.$registro->segundo_apellido;?></li>
							<li class="list-group-item">Apellido esposo:<?php echo ' '.$registro->apellido_esposo;?></li>
							<li class="list-group-item">No Documento:<?php echo ' '.$registro->numero_documento;?></li>
							<li class="list-group-item">Complemento:<?php echo ' '.$registro->complemento;?></li>
							<li class="list-group-item">Fecha de Nacimiento:<?php echo ' '.$registro->fecha_nacimiento;?></li>
							<li class="list-group-item">Sexo:<?php echo ' '.$registro->sexo;?></li>
							<li class="list-group-item">Lugar Domicilio/Residencia:<?php echo ' '.$registro->lugar_domicilio;?></li>
							<li class="list-group-item">Zona/Barrio:<?php echo ' '.$registro->zona;?></li>
							<li class="list-group-item">Avenida/Calle:<?php echo ' '.$registro->calle;?></li>
							<li class="list-group-item">Numero:<?php echo ' '.$registro->numero ;?></li>
							<li class="list-group-item">Departamento:<?php echo ' '.$dep->nombre_departamento;?></li>
							<li class="list-group-item">Provincia:<?php echo ' '.$registro->provincia;?></li>
							<li class="list-group-item">Localidad:<?php echo ' '.$registro->localidad;?></li>
							<li class="list-group-item">Otra Localidad:<?php echo ' '.$registro->otra_localidad;?></li>
							<li class="list-group-item">Lugar de Adhesion:<?php echo ' '.$dep_adh->nombre_departamento;?></li>
							<li class="list-group-item">Fecha de Adhesion:<?php echo ' '.$registro->fecha_adhesion;?></li>

						</ul>
					</div>


					<div class="card-footer">
						<a href="<?php echo site_url('inicio')?>" class="btn btn-info" role="button">Finalizar</a>
					</div>

				</div>
			</div>
		</div>
	</div>
</main>

