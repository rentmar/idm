<main role="main">
	<br>
	<div class="container">
		<div class="row">

			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<table>
					<thead>
					<tr id="datos">
						<th>Nro</th>
						<th>Fecha</th>
						<th>Formulario</th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($formularios as $e) {?>
						<tr>
							<td><?php echo $e->idfvresp;?></td>
							<td><?php echo mdate('%m-%d-%Y', $e->fecha_registro); ?></td>
							<td><?php echo $e->nombre; ?></td>
							<td>

								<a href="<?php echo site_url('veeduria/editar/'.$e->idfvresp);?>" data-toggle="tooltip" title="Editar" >
									<i class="fas fa-edit"></i>
								</a>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>

		</div>
	</div>
	<br>
</main>

