<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<div id="caja_boton">
					<div id="contenedor-submit">
						<a href="<?php echo site_url('Universidad/crearUniversidad');?>">
							<input type="submit" class="BOTON" value="CREAR">
						</a>
						<a href="<?php echo site_url('/');?>">
							<input type="button" class="BOTONROJO" value="CANCELAR">
						</a>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<table>
					<thead>
						<tr id="datos">
							<th>Nro</th>
							<th>Universidad</th>
							<th>Sigla</th>
							<th>Accion</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($universidades as $u) {?>
							<tr>
								<td><?php echo $u->iduniversidad;?></td>
								<td><?php echo $u->nombre_universidad;?></td>
								<td><?php echo $u->sigla_universidad;?></td>
								<td>
								<a href="<?php echo site_url('Universidad/editarUniversidad/'.$u->iduniversidad);?>">
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

