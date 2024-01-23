<main role="main">
	<br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<div id="caja_boton">
					<div id="contenedor-submit">
						<a href="<?php echo site_url('libro/crearLibro');?>">
							<input type="submit" class="BOTON" value="CREAR">
						</a>
						<a href="<?php echo site_url('/');?>">
							<input type="submit" class="BOTONROJO" value="CANCELAR">
						</a>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores" >
				<h3 class="text-center" >
					LIBROS REGISTRADOS
				</h3>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<div>
					<table id="libros-tabla" class="table table-striped table-hoover">
						<thead>
						<tr id="datos">
							<th>ID</th>
							<th>No Libro</th>
							<th>Fecha Apertura</th>
							<th>Fecha Cierre</th>
							<th>Dep.</th>
							<th>Mun.</th>
							<th>Par. Validas</th>
							<th>Par. Nulas</th>
							<th>Par. Blancas</th>
							<th>Obs</th>
							<th>Accion</th>
						</tr>
						</thead>
						<tbody>
						<?php if(isset($libros)): ?>
							<?php foreach ($libros as $n): ?>
								<?php $reg = json_decode($n->libro_informacion); ?>
								<tr>
									<td><?php echo $n->idlibro; ?></td>
									<td><?php echo $reg->numero_libro; ?></td>
									<td><?php echo $reg->fecha_apertura; ?></td>
									<td><?php echo $reg->fecha_cierre; ?></td>
									<td><?php echo $reg->nombre_departamento; ?></td>
									<td><?php echo $reg->municipio; ?></td>
									<td><?php echo $reg->partidas_validas; ?></td>
									<td><?php echo $reg->partidas_nulas; ?></td>
									<td><?php echo $reg->partidas_blancas; ?></td>
									<td><?php echo $reg->observaciones; ?></td>
									<td>
										<a href="<?php echo site_url('libro/editarLibro/'.$n->idlibro); ?>">
											Editar<i class="fas fa-edit"></i>
										</a>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>

		</div>
	</div>
</main>
