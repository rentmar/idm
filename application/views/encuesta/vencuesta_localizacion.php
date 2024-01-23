<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<div id="caja_boton">
					<div id="contenedor-submit">
						<a href="<?php echo site_url('encuesta/crearLocalizacion');?>">
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
						<th>Localizacion</th>
						<th>Latitud</th>
						<th>Longitud</th>
						<th>Accion</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($localizaciones as $l) {?>
						<tr>
							<td><?php echo $l->idgeolocal;?></td>
							<td><?php echo $l->nombre_geolocal;?></td>
							<td><?php echo $l->latitud_geolocal; ?></td>
							<td><?php echo $l->longitud_geolocal; ?></td>
							<td>
								<a href="<?php echo site_url('encuesta/editarLocalizacion/'.$l->idgeolocal);?>">
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

