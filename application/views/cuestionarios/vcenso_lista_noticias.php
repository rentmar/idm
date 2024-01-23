<main role="main">
<br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores" >
				<h3 class="text-center" >
					<?php echo $cuestionario->nombre_cuestionario;?>
				</h3>
			</div>

			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<table class="table table-striped table-hover ">
					<thead>
						<tr>
							<th>Fecha de Registro</th>
							<th>Fecha de la noticia</th>
							<th>Titular</th>
							<th>Medio</th>
							<th>Accion</th>
						</tr>
					</thead>
					<tbody>
					<?php if(isset($noticias)): ?>
						<?php foreach ($noticias as $n): ?>
						<tr>
							<td><?php echo mdate('%m-%d-%Y', $n->fecha_registro); ?></td>
							<td><?php echo mdate('%m-%d-%Y', $n->fecha_noticia); ?></td>
							<td><?php echo $n->titular; ?></td>
							<td><?php echo $n->nombre_medio; ?></td>
							<td>
								<a href="<?php echo site_url('Censo/editarNoticia/'.$n->idnoticia); ?>">
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
</main>
