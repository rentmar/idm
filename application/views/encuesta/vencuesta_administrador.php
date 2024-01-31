<main role="main">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores" >
				<p><h3 class="text-center" >Administrar Encuesta</h3></p>
				<p class="text-right">
					<a href="<?php echo site_url('inicio'); ?>" class="BOTONROJO" >Finalizar</a>
				</p>
			</div>

			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores table-responsive">
				<table id="formresp-tabla" class="table">
					<thead class="thead-dark">
					<tr id="datos">
						<th>Id</th>
						<th>Usr</th>
						<th>Cudad</th>
						<th>Zona</th>
						<th>Lugar</th>
						<th>Nombre Lugar</th>
						<th>Fecha</th>
						<th>Estado</th>
						<th>A/D</th>
						<th>Accion</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($encuesta_datos_generales as $e) {?>
						<tr>
							<td><?php echo $e->idformresp;?></td>
							<td><?php echo $e->username; ?></td>
							<td><?php echo $e->nombre_ciudad; ?></td>
							<td><?php echo $e->nombre_zona; ?></td>
							<td><?php echo $e->nombre_lugar; ?></td>
							<td><?php echo $e->nombre_del_lugar; ?></td>
							<td><?php echo $e->fecha_fc;?></td>

							<?php if($e->esta_abierto): ?>
								<td class="text-success">
									<p>Abierto</p>
								</td>
							<?php else: ?>
								<td class="text-danger">
									<p>Cerrado</p>
								</td>
							<?php endif; ?>

							<?php if($e->es_valido): ?>
								<td class="text-success">
									<p>Activado</p>
								</td>
							<?php else: ?>
								<td class="text-danger">
									<p>Desactivado</p>
								</td>
							<?php endif; ?>

							<td>
							<?php if($e->esta_abierto): ?>
								<a href="<?php echo site_url('encuesta/cambiarEstadoRegistro/'.$e->idformresp.'/'.$e->rel_iduiformulario); ?>" class="btn btn-outline-danger" role="button" data-toggle="tooltip" title="Abrir/Cerrar formulario" >
									Cerrar
								</a>
							<?php else:?>
								<a href="<?php echo site_url('encuesta/cambiarEstadoRegistro/'.$e->idformresp.'/'.$e->rel_iduiformulario); ?>" class="btn btn-outline-primary" role="button" data-toggle="tooltip" title="Abrir/Cerrar formulario" >
									Abrir
								</a>
							<?php endif; ?>
								<br>

							<?php if($e->es_valido): ?>
								<a href="<?php echo site_url('encuesta/habilitar/'.$e->idformresp.'/'.$e->rel_iduiformulario);?>" data-toggle="tooltip" title="Activa/Desactiva formulario">
									<i class="fas fa-toggle-on"></i>
								</a>
							<?php else: ?>
								<a href="<?php echo site_url('encuesta/habilitar/'.$e->idformresp.'/'.$e->rel_iduiformulario);?>" data-toggle="tooltip" title="Activa/Desactiva formulario" >
									<i class="fas fa-toggle-off"></i>
								</a>
							<?php endif; ?>




							</td>





						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>


		</div>
	</div>
</main>
