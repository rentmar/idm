<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<div id="caja_boton">
					<div id="contenedor-submit">
						<a href="<?php echo site_url('MedioComunicacion/crearMedioComunicacion');?>"><input type="submit" class="BOTON" value="CREAR"></a>
						<a href="<?php echo site_url('/');?>"><input type="submit" class="BOTONROJO" value="CANCELAR"></a>
					</div>
				</div>
			</div>

			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<table>
					<tr id="datos">
						<th>Nro</th>
						<th>Medio Comunicacion</th>
						<th>Tipo Medio</th>
						<th>Accion</th>
					</tr>
					<?php foreach ($medios as $m) {?>
						<tr>
							<td><?php echo $m->idmedio;?></td>
							<td><?php echo $m->nombre_medio;?></td>
							<td><?php echo $m->nombre_tipo;?></td>
							<td>
								<a href="<?php echo site_url('MedioComunicacion/editarMedioComunicacion/'.$m->idmedio);?>">
									<i class="fas fa-edit"></i>
								</a>
							</td>
						</tr>
					<?php } ?>
				</table>
			</div>
		</div>
	</div>
	<br>
</main>


