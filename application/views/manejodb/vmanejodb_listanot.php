<main role="main">
<br><br>
<div class="container">
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores" >
			<h3 class="text-center" >
				Noticias Registradas
			</h3>
		</div>

		<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores ">
			<div>
			<table id="noticias-tabla" class="table table-striped table-hoover">
				<thead>
				<tr id="datos">
					<th>No</th>
					<th>Fecha de la noticia</th>
					<th>Titular</th>
					<th>Formulario</th>
					<th>Usuario</th>
					<th>Estado</th>
					<th>Accion</th>
				</tr>
				</thead>
				<tbody>
				<?php if(isset($noticias)): ?>
					<?php foreach ($noticias as $n): ?>
						<tr>
							<td><?php echo $n->idnoticia; ?></td>
							<td><?php echo mdate('%m-%d-%Y', $n->fecha_noticia); ?></td>
							<td><?php echo $n->titular; ?></td>
							<?php
								if($n->idcuestionario == 1)
								{
									$clase = 'cuest1';
								}elseif ($n->idcuestionario == 2){
									$clase = 'cuest2';
								}
								elseif ($n->idcuestionario == 3){
									$clase = 'cuest3';
								}
							?>
							<td class="<?php echo $clase; ?> text-white "><?php echo $n->nombre_cuestionario; ?></td>
							<td><?php echo $n->username; ?></td>

							<?php if($n->esta_activa): ?>
							<td class="table-info" >Activa</td>
							<?php else: ?>
							<td class="table-danger" >Inactiva</td>
							<?php endif; ?>

							<td>
							<?php
								if($n->idcuestionario == 1)
								{
									$urledit = 'reformaelectoral/editarNoticia/'.$n->idnoticia;
								}elseif ($n->idcuestionario == 2){
									$urledit = 'instdemocratica/editarNoticia/'.$n->idnoticia;
								}
								elseif ($n->idcuestionario == 3){
									$urledit = 'censo/editarNoticia/'.$n->idnoticia;
								}

							?>
								<a href="<?php echo site_url($urledit); ?>" data-toggle="tooltip" title="Editar Noticia" >
									<i class="fas fa-edit"></i>
								</a>

								<?php if($n->esta_activa): ?>
									<a href="<?php echo site_url('manejoDB/cambiarEstado/'.$n->idnoticia);?>" data-toggle="tooltip" title="Activa/Desactiva">
										<i class="fas fa-toggle-on"></i>
									</a>
								<?php else: ?>
									<a href="<?php echo site_url('manejoDB/cambiarEstado/'.$n->idnoticia);?>" data-toggle="tooltip" title="Activa/Desactiva" >
										<i class="fas fa-toggle-off"></i>
									</a>
								<?php endif; ?>

								<?php if($hay_cambio_pendiente): ?>
									<a href="<?php echo site_url('manejoDB/cambiarFormulario/');?>" data-toggle="tooltip" title="Cambio de Formulario Pendiente" >
										<i class="fas fa-long-arrow-alt-left"></i>
									</a>
								<?php else: ?>
									<a href="<?php echo site_url('manejoDB/iniciarCambioFormulario/'.$n->idnoticia);?>" data-toggle="tooltip" title="Cambio de Formulario" >
										<i class="fas fa-exchange-alt"></i>
									</a>
								<?php endif; ?>


							</td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
				</tbody>
			</table>
			</div>

		</div>




	</div>
</div>
	<br>
</main>

