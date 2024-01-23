<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<div id="caja_boton">
					<div id="contenedor-submit">
						<a href="<?php echo site_url('Encuesta/crearRespuestaUI');?>">
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
						<th>Respuesta</th>

					</tr>
					</thead>
					<tbody>
					<?php foreach ($respuestas as $e) {?>
						<tr>
							<td><?php echo $e->iduirespuesta;?></td>
							<td><?php echo $e->uinombre_respuesta ?></td>
							<!--<td>
								<a href="<?php //echo site_url('Encuesta/editarPregunta/'.$e->iduirespuesta);?>">
									<i class="fas fa-edit"></i>
								</a>
							</td>-->
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>

		</div>
	</div>
	<br>
</main>



