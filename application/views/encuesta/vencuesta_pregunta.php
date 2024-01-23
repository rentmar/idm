<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<div id="caja_boton">
					<div id="contenedor-submit">
						<a href="<?php echo site_url('Encuesta/crearPregunta');?>">
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
						<th>Pregunta</th>
						<th>Tipo</th>
						<th>Encuesta</th>
						<th>Modulo</th>
						<th>Seccion</th>
						<th>Orden</th>
						<th>Accion</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($preguntas as $e) {?>
						<tr>
							<td><?php echo $e->iduipregunta;?></td>
							<td><?php echo $e->uipregunta_nombre; ?></td>
							<td><?php echo $e->nombre_tipopregunta; ?></td>
							<td><?php echo $e->uinombre_encuesta; ?></td>
							<td><?php echo $e->uinombre_modulo;?></td>
							<td><?php echo $e->iduiseccion; ?></td>
							<td><?php echo $e->uiorden_pregunta;?></td>
							<td>
								<a href="<?php echo site_url('Encuesta/editarPreguntaUI/'.$e->iduipregunta);?>">
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


