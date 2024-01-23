<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<div id="caja_boton">
					<div id="contenedor-submit">
						<a href="<?php echo site_url('encuesta/crearSeccion');?>">
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
						<th>Nro Seccion</th>
						<th>Orden de Seccion</th>
						<th>Modulo</th>
						<th>Encuesta</th>
						<th>Subtema</th>
						<th>Accion</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($secciones as $e) {?>
						<tr>
							<td><?php echo $e->iduiseccion;?></td>
							<td><?php echo $e->uiorden_seccion;?></td>
							<td><?php echo $e->uinombre_modulo;?></td>
							<td><?php echo $e->uinombre_encuesta; ?></td>
							<td><?php echo $e->nombre_subtema;?></td>
							<td><a href="<?php echo site_url('encuesta/editarSeccion/'.$e->iduiseccion);?>"><i class="fas fa-edit"></i></a></td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>

		</div>
	</div>
	<br>
</main>


