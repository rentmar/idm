<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<div id="caja_boton">
					<div id="contenedor-submit">
						<a href="<?php echo site_url('Departamento/crearDepartamento');?>">
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
							<th>Departamento</th>
							<th>Accion</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($departamentos as $d) {?>
							<tr>
								<td><?php echo $d->iddepartamento;?></td>
								<td><?php echo $d->nombre_departamento;?></td>
								<td>
									<a href="<?php echo site_url('Departamento/editarDepartamento/'.$d->iddepartamento);?>">
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

