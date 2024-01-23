<br><br>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores" >
			<h3 class="text-center" >
				Noticias
			</h3>
		</div>

		<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores ">
			<div>
				<table id="noticias-tabla" class="table table-striped table-hoover">
					<thead>
					<tr id="datos">
						<th>No</th>
						<th>Fecha de Publicacion</th>
						<th>Titular</th>
						<th>Resumen</th>
						<th>Medio</th>
						<th>Tema</th>
						<th>Fuente(Link)</th>
					</tr>
					</thead>
					<tbody>
					<?php if(isset($noticias)): ?>
						<?php foreach ($noticias as $n): ?>
							<tr>
								<td><?php echo $n->idnoticia; ?></td>
								<td><?php echo mdate('%m-%d-%Y', $n->fecha_noticia); ?></td>
								<td><?php echo $n->titular; ?></td>
								<td><?php echo $n->resumen; ?></td>
								<td><?php echo $n->nombre_medio; ?></td>
								<td><?php echo $n->nombre_tema; ?></td>
								<td><?php echo $n->url_noticia; ?></td>
							</tr>
						<?php endforeach; ?>
					<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>




	</div>
</div>
<br>
</main>


