<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<div id="caja_boton">
					<div id="contenedor-submit">
						<a href="<?php echo site_url('encuesta/crearModulo');?>">
							<input type="submit" class="BOTON" value="CREAR">
						</a>
						<a href="<?php echo site_url('/');?>">
							<input type="submit" class="BOTONROJO" value="CANCELAR">
						</a>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<table>
					<thead>
					<tr id="datos">
						<th>Nro</th>
						<th>Modulo</th>
						<th>Orden</th>
						<th>Encuesta</th>
						<th>Accion</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($modulos as $e) {?>
						<tr>
							<td><?php echo $e->iduimodulo;?></td>
							<td><?php echo $e->uinombre_modulo;?></td>
							<td><?php echo $e->uiorden_modulo; ?></td>
							<td><?php echo $e->uinombre_encuesta; ?></td>
							<td>
								<a href="<?php echo site_url('encuesta/editarModulo/'.$e->iduimodulo);?>">
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

