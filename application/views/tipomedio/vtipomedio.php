<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<div id="caja_boton">
					<div id="contenedor-submit">
						<a href="<?php echo site_url('TipoMedio/crearTipoMedio');?>"><input type="submit" class="BOTON" value="CREAR"></a>
						<a href="<?php echo site_url('/');?>"><input type="button" class="BOTONROJO" value="CANCELAR"></a>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<table>
					<tr id="datos">
						<th>Nro</th>
						<th>Actor</th>
						<th>Accion</th>
					</tr>
					<?php foreach ($tipomedio as $tm) {?>
						<tr>
							<td><?php echo $tm->idtipomedio;?></td>
							<td><?php echo $tm->nombre_tipo;?></td>
							<td>
								<a href="<?php echo site_url('TipoMedio/editarTipoMedio/'.$tm->idtipomedio);?>">
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


